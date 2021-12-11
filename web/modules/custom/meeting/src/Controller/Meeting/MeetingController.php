<?php

namespace Drupal\meeting\Controller\Meeting;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;


class MeetingController extends ControllerBase
{

  public function index()
  {
    $form['form'] = $this->formBuilder()->getForm('Drupal\meeting\Form\Meeting\MeetingfilterForm');

    //create table header
    $header = array(
      array(
        'data'  => $this->t('Meeting name'),
        'field' => 'm.meeting_name',
        'class' => ['col-9 text-center'],
      ),
      array(
        'data'  => $this->t('View'),
        'class' => ['col-1 text-center'],
      ),
      array(
        'data'  => $this->t('Edit'),
        'class' => ['col-1 text-center'],
      ),
      array(
        'data'  => $this->t('Delete'),
        'class' => ['col-1 text-center'],
      ),
    );

    // get data from database
    $query = \Drupal::database()->select('meeting', 'm');
    $query->fields('m');
    $query->extend('Drupal\Core\Database\Query\TableSortExtender')->orderByHeader($header);

    if (\Drupal::request()->query->get('search')) {
      $orGroup = $query->orConditionGroup()
        ->condition('m.id', trim(\Drupal::request()->query->get('search')))
        ->condition('m.meeting_name', trim(\Drupal::request()->query->get('search')));
      $query->condition($orGroup);
    }
    $results = $query->execute();

    $rows = array();
    foreach ($results as $data) {
      $url_delete = Url::fromRoute('meeting.delete_form', ['id' => $data->id], ['attributes' => ['class' => ['button']]]);
      $url_edit   = Url::fromRoute('meeting.edit_form', ['id' => $data->id], ['attributes' => ['class' => ['button']]]);
      $url_view   = Url::fromRoute('meeting.show_data', ['id' => $data->id], ['attributes' => ['class' => ['button']]]);
      $linkEdit   = Link::fromTextAndUrl('Edit', $url_edit);
      $linkView   = Link::fromTextAndUrl('View', $url_view);
      $linkDelete = Link::fromTextAndUrl('Delete', $url_delete);

      //get data
      $rows[] = array(
        ['data'      => $data->meeting_name, 'class' => ['text-left']],
        ['data'      => $linkView, 'class' => ['text-center']],
        ['data'      => $linkEdit, 'class' => ['text-center']],
        ['data'      => $linkDelete, 'class' => ['text-center']],
      );
    }

    // render table
    $form['table'] = [
      '#type'   => 'table',
      '#header' => $header,
      '#rows'   => $rows,
      '#empty'  => $this->t('No data found'),
    ];
    return $form;
  }
}

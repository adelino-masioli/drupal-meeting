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
    $header_table = array(
      'id'                  => array('data' => $this->t('ID'), 'field' => 'id', 'sort' => 'desc', 'class' => ["col-1"]),
      'meeting_name'        => array('data' => $this->t('Meeting name'), 'class' => ["col-8"]),
      'view'                => array('data' => $this->t('View'), 'class' => ["col-1"]),
      'edit'                => array('data' => $this->t('Edit'), 'class' => ["col-1"]),
      'delete'              => array('data' => $this->t('Delete'), 'class' => ["col-1"]),
    );

    // get data from database
    $query = \Drupal::database()->select('meeting', 'm');
    $query->fields('m', ['id', 'meeting_name', 'meeting_description', 'meeting_url_video']);

    if(\Drupal::request()->query->get('sort')){
      $query->orderBy(\Drupal::request()->query->get('order'), \Drupal::request()->query->get('sort'));
    }


    if(\Drupal::request()->query->get('meeting_name')){
      $query->condition('meeting_name', trim(\Drupal::request()->query->get('meeting_name')));
    }
    $results = $query->execute()->fetchAll();

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
        'id'                  => $data->id,
        'meeting_name'        => $data->meeting_name,
        'view'                => $linkView,
        'edit'                => $linkEdit,
        'delete'              => $linkDelete,
      );
    }

    // render table
    $form['table'] = [
      #'#theme' => 'meeting_template',
      '#type'   => 'table',
      '#header' => $header_table,
      '#rows'   => $rows,
      '#empty'  => $this->t('No data found'),
    ];
    return $form;
  }


}

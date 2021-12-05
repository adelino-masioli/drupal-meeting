<?php
namespace Drupal\meeting\Form\Meeting;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\Core\Routing;

/**
 * Provides the form for filter Students.
 */
class MeetingfilterForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'meeting_filter_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['link']= [
      '#title' => $this->t('Add new Meeting'),
      '#type' => 'link',
      '#url' => Url::fromRoute('meeting.add_form'),
      '#attributes' => ['class' => 'button button--primary button--action']
    ];

    $form['filters'] = [
      '#type'  => 'container',
      '#open'  => true,
      '#attributes' => ['class' => 'flex-form']
    ];

    $form['filters']['meeting_name'] = [
        '#title'         => 'Meeting Name',
        '#type'          => 'search',
        '#attributes' => ['placeholder' => 'Meeting Name']
    ];
    $form['filters']['actions'] = [
        '#type'       => 'actions'
    ];

    $form['filters']['actions']['submit'] = [
        '#type'  => 'submit',
        '#value' => $this->t('Filter')
    ];

    $form['filters']['actions']['link']= [
      '#title' => $this->t('Reset'),
      '#type' => 'link',
      '#url' => Url::fromRoute('meeting.display_data'),
      '#attributes' => ['class' => 'button button--primary']
    ];


    return $form;

  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

	  if ( $form_state->getValue('meeting_name') == "") {
		    $form_state->setErrorByName('from', $this->t('You must enter a valid name.'));
     }

  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array & $form, FormStateInterface $form_state) {
	  $field = $form_state->getValues();
	  $meeting_name = $field["meeting_name"];
    $url = \Drupal\Core\Url::fromRoute('meeting.display_data')
          ->setRouteParameters(array('meeting_name'=>$meeting_name));
    $form_state->setRedirectUrl($url);
  }

}

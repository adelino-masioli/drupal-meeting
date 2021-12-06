<?php

namespace Drupal\meeting\Form\Meeting\Partials;

use Drupal\Core\Url;


class MeetingForm
{

  /**
   * {@inheritdoc}
   */

  public  function getFormId()
  {
    return 'meeting_form';
  }

  public static function partialForm($form, $form_state, $data)
  {
    $form['id'] = [
      '#type' => 'hidden',
      '#default_value' => $data['id'],
    ];

    $form['fields'] = [
      '#type'  => 'container',
      '#open'  => true,
      '#attributes' => ['class' => 'row']
    ];

    $form['fields']['box'] = [
      '#type'  => 'container',
      '#attributes' => ['class' => 'col-xs-12 col-sm-12 col-md-12col-lg-12']
    ];

    $form['fields']['box']['row'] = [
      '#type'  => 'container',
      '#attributes' => ['class' => 'row']
    ];

    $form['fields']['box']['row']['meeting_name'] = [
      '#type' => 'textfield',
      '#title' => 'Meeting name',
      '#required' => true,
      '#size' => 60,
      '#default_value' => (isset($data['meeting_name'])) ? $data['meeting_name'] : '',
      '#maxlength' => 128,
      '#wrapper_attributes' => ['class' => 'col-xs-12 col-sm-12 col-md-12 col-lg-12'],
      '#attributes' => ['placeholder' => 'Meeting Name', 'class' => ['col-full']]
    ];

    $form['fields']['box']['row']['meeting_url_video'] = [
      '#type' => 'textfield',
      '#title' => 'URL Video',
      '#default_value' => (isset($data['meeting_url_video'])) ? $data['meeting_url_video'] : '',
      '#wrapper_attributes' => ['class' => 'col-xs-12 col-sm-12 col-md-12 col-lg-12'],
      '#attributes' => ['placeholder' => 'URL Video', 'class' =>   ['col-full']]
    ];

    $form['fields']['box']['row']['meeting_description'] = [
      '#type' => 'text_format',
      '#title' => 'Meeting description',
      '#default_value' => (isset($data['meeting_description'])) ? $data['meeting_description'] : '',
      '#wrapper_attributes' => ['class' => 'col-xs-12 col-sm-12 col-md-12 col-lg-12'],
      '#attributes' => ['placeholder' =>'Meeting description', 'class' => ['col-full']]
    ];

    $form['fields']['box']['row']['picture'] = array(
      '#title' =>  'Results background image',
      '#description' => 'Choose Image gif png jpg jpeg',
      '#type' => 'managed_file',
      '#default_value' => (isset($data['fid'])) ? [$data['fid']] : [],
      '#upload_location' => 'public://images/',
      '#wrapper_attributes' => ['class' => 'col-xs-12 col-sm-12 col-md-12 col-lg-12'],
      '#attributes' => ['class' => ['col-full']],
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg')
      )
    );


    $form['meeting_status'] = [
      '#type' => 'checkbox',
      '#title' => 'Published',
      '#default_value' => (isset($data['meeting_status'])) ? $data['meeting_status'] : '',
    ];


    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Save',
      '#attributes' => ['class' =>   ['button', 'button--primary']]
    ];

    $form['link'] = [
      '#title' =>  'Cancel',
      '#type' => 'link',
      '#url' => Url::fromRoute('meeting.display_data'),
      '#attributes' => ['class' => 'btn']
    ];

    return $form;
  }
}

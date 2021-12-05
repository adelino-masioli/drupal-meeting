<?php

namespace Drupal\meeting\Form\Meeting;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\file\Entity\File;

class MeetingForm extends FormBase
{

  /**
   * getFormId
   *
   * @return void
   */
  public function getFormId()
  {
    return 'meeting_form';
  }
  /**
   * Undocumented function
   *
   * @param array $form
   * @param FormStateInterface $form_state
   * @return void
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['fields'] = [
      '#type'  => 'container',
      '#open'  => true,
      '#attributes' => ['class' => 'row']
    ];

    $form['fields']['meeting_name'] = [
      '#type' => 'textfield',
      '#title' => 'Meeting name',
      '#required' => true,
      '#size' => 60,
      '#default_value' => '',
      '#maxlength' => 128,
      '#wrapper_attributes' => ['class' => 'col-xs-12 col-sm-6 col-md-6 col-lg-6'],
      '#attributes' => ['placeholder' => 'Meeting Name', 'class' => ['col-full']]
    ];

    $form['fields']['meeting_url_video'] = [
      '#type' => 'textfield',
      '#title' => 'URL Video',
      '#default_value' => '',
      '#wrapper_attributes' => ['class' => 'col-xs-12 col-sm-6 col-md-6 col-lg-6'],
      '#attributes' => ['placeholder' => 'URL Video', 'class' =>   ['col-full']]
    ];


    $form['meeting_description'] = [
      '#type' => 'text_format',
      '#title' => 'Meeting description',
      '#default_value' => '',
      '#attributes' => ['placeholder' => 'Meeting description']
    ];

    $form['picture'] = array(
      '#title' => $this->t('Results background image'),
      '#description' => $this->t('Choose Image gif png jpg jpeg'),
      '#type' => 'managed_file',
      '#upload_location' => 'public://images/',
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg')
      )
    );

    $form['meeting_status'] = [
      '#type' => 'checkbox',
      '#title' => 'Published',
      '#default_value' => '',
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Save',
      '#attributes' => ['class' =>   ['button--primary']]
    ];

    $form['link'] = [
      '#title' => $this->t('Cancel'),
      '#type' => 'link',
      '#url' => Url::fromRoute('meeting.display_data'),
      '#attributes' => ['class' => 'button']
    ];

    return $form;
  }

  /**
   * Undocumented function
   *
   * @param array $form
   * @param FormStateInterface $form_state
   * @return void
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    if (is_numeric($form_state->getValue('meeting_name'))) {
      $form_state->setErrorByName('meeting_name', $this->t('Error, The Meeting name Must Be A String'));
    }
  }

  /**
   * Undocumented function
   *
   * @param array $form
   * @param FormStateInterface $form_state
   * @return void
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    //get picture id
    $picture = $form_state->getValue('picture');

    //array data to insert on database
    $data = array(
      'meeting_name'        =>  $form_state->getValue('meeting_name'),
      'meeting_description' =>  $form_state->getValue('meeting_description')['value'],
      'meeting_url_video'   =>  $form_state->getValue('meeting_url_video'),
      'fid'                 =>  isset($picture[0]) ? $picture[0] : NULL,
      'meeting_status'      =>  $form_state->getValue('meeting_status'),
    );

    // save file as Permanent
    if (isset($picture[0])) {
      $file = File::load($picture[0]);
      $file->setPermanent();
      $file->save();
    }

    //create new meeting and get last id
    $meeting = \Drupal::database()->insert('meeting')->fields($data)->execute();

    // show message and redirect to list page
    \Drupal::messenger()->addStatus('Succesfully saved');
    $url = Url::fromRoute('meeting.edit_form', ['id' => $meeting]);
    $form_state->setRedirectUrl($url);

    return;
  }
}

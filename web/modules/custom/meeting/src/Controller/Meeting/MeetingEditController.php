<?php

namespace Drupal\meeting\Controller\Meeting;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\file\Entity\File;
use Drupal\meeting\Controller\Poll\PollController;

/**
 * Undocumented class
 */
class MeetingEditController extends ControllerBase
{

  /**
   * @return array
   */
  public function index($id)
  {

    // render forms
    $form['container'] = [
      '#theme' => 'meeting_edit_template',
      '#type'   => 'markup',
      '#meeting'   => $this->formBuilder()->getForm('Drupal\meeting\Form\Meeting\MeetingEditForm', $id),
      '#poll'   => $this->formBuilder()->getForm('Drupal\meeting\Form\Poll\MeetingPollForm', $id),
      '#polls'   => PollController::get($id),
      '#question'   => $this->formBuilder()->getForm('Drupal\meeting\Form\Question\MeetingQuestionForm', $id),
    ];

    return $form;
  }
}

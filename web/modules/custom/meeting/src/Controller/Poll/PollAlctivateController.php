<?php

namespace Drupal\meeting\Controller\Poll;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Database\Database;


class PollAlctivateController extends ControllerBase
{

  public static function activate()
  {
    $meeting_id = \Drupal::request()->request->get('meeting_id');

    $conn = Database::getConnection();
    $query = $conn->select('meeting_module', 'm')
      ->fields('m')
      ->condition('meeting_id', $meeting_id);
    $meeting_module = $query->execute()->fetchAssoc();

    if($meeting_module){
      $conn->delete('meeting_module')->condition('meeting_id', $meeting_id)->execute();
    }else{
      $data = [
        "meeting_id" => $meeting_id,
        "module"     => "poll",
        "order"      => 1,
      ];
      $conn->insert('meeting_module')->fields($data)->execute();
    }



    $response = new AjaxResponse();
    return $response;
  }
}

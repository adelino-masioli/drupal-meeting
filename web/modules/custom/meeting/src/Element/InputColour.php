<?php

namespace Drupal\meeting\Element;

use Drupal\Core\Render\Element;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a time element.
 *
 * @FormElement("inputcolour")
 */
class InputColour extends Element\FormElement
{

  public function getInfo()
  {
    $class = get_class($this);
    return [
      '#input' => TRUE,
      '#process' => [
        [$class, 'processAutocomplete'],
        [$class, 'processAjaxForm'],
        [$class, 'processPattern'],
        [$class, 'processGroup'],
        [$class, 'processInputColour'],
      ],
      '#pre_render' => [
        [$class, 'preRenderInputColour'],
        [$class, 'preRenderGroup'],
      ],
      '#theme' => 'inputcolour_form',
      '#theme_wrappers' => ['form_element'],
      '#inputcolour_callbacks' => []
    ];
  }


  public static function processInputColour(&$element, FormStateInterface $form_state, &$complete_form)
  {
    $element['inputcolour'] = [
      '#name' => $element['#name'],
      '#title' => t('Time'),
      '#title_display' => 'invisible',
      '#default_value' => $element['#default_value'],
      '#attributes' => $element['#attributes'],
      '#required' => $element['#required'],
      '#size' => 12,
      '#error_no_message' => TRUE,
    ];

    return $element;
  }


  public static function preRenderInputColour($element)
  {
    $element['#attributes']['type'] = 'text';
    Element::setAttributes($element, ['id', 'name', 'value', 'size', 'maxlength', 'placeholder']);
    static::setAttributes($element, ['form-text']);

    return $element;
  }


  public static function valueCallback(&$element, $input, FormStateInterface $form_state)
  {
    $input = $element['#default_value'];

    return $input;
  }



}

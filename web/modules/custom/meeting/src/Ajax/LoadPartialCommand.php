<?php

namespace Drupal\meeting\Ajax;

use Drupal\Core\Ajax\CommandInterface;

/**
 * Class ExampleCommand.
 */
class LoadPartialCommand implements CommandInterface
{

  protected $form;
  protected $div;
  protected $url;
  protected $refresh;

  public function __construct($form = null, $div, $url, $refresh=null)
  {
    $this->form = $form;
    $this->div = $div;
    $this->url = $url;
    $this->refresh = $refresh;
  }

  /**
   * Render custom ajax command.
   *
   * @return ajax
   *   Command function.
   */
  public function render()
  {
    return [
      'command' => 'loadPartial',
      'form' => $this->form,
      'div' => $this->div,
      'url' => $this->url,
      'refresh' => $this->refresh,
    ];
  }
}

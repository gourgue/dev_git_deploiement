<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ConsoleTestController.
 */
class ConsoleTestController extends ControllerBase {

  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function hello() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: hello')
    ];
  }
  /**
   * Consoletest.
   *
   * @return string
   *   Return Hello string.
   */
  public function consoleTest() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: consoleTest')
    ];
  }

}

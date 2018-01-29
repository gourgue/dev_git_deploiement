<?php
namespace Drupal\hello\Controller;
use Drupal\Core\Controller\ControllerBase;

class HelloNodeListeController extends ControllerBase {

/**
 * An example controller.
 */

  /**
   * {@inheritdoc}
   */
  public function nodeList($param) {

     $storage = \Drupal::entityTypeManager()->getStorage('node');

     $ids = \Drupal::entityQuery('node')->pager('10')->execute();

     $entityQuery =\Drupal::entityTypeManager()->getStorage('node')->getQuery();

     $entities = $storage->loadMultiple($ids);

     foreach ($entities as $entitie) {
      $items[] = $entitie->ToLink();

     }

  $build = array(
        '#theme' => "item_list",
            '#items' => $items
    );

  $page = array(
    '#type' => 'pager' 
  );

    return array($build, $page);
  }

}

<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Datetime\DateFormatter;
use Drupal\node\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HelloNodeHistoryController extends ControllerBase {

 protected $database;
 protected $dateFormatter;

 public function __construct(Connection $database, DateFormatter $dateFormatter) {
   $this->database = $database;
   $this->dateFormatter = $dateFormatter;
 }

 public static function create(ContainerInterface $container) {
   return new static(
     $container->get('database'),
     $container->get('date.formatter')
   );
 }   

 public function nodeHistory(NodeInterface $node) {

   $query = $this->database->select('hello_node_history', 'hnh')
     ->fields('hnh', array('uid', 'update_time'))
     ->condition('nid', $node->id());



$count = $query->countQuery()->execute()->fetchField();
  $message = array(
    '#theme' =>'hello_node_history',
    '#node'  => $node,
    '#count' => $count,
  );


   // Tableau des updates.
   $result = $query->extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit('5')->execute();
   $rows = array();
   $userStorage = $this->entityTypeManager()->getStorage('user');

   foreach ($result as $record) {
     $rows[] = array(
       $userStorage->load($record->uid)->toLink(),
       $this->dateFormatter->format($record->update_time),
     );

   }
//if ($table != '0') {
   $table = array(
     '#theme'  => 'table',
     '#header' => array($this->t('Author'), $this->t('Update time')),
     '#rows'   => $rows,
   );
  //}
   // Pagination.
   $pager = array('#type' => 'pager');

   // On renvoie les 3 render arrays.
   return array(
     'message' => $message,
     'table' => $table,
     'pager' => $pager
   );

 }

}

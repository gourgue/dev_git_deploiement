<?php

namespace Drupal\annonce\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Database\Driver\mysql\Connection;
use Drupal\Core\Datetime\DateFormatter;
use Drupal\Core\Routing\RouteMatchInterface;

/**
 * Class TestSubscriber.
 */
class TestSubscriber implements EventSubscriberInterface {

  /**
   * Drupal\Core\Session\AccountProxy definition.
   *
   * @var \Drupal\Core\Session\AccountProxy
   */
  protected $currentUser;
  /**
   * Drupal\Core\Database\Driver\mysql\Connection definition.
   *
   * @var \Drupal\Core\Database\Driver\mysql\Connection
   */
  protected $database;
  /**
   * Drupal\Core\Datetime\DateFormatter definition.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   */
  protected $dateFormatter;

  /**
   * Constructs a new TestSubscriber object.
   */
  public function __construct(AccountProxy $current_user, Connection $database, DateFormatter $date_formatter, RouteMatchInterface $currentRouteMatch) {
    $this->database = $database;
    $this->currentRouteMatch = $currentRouteMatch;
    $this->currentUser = $current_user;
    $this->dateFormatter = $date_formatter;
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events['kernel.request'] = ['onRequest'];
     return $events;
  }
  /**
   * This method is called whenever the kernel.request event is
   * dispatched.
   *
   * @param GetResponseEvent $event
   */
  public function onRequest(Event $event) {
    //drupal_set_message('Event for '.$this->currentUser->getAccountName(), 'status', TRUE);
    if ($this->currentRouteMatch->getParameter('annonce')) {

      //drupal_set_message('Event Annonce', 'status', TRUE);
      //kint($this->currentRouteMatch->getParameter('annonce'));

      $this->database->insert('annonce_history')
        ->fields([
        'aid' => $this->currentRouteMatch->getParameter('annonce')->id(),
        'uid' => $this->currentUser->Id(),
        'date' => Time(),
        ])
        ->execute();
    }
  }
}

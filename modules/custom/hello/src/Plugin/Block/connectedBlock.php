<?php

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Provides a 'connected' Block.
 *
 * @Block(
 *   id = "connected_block",
 *   admin_label = @Translation("connected block"),
 *   category = @Translation("Conneted user"),
 * )
 */
class connectedBlock extends BlockBase {

	public function build() {

		$number = \Drupal::database()->select('sessions','s')
		->countQuery()
		->execute()
		->fetchField();

    return array(
      '#markup' => $this->t('Il y a actuellement : <br> %number user actif(s) actuellement.', array('%number' => $number)),
      '#cache' => array(
      	'key'  => ['hello:sessions'],
      	'tag'  => ['sessions']
      ),
    );
  }

protected function blockAccess(AccountInterface $account){

	if($account->hasPermission('ma permission')) {
	   return AccessResult::allowed(); 
	}
	else {
	   return AccessResult::forbidden(); 
	}
 	//return AccessResult::allowedIfHasPermission($account, 'ma permission');
  }

}
<?php
namespace Drupal\hello\Access;
/**
 * Checks access for displaying configuration translation page.
 */
use Drupal\Core\Access\AccessCheckInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

Class HelloAccessCheck implements AccessCheckInterface {

	public function applies(Route $route){
	return NULL;
	}

public function access(Route $route, Request $request = NULL, AccountInterface $account) {
	$nbr_heures = $route->getRequirement('_access_hello');

	if ($account->isAnonymous()) {
		return AccessResult::forbidden();
	}
	
	if (time() - $account->getAccount()->created > $nbr_heures * 3600) {

		return AccessResult::allowed()->cachePerUser()->setCacheMaxAge(60);
	}

	return AccessResult::forbidden();

	}
}


//AccessResult::allowedIfHasPermission
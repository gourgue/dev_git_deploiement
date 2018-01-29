<?php

namespace Drupal\hello\Plugin\Block;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello"),
 *   category = @Translation("Hello"),
 * )
 */
class HelloBlock extends BlockBase {
	protected $currentUser;
	protected $dateFormatter;

  /**
   * {@inheritdoc}
   */
  public function build() {
/*	$timestamp = \Drupal::time()->getCurrentTime();
*/
  	$this->dateFormatter =\Drupal::service('date.formatter') -> format(time(),'html_time');
  	$this->currentUser = \Drupal::currentUser();
  	$userName = $this->currentUser->getAccountName();

  	$message = $this->t("Welcome %username on our Website.<br> It is: %currentTime", 
  		array(
  			"%currentTime" => $this->dateFormatter,
  			'%username' =>  ucfirst($userName)
  		)
  	);
    return array(
      '#markup' => $message,
      '#cache'  => [
      	'keys'  => ['hello_block'],
      'contexts'=> ['user'],
      	'tag'	=> ['user:'.$this->currentUser->id()],
      'max-age' => '1000',	
      ]	
    );

  }	

}
<?php
namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
* class helloController
*/
class HelloController extends ControllerBase{


	protected $data = array(
	
	  	'toto' => 'Arnaud is the boss',
	  	'tata' => 'Mike is the boss', 
	  	'titi' => 'Emile is the boss', 
	  	'toutou' => 'Ibrahima is not the boss', 
	  	'tété' => 'Khaouter is the boss',
	);

	
	public function content($param){

		$message = $this->t('you are in the hello page. Your name is <strong> %username !</strong>', 
			array(
			'%username' =>  ucfirst($this->currentUser()->getAccountName())
					));
		if ($param !== "no parameter") {
			$message1 = $this->t('Your parameter is %param',
				array('%param' => $param)
			);

			$message = $message . " <BR>". $message1;
		}
	
		$build = array('#markup' => $message);
		return $build;
	}


public function jsonResponse(){

	//solution 1
		$response = new Response(
    		json_encode($this->data, JSON_PRETTY_PRINT),
    		Response::HTTP_OK,
    		array('content-type' => 'application/json'));

		return $response;
/*	return response;*/


//solution 2
	//return new jsonResponse(array($this->data));
	
	}


	

}	
/*
public function nodeHistory($node_id){
*/
		/*$message = "Hello History !!!";

		$build = array('#markup' => $message);
		return $build;*/

/*		 $items = array("to", "ti", "ta");
  		  $page = array(
  		  				'#type' => 'item_list',
  		 			    '#items' =>  $items,
  	);

    return array($page);

  
	}*/



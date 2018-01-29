<?php
namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;


class CalculatorForm extends FormBase {

  public function getFormID() {
    // Unique ID of the form.
    return 'hello_calculator_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    // Create a $form API array.
    $form['first_value'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('First value'),
      '#description' => $this->t('The first nomber enter.'),
      '#required' => TRUE,
      '#maxlength' => '128',
      'size' => '40',
       '#ajax'          => array(
        'callback'  => array($this, 'AjaxValidateNumeric'),
        'event'     => 'change',
      ),
      '#field_prefix' => '<span id="error-message-first_value"></span>',
    );

    $form['operator'] = array(
      '#type' => 'radios',
      '#title' => $this->t('Opération'),
      '#default_value' => 0,
      '#options' => array(
        0 => $this->t('Add'), 
        1 => $this->t('Soustract'),
        2 => $this->t('Multiply'),
        3 => $this->t('Dvide')),
      '#description' => $this->t('Choose an oprator'),
    );

    $form['second_value'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Second value'),
      '#description' => $this->t('The Second nomber enter.'),
      '#required' => TRUE,
      '#maxlength' => '12',
      'size' => '40',
       '#ajax'          => array(
        'callback'  => array($this, 'AjaxValidateNumeric'),
        'event'     => 'change',
      ),
      '#field_prefix' => '<span id="error-message-second_value"></span>',
    );

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Calculate'),
    );
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
         $first_value = $form_state->getValue('first_value');
         $Second_value = $form_state->getValue('second_value');
         $operator = $form_state->getValue('operator');

    if (!is_numeric($first_value)) {
    // Validate submitted form data.
      $form_state->setErrorByName('first_value', $this->t('The field "First value" must be a numeric'));
    }
    if (!is_numeric($Second_value)) {
    // Validate submitted form data.
      $form_state->setErrorByName('second_value', $this->t('The field "Second value" must be a numeric'));
    }

    if ($Second_value == 0 && $operator == 3) {
      $form_state->setErrorByName('second_value', $this->t('Cannot divide by zero!'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

    $first_value = $form_state->getValue('first_value');
    $Second_value = $form_state->getValue('second_value');
    $operator = $form_state->getValue('operator');

    switch ($operator) {
      case 0:
        $result = $first_value + $Second_value;
      break;
      case 1:
        $result = $first_value - $Second_value;
      break;
      case 2:
        $result = $first_value * $Second_value;
      break;
      case 3:
        $result = $first_value / $Second_value;
      break;
    }
    $message = $this->t("Le résultat de votre opération est: %result",
                array(
                  "%result"=> $result
                )
              );
    drupal_set_message($message);
  }


  //APPREND A INDENTER BORDEL LOL
  public function validateTextAjax(array $form, FormStateInterface $form_state){
    //Création des différentes variables
    $fieldName = $form_state->getTriggeringElement()['#name'];
    $fieldId = str_replace('_','-',$fieldName);
    $fieldTitle = $form_state->getTriggeringElement()['#title'];
    //$fieldDescription = $form_state->getTriggeringElement()['#description'];

    $cssSubmit = ['display' => 'block'];
    $cssField = ['border' => '2px solid green'];
    $cssText = ['color' => 'green'];
    $message = $this->t('Valid');

    $response = new AjaxReponse();

    if ( !is_numeric( $form_state->getValue($fieldName)) ) {
      $cssSubmit = ['display' => 'none'];
      $cssField = ['border' => '2px solid red'];
      $cssText = ['color' => 'red'];
      $message = $this->t('Invalid, this field must be a numeric !');
    }

    $response ->addCommand(new CssCommand('#edit-submit', $cssSubmit));
    $response ->addCommand(new CssCommand('#edit'.$fieldId, $cssField));
    $response ->addCommand(new CssCommand('#edit-'.$fieldId.'--description', $cssText));
    $response ->addCommand(new HtmlCommand('#edit-'.$fieldId.'--description', $message));

    return $response;

  }

}
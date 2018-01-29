<?php
namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Datetime\DrupalDateTime;
//use SameerShelavale\PhpCountriesArray\CountriesArray;

class CountryForm extends FormBase {

  public function getFormID() {
    // Unique ID of the form.
    return 'countries';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $countries = \SameerShelavale\PhpCountriesArray\CountriesArray::get();

    // Create a $form API array.
    $form['countries'] = array(
      '#type'          => 'select',
      '#title'         => $this->t('select a country'),
      '#options'       => array(
      'countries'      => $countries
      ),
      '#default_value' => 'FR',
    );

    $form['start_date'] = array(
      '#type'          => 'datetime',
      '#title' => t('Start Date'),
      '#default_value' => DrupalDateTime::createFromTimestamp(time()),
    );

    $form['submit'] = array(
      '#type'          => 'submit',
      '#value'         => $this->t('Submit'),
    );
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

  }
}
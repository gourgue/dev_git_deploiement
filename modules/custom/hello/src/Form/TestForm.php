<?php

namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use SameerShelavale\PhpCountriesArray\CountriesArray;


/**
 * Class TestForm.
 */
class TestForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'test_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $countries = \SameerShelavale\PhpCountriesArray\CountriesArray::get();

    //$countries = CountriesArray::getFromContinent( 'alpha2', 'name', 'Africa' ); // returns alpha2->name array of countries from Africa
    //$countries = CountriesArray::getFromContinent( 'num', 'alpha3', 'Asia' ); // return     numeric-codes->alpha3 array of countries from Asia
    //$countries = CountriesArray::getFromContinent( 'num', 'name', 'Europe' ); // return numeric-codes->name array of countries from Europe

    $form['liste_continent'] = [
      '#type'           => 'select',
      '#title'          => $this->t('Liste continent'),
      //'#description'    => $this->t('contients'),
      '#options'        => ['Europe','Asie','Afrique','Amérique','Océanie','Antartique',
      ],
        '#default_value'  => 'Afrique',
    ];

    $form['liste_pays'] = [
      '#type'           => 'select',
      '#title'          => $this->t('Liste Pays'),
      //'#description'    => $this->t('Presentation'),
      '#options'        => [
      'countries'       => $countries,
      ],  
      '#default_value'  => 'FR',
    ];

      //'countries'       => $countries],


    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Valider'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }

  }

}

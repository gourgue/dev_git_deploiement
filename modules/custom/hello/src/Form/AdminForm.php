<?php

namespace Drupal\hello\Form;

use Drupal\Core\Entity\EntityTypeManagerInterface; 
//use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
//use Drupal\Core\Entity\EntityTypeManager;


/**
 * Configure example settings for this site.
 */
class AdminForm extends ConfigFormBase {

protected $entityTypeManager;

public function __construct(EntityTypeManagerInterface $entityTypeManager){
 $this->entityTypeManager = $entityTypeManager;
}

public static function create(ContainerInterface $container){
  return new static(
    $container->get('entity_type.manager')
  );
}

  /** 
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'admin_form';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'hello.config',
    ];
  }

  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    //$config = $this->config('example.settings');

    $form['form-color'] = array(
      '#type' => 'select',
      '#title' => $this->t('Choose a color'),
      '#options' => array(
          'red-class' => $this->t('Red'),
          'blue-class' => $this->t('Blue'),
          'green-class' => $this->t('Green'),
          'silver-class' => $this->t('Silver'),
          'orange-class' => $this->t('Orange'),
          'pink-class' => $this->t('Pink'),
      ),
      '#default_value' => $this->config('hello.config')->get('color'),
    );  
    
    return parent::buildForm($form, $form_state);
  }

  /** 
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

      $this->config('hello.config')
        ->set('color', $form_state->getValue('form-color'))
        ->save();

      //\Drupal::entityTypeManager()->getViewBuilder('block')->resetCache();
      $this->entityTypeManager->getViewBuilder('block')->resetCache();

      parent::submitForm($form, $form_state);
  } 

}
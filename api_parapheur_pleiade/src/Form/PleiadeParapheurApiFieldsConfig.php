<?php

namespace Drupal\api_parapheur_pleiade\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure API Pléiade IParapheur fields settings.
 */
class PleiadeParapheurApiFieldsConfig extends ConfigFormBase {

  /** 
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'api_parapheur_pleiade_config_form';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'api_parapheur_pleiade.settings'
    ];
  }

  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('api_parapheur_pleiade.settings');
    
    $form['field_parapheur_url'] = [
        '#type' => 'textfield',
        '#title' => $this->t('IParapheur url'),
        '#default_value' => $config->get('field_parapheur_url'),
        '#description' => $this->t('Enter the full IParapheur url with / at the end, ex: https://parapheur.mydomain.com/'),
      ]; 

    $form['field_parapheur_bureaux_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('IParapheur docs endpoint'),
      '#default_value' => $config->get('field_parapheur_bureaux_url'),
      '#description' => $this->t('Enter the endpoint for bureaux with / at the end, i.e: api/v2/Document/'),
    ];  

    $form['field_parapheur_auth_method'] = [
      '#type' => 'select',
      '#title' => t('Méthode d\'authentification.'),
      '#options' => array(
          'cas' => t('CAS'),
          'oidc' => t('OpenID Connect'),
          'saml' => t('SAML'),
          'http' => t('Http Header'),
      ),
      '#default_value' => $config->get('field_parapheur_auth_method'),
      '#description' => $this->t('Authentification method for IParapheur API'),
      '#required' => TRUE,
    ];  
    
    return parent::buildForm($form, $form_state);
  }
  


  /** 
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $config = $this->config('api_parapheur_pleiade.settings');
   
    $config->set('field_parapheur_url', $form_state->getValue('field_parapheur_url'));
    $config->set('field_parapheur_bureaux_url', $form_state->getValue('field_parapheur_bureaux_url'));
    $config->set('field_parapheur_auth_method', $form_state->getValue('field_parapheur_auth_method'));
    $config->save();
    
    parent::submitForm($form, $form_state);
  }

}
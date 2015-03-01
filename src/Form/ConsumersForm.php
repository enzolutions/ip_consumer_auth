<?php

/**
 * @file
 * Contains Drupal\ip_consumer_auth\Form\ConsumersForm.
 */

namespace Drupal\ip_consumer_auth\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ConsumersForm extends ConfigFormBase
{

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'consumers_form';
  }


  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['ip_consumer_auth.consumers_form_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('ip_consumer_auth.consumers_form_config');
    $form['allowed_ip_consumers'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Allowed IP Consumers'),
      '#description' => $this->t('Place IP addresses on separate lines'),
      '#default_value' => $config->get('allowed_ip_consumers'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    return parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('ip_consumer_auth.consumers_form_config')
          ->set('allowed_ip_consumers', $form_state->getValue('allowed_ip_consumers'))
        ->save();
  }
}

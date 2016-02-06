<?php

/**
 * @file
 * Contains Drupal\ip_consumer_auth\Form\ConsumersForm.
 */

namespace Drupal\ip_consumer_auth\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;

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
  public function  getEditableConfigNames() {
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = \Drupal::configFactory()->get('ip_consumer_auth.consumers_form_config');

    $form['ip_consumers'] = [
      '#type' => 'textarea',
      '#title' => $this->t('IP Consumers'),
      '#description' => $this->t('Place IP addresses on separate lines'),
      '#default_value' => $config->get('ip_consumers'),
    ];

    $options = array(0 => t('Black list'), 1 => t('White list'));
    $form['list_type'] = array(
      '#type' => 'radios',
      '#title' => t('Type of IP list'),
      '#default_value' => $config->get('list_type'),
      '#options' => $options,
      '#description' => t('Define in what way the IP list will be used in Authorization logic.'),
      '#required' => TRUE
    );

    $serializedFormats = $this->getSerializerFormats();
    $form['format'] = [
      '#type' => 'select',
      '#title' => $this->t('Format'),
      '#description' => $this->t("Select a format filter to determine if Authetincation provider applies i.e 'json'"),
      '#default_value' => $config->get('format'),
      '#options' => $serializedFormats,
    ];

    return parent::buildForm($form, $form_state);
  }

  protected function getSerializerFormats()
  {
    try {
      $serializedFormats = \Drupal::getContainer()->getParameter('serializer.formats');
      return array_combine($serializedFormats, $serializedFormats);
    } catch (ParameterNotFoundException $e) {
      drupal_set_message(
          sprintf(
            '%s %s',
            $e->getMessage(),
            $this->t('Please, install module "RESTful Web Services"')
          ),
          'error');
    }
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

    $config = \Drupal::configFactory()->getEditable('ip_consumer_auth.consumers_form_config');
    $config->set('ip_consumers', $form_state->getValue('ip_consumers'));
    $config->set('list_type', $form_state->getValue('list_type'));
    $config->set('format', $form_state->getValue('format'));
    $config->save();
  }
}

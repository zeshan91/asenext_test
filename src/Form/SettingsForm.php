<?php

namespace Drupal\asenext_test\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure ASENext Test settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'asenext_test_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['asenext_test.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['min_score'] = [
      '#type' => 'number',
      '#title' => $this->t('Min Score'),
      '#required' => 0,
      '#default_value' => $this->config('asenext_test.settings')->get('min_score'),
    ];
    $form['max_score'] = [
      '#type' => 'number',
      '#title' => $this->t('Max Score'),
      '#required' => 0,
      '#default_value' => $this->config('asenext_test.settings')->get('max_score'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if ($form_state->getValue('min_score') > $form_state->getValue('max_score')) {
      $form_state->setErrorByName('min_score', $this->t('Min Score can not be greater than max score.'));
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('asenext_test.settings')
      ->set('min_score', $form_state->getValue('min_score'))
      ->set('max_score', $form_state->getValue('max_score'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}

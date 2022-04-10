<?php

namespace Drupal\time_core\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Sessions core settings for this site.
 */
class TimeForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'time_core_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['time_core.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => 'Country',
      
      '#default_value' => $this->config('time_core.settings')->get('country'),
    ];
    $form['city'] = [
        '#type' => 'textfield',
        '#title' => 'City',
        
        '#default_value' => $this->config('time_core.settings')->get('city'),
      ];
    $form['timezone'] = [
        '#type' => 'select',
        '#title' => 'Timezone',
        
        '#options' => array(
          'select'=>t('--- SELECT ---'), 
          'America/Chicago'=>'America/Chicago',
          'America/New_York'=>'America/New_York',
          'Asia/Tokyo'=>'Asia/Tokyo',
          'Asia/Dubai'=>'Asia/Dubai',
          'Asia/Kolkata'=>'Asia/Kolkata',
          'Europe/Amsterdam'=>'Europe/Amsterdam',
          'Europe/Oslo'=>'Europe/Oslo',
          'Europe/London'=>'Europe/London'),
        '#default_value' => $this->config('time_core.settings')->get('timezone'),
      ];
      
    return parent::buildForm($form, $form_state);
  }

 

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('time_core.settings')
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->set('timezone',$form_state->getValue('timezone'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}

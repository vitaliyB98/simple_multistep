<?php

namespace Drupal\simple_multistep\Plugin\field_group\FieldGroupFormatter;

use Drupal\field_group\FieldGroupFormatterBase;

/**
 * Plugin implementation of the 'form_step' formatter.
 *
 * @FieldGroupFormatter(
 *   id = "form_step",
 *   label = @Translation("Form step"),
 *   description = @Translation("Provide simple form step"),
 *   supported_contexts = {
 *     "form",
 *   }
 * )
 */
class FormStep extends FieldGroupFormatterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsForm() {

    $form = parent::settingsForm();

    $form['label']['#title'] = $this->t('Step title');

    $form['show_step_title'] = array(
      '#title' => $this->t('Show step title'),
      '#type' => 'checkbox',
      '#default_value' => $this->getSetting('show_step_title'),
      '#description' => $this->t('Show step title'),
      '#weight' => 1,
    );

    $form['back_button_show'] = array(
      '#title' => $this->t('Show back button'),
      '#type' => 'checkbox',
      '#default_value' => $this->getSetting('back_button_show'),
      '#description' => $this->t('Back button for form. Don`t show on first step'),
      '#weight' => 2,
    );

    $form['back_button_text'] = array(
      '#title' => $this->t('Text for back button'),
      '#type' => 'textfield',
      '#default_value' => $this->getSetting('back_button_text'),
      '#description' => $this->t('Text which will be show on back button'),
      '#weight' => $form['back_button_show']['#weight'] + 0.1,
    );

    $form['next_button_text'] = array(
      '#title' => $this->t('Text for next button'),
      '#type' => 'textfield',
      '#default_value' => $this->getSetting('next_button_text'),
      '#description' => $this->t('Text which will be show on next button'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {

    $summary = parent::settingsSummary();
    $summary[] = $this->t('Back button: @element',
      array('@element' => $this->getSetting('back_button_show') ? 'Show' : 'Hide')
    );
    $summary[] = $this->t('Show title: @element',
      array('@element' => $this->getSetting('show_step_title') ? 'Show' : 'Hide')
    );

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultContextSettings($context) {
    $defaults = array(
      'back_button_show' => FALSE,
      'back_button_text' => t('Back'),
      'next_button_text' => t('Next'),
      'show_step_title' => FALSE,
    ) + parent::defaultSettings($context);

    if ($context == 'form') {
      $defaults['required_fields'] = 1;
    }

    return $defaults;

  }

}

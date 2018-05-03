<?php

namespace Drupal\simple_multistep;

use Drupal\Core\Form\FormStateInterface;

/**
 * Class StepIndicator.
 *
 * @package Drupal\simple_multistep
 */
class StepIndicator extends FormStep {

  /**
   * Constructor.
   *
   * @param array $form
   *   Form settings.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form state object.
   */
  public function __construct(array $form, FormStateInterface $form_state) {
    parent::__construct($form, $form_state);

    $this->createIndicator();
  }

  /**
   * Step indicator.
   *
   * @var array
   */
  protected $stepIndicator;

  /**
   * Create indicator.
   */
  private function createIndicator() {
    $steps_label = array(
      '#type' => 'item',
      '#weight' => -1,
    );

    $markup = '<div class="multi-steps-label">';
    foreach ($this->steps as $step_number => $step) {
      $format_settings = $step->format_settings;
      if ($format_settings['show_step_title']) {
        $active = $this->currentStep == $step_number ? ' active' : '';
        $markup .= '<div class="step-label' . $active . '">';
        $markup .= $step->label;
        $markup .= '</div>';
      }
    }
    $markup .= '</div>';

    $steps_label['#markup'] = $markup;
    $this->stepIndicator = $steps_label;
  }

  /**
   * Get Indicator.
   */
  public function render() {
    return $this->stepIndicator;
  }

}

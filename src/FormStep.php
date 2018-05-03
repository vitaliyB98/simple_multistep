<?php

namespace Drupal\simple_multistep;

use Drupal\Core\Form\FormStateInterface;

/**
 * Class FormStep.
 *
 * @package Drupal\simple_multistep
 */
class FormStep {

  /**
   * Form array.
   *
   * @var array
   */
  protected $form;

  /**
   * Form state.
   *
   * @var \Drupal\Core\Form\FormStateInterface
   */
  protected $formState;

  /**
   * Current step.
   *
   * @var int
   */
  protected $currentStep;

  /**
   * Steps.
   *
   * @var array
   */
  protected $steps;

  /**
   * FormStepController constructor.
   *
   * @param array $form
   *   Form settings.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form state object.
   */
  public function __construct(array $form, FormStateInterface $form_state) {
    $this->form = $form;
    $this->formState = $form_state;

    // Fetch current step from form_state.
    $this->fetchCurrentStep();

    // Fetch list all steps.
    $this->fetchSteps();
  }

  /**
   * Get current step.
   *
   * @return int
   *   Current step.
   */
  public function getCurrentStep() {
    return $this->currentStep;
  }

  /**
   * Set current step.
   */
  protected function fetchCurrentStep() {
    $this->currentStep = empty($this->formState->get('step')) ? 0 : $this->formState->get('step');
  }

  /**
   * Get form steps.
   */
  public function getSteps() {
    return $this->steps;
  }

  /**
   * Get array with form steps.
   */
  protected function fetchSteps() {
    $steps = array();

    if (isset($this->form['#fieldgroups']) && is_array($this->form['#fieldgroups'])) {
      foreach ($this->form['#fieldgroups'] as $field_group) {
        if ($field_group->format_type == 'form_step') {
          $steps[] = $field_group;
        }
      }
      usort($steps, array($this, 'sortStep'));
    }

    $this->steps = $steps;
  }

  /**
   * Sort array by object property.
   *
   * @param object $first_object
   *   First object.
   * @param object $second_object
   *   Second object.
   *
   * @return int
   *   Indicator.
   */
  protected static function sortStep($first_object, $second_object) {
    if ($first_object->weight == $second_object->weight) {
      return 0;
    }
    return ($first_object->weight < $second_object->weight) ? -1 : 1;
  }

}

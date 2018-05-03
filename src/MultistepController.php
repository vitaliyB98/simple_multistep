<?php

namespace Drupal\simple_multistep;

use Drupal\Core\Form\FormStateInterface;

/**
 * Class MultistepController.
 *
 * @package Drupal\simple_multistep
 */
class MultistepController extends FormStep {

  /**
   * Steps indicator.
   *
   * @var array
   */
  public $stepIndicator;

  /**
   * MultistepController constructor.
   *
   * @param array $form
   *   Form settings.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form state object.
   */
  public function __construct(array $form, FormStateInterface $form_state) {
    parent::__construct($form, $form_state);

    $this->stepIndicator = new StepIndicator($form, $form_state);
  }

}

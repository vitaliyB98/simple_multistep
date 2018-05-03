<?php

namespace Drupal\simple_multistep;

/**
 * Class MultistepController.
 *
 * @package Drupal\simple_multistep
 */
class MultistepController {

  /**
   * Form array.
   * @var array
   */
  protected $form;
  protected $form_state;
  /**
   * MultistepController constructor.
   */
  public function __construct($form, $form_state) {
  }

}

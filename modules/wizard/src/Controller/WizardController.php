<?php

namespace Drupal\commerce_wizard\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Instantiation of class.
 */
class WizardController extends ControllerBase {

  /**
   * Quick Install message.
   */
  public function content() {
    return [
      '#theme' => 'commerce_wizard',
      '#title' => $this->t('Commerce: Quick Install'),
      '#intro_title' => $this->t('Hey! It looks like this is your first time using drupal commerce.'),
      '#intro_text' => $this->t('Lets take a few minutes to get your store setup and configured, or <a href="@url">skip the setup wizard</a> if you plan to configure your store manually.', ['@url' => '#']),
      '#attached' => [
        'library' => [
          'commerce_wizard/wizard_intro',
        ],
      ],
    ];
  }

}

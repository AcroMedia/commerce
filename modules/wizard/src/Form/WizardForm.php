<?php

namespace Drupal\commerce_wizard\Form;

use Drupal\Core\Url;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Contribute form.
 */
class WizardForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'commerce_wizard_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    /*
     * 1. Store Details
     */
    $form['commerce_details'] = [
      '#type' => 'stepper',
      '#title' => t('1. Add Store Details'),
    // '#open' => TRUE,.
      '#button_text' => t('Next, location'),
    ];

    /*
     * 2. Store Location
     */
    $form['commerce_location'] = [
      '#type' => 'stepper',
      '#title' => t('2. Enter the stores location'),
      '#button_text' => t('Next, currency'),
    ];

    /*
     * 3. Currency
     */
    $form['commerce_currency'] = [
      '#type' => 'stepper',
      '#title' => t('3. Confirm the stores primary currency'),
      '#markup' => t('<p>We\'ve determined that based on your stores location, the following currency: <strong>Canadian Dollar (CAD)</strong> will be imported.</p>'),
      '#button_text' => t('Confirm'),
      '#skip_text' => t('I\'ll set it up later'),
    ];

    /*
     * 4. Tax
     */
    $form['commerce_tax'] = [
      '#type' => 'stepper',
      '#title' => t('4. Confirm the stores primary tax rate(s)'),
      '#markup' => t('<p>We\'ve determined that based on your stores location, the following tax rates; <strong>GST & PST</strong> will be imported.</p>'),
      '#button_text' => t('Confirm'),
      '#skip_text' => t('I\'ll set it up later'),
    ];

    /*
     * 5. Cart Block
     */
    $form['commerce_cart_block'] = [
      '#type' => 'stepper',
      '#title' => t('5. Place your cart block in a region'),
      '#markup' => t('<p>As a default, the cart block consists of; the number of items added to the users cart, their total, and a link to proceed to their cart for review & checkout.</p>
											<p>Select a region on your site where you’d like customers to view this block.</p>'),
      '#button_text' => t('Place block'),
      '#skip_text' => t('I\'ll set it up later'),
    ];

    /*
     * 6. Payment
     */
    $form['commerce_payment'] = [
      '#type' => 'stepper',
      '#title' => t('6. Add a payment processor'),
      '#markup' => t('<p>Start accepting payments by choosing from 30+ supported <a href="#">payment processors</a>.</p>'),
      '#change_link' => FALSE,
    ];

    /*
     * Form Actions
     */
    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => t('Create Store'),
      '#attributes' => [
        'class' => ['button', 'button--primary'],
      ],
      '#disabled' => TRUE,
    ];

    $form['actions']['cancel'] = [
      '#type' => 'link',
      '#title' => $this->t('Exit wizard'),
      '#url' => Url::fromRoute('commerce.commerce_wizard'),
      '#attributes' => [
        'class' => ['button', 'button--danger'],
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}

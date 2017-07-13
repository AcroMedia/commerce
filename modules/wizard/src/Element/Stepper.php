<?php

namespace Drupal\commerce_wizard\Element;

use Drupal\Core\Render\Element;
use Drupal\Core\Render\Element\RenderElement;

/**
 * Form element theme and #states details.
 *
 * @RenderElement("stepper")
 */
class Stepper extends RenderElement {

  /**
   * {@inheritdoc}
   */

  public function getInfo() {
    $class = get_class($this);
    return [
      '#open' => FALSE,
      '#value' => NULL,
      '#process' => [[$class, 'processGroup'], [$class, 'processAjaxForm']],
      '#pre_render' => [
          [$class, 'preRenderStepper'],
          [$class, 'preRenderGroup'],
      ],
      '#theme_wrappers' => ['stepper'],
      '#attached' => [
        'library' => ['commerce_wizard/wizard_form'],
      ],
    ];
  }


  /**
   * Adds form element theming to details.
   *
   * Associative array containing the properties and children of the details.
   */
  public static function preRenderStepper($element) {
    Element::setAttributes($element, ['id']);

    // The .js-form-wrapper class is required for #states to treat details like.
    // containers.
    static::setAttributes($element, ['js-form-wrapper', 'form-wrapper']);
    $element['#attributes']['class'] = 'stepper';

    // Collapsible details.
    $element['#attached']['library'][] = 'core/drupal.collapse';

    // Open the detail if specified or if a child has an error.
    if (!empty($element['#open']) || !empty($element['#children_errors'])) {
      $element['#attributes']['class'] .= ' stepper--active';
    }

    // Do not render optional details elements if there are no children.
    if (isset($element['#parents'])) {
      $group = implode('][', $element['#parents']);
      if (!empty($element['#optional']) && !Element::getVisibleChildren($element['#groups'][$group])) {
        $element['#printed'] = TRUE;
      }
    }

    return $element;
  }

}

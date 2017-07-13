/**
 * @file
 * Dashboard UI behaviors.
 */

(function ($, Drupal) {

  'use strict';

  /**
   * Dashboard icons generator.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches the behavior for the dashboard icons.
   */
  Drupal.behaviors.dashboardIcons = {
    attach: function (context, settings) {
      $(context).find('.commerce-dashboard__item').each(function () {
        var $itemName = $(this).find('.commerce-dashboard__item-title').text();
        var $itemLetter =  $itemName.charAt(0);
        $(this).find('.commerce-dashboard__item-icon').text($itemLetter);
      });
    }
  };

})(jQuery, Drupal);

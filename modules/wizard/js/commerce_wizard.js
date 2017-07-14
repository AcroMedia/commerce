/**
 * @file
 * Defines functionality for the wizard's stepping system.
 */

(function ($, Drupal, drupalSettings) {
    'use strict';

    var Steps = [];

    var Stepper = {

        // Init constructor.
        init: function (step) {
            this.step = step;
            this.id = step.attr('id');
            this.next_step = step.next();
            this.next_steps = step.nextAll('.stepper');
            this.submit_button = step.find('.stepper__actions .button--primary');
        },

        // Helper function to open up the step to the active state.
        open: function () {

            var form_submit_button = $('.form-actions .form-submit');

            // Set the proper classes for showing the active state and remove any old classes.
            this.step.addClass('stepper--active').removeClass('stepper--complete');

            // Hide the skipped button if this step is active.
            this.step.find('.stepper__header--skipped').addClass('visually-hidden');

            // Make sure all steps below are set to inactive.
            this.next_steps.each(function () {
                var _this = $(this);
                _this = $('#' + _this.attr('id'));
                _this.removeClass('stepper--active stepper--complete');
            });

            // Enable/disabled the main form submit.
            // Depending on if were on the last step or not.
            if (this.step.hasClass('stepper--last')) {
                form_submit_button.removeClass('is-disabled').removeAttr('disabled');
            }
else {
                form_submit_button.addClass('is-disabled').attr('disabled', 'disabled');
            }

        },

        // Helper function to complete a step.
        // Should mainly be used in the submit function.
        complete: function () {
            var next_step_id = this.next_step.attr('id');

            // Close the current step and set it to complete state.
            this.step.addClass('stepper--complete').removeClass('stepper--active');

            // Open the next step, and perform the ajax submit in the step we're closing.
            window.Steps[next_step_id].open();
            this.submit_button.mousedown();
        },

        submit: function () {
            // @Todo: setup some js validation in here
            this.complete();
        },

    };

    // Document ready.
    $(document).ready(function () {

        var step = $('.stepper');
        var first_step = step.first();
        var last_step = step.last();

        // Get all the steps so we can create their objects.
        step.each(function () {
            var _this = $(this);
            var id = $(this).attr('id');

            // Add the step object for later use.
            Steps[id] = Object.create(Stepper);
            Steps[id].init(_this);
        });
        window.Steps = Steps;

        // Open the first step
        // add a class to the last step.
        window.Steps[first_step.attr('id')].open();
        last_step.addClass('stepper--last');

        // Edit buttons.
        $('.stepper__header--button').click(function (e) {
            e.preventDefault();
            var step_id = $(this).parents('.stepper').attr('id');
            window.Steps[step_id].open();
        });

        // Steps primary button.
        $('.stepper__actions .button--primary').click(function (e) {
            e.preventDefault();
            var _this = $(this);
            var step_id = _this.parents('.stepper').attr('id');

            if (!_this.hasClass('is-disabled')) {
                window.Steps[step_id].submit();
            }
        });

        // Steps secondary button.
        $('.stepper__actions .button--danger').click(function (e) {
            e.preventDefault();
            var _this = $(this);
            var step_id = _this.parents('.stepper').attr('id');

            // Show the skipped text.
            $('#' + step_id).find('.stepper__header--skipped').removeClass('visually-hidden');

            if (!_this.hasClass('is-disabled')) {
                window.Steps[step_id].submit();
            }
        });

    });

})(jQuery, Drupal, drupalSettings);

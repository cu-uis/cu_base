/**
 * @file
 * Toast utilities.
 *
 */
(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.cu_base_toast = {
    attach: function (context, settings) {
      $('.toast').toast('show');
    }
  };

})(jQuery, Drupal);

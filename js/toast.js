/**
 * @file
 * Displays any toast messages present on the page.
 *
 */
(function (Drupal) {
  'use strict';

  Drupal.behaviors.cu_base_toast = {
    attach: function () {
      var elements = [].slice.call(document.querySelectorAll('.toast'))
      var toasts = elements.map(function(toastEl) {
        return new bootstrap.Toast(toastEl);
      });
      toasts.forEach(toast => toast.show());
    }
  };
})(Drupal);

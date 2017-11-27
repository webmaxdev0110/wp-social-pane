(function ($) {
  'use strict';

  /**
   * All of the code for your admin-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */

  $(window).load(function () {

    var pickerOptions = {
      // you can declare a default color here,
      // or in the data-default-color attribute on the input
      defaultColor: false,
      // a callback to fire whenever the color changes to a valid color
      change: function (event, ui) {
        $(this).parent().parent().parent().find('i').css('color', ui.color.toString());
      },
      // a callback to fire when the input is emptied or an invalid color
      clear: function () {},
      // hide the color picker controls on load
      hide: true,
      // show a group of common colors beneath the square
      // or, supply an array of colors to customize further
      palettes: true
    };

    $('.social-color-picker').wpColorPicker(pickerOptions);

    $('#display-order-sortable').sortable();

    $('#wp_social_pane_reset').click(function () {
      $('.social-color-picker').each(function () {
        $(this).wpColorPicker('color', $(this).data('default'));
      });
    });
  });

})(jQuery);
// $Id$

Drupal.behaviors.userMultipicture = function (context) {
  $("input[name='multipicture']:checked", context).parent().parent().parent().addClass('multipicture-current');
}; 
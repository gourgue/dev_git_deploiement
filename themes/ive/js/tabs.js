//jqueryTabs
(function($, Drupal, drupalSettings){
  Drupal.behaviors.jqueryTabs = {
    attach: function (context, settings) {
     $( "#tabs", context).tabs();
  }
  })(jQuery, Drupal, drupalSettings);
// //blockCollaps
// Drupal.behaviors.externalLink = {
//   attach: function (context, settings) {
//   $(".sidebar .block h2", context).click(function() {
//     $(this).siblings('.content').slideToggle('fast');
//   });
//  }
// }

// (function($, Drupal, drupalSettings){
//
//   $(document).ready(function(){
//     console.log('Hello tonton');
//     $("a[href^='http']").attr('target', '_blank');
//     $("a[href^='http']").addClass('iconlink');
//
//     //collapsable block
//
//     $(".sidebar .block h2").click(function() {
//       $(this).siblings('.content').slideToggle('fast');
//     });
//   });
// //jqueryTabs
// $variables['#attached']['library'][] = 'ive/jqueryTabs.j';
//
// })(jQuery, Drupal, drupalSettings);

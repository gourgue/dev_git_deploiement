// (function($,Drupal, drupalSettings) {
//   //externalLink
//   Drupal.behaviors.externalLink = {
//     attach: function (context, settings) {
//     $("a[href^='http']", context).attr('target', '_blank').addClass('iconlink');
//     }
//   }
// //blockCollaps
// Drupal.behaviors.externalLink = {
//   attach: function (context, settings) {
//   $(".sidebar .block h2", context).click(function() {
//     $(this).siblings('.content').slideToggle('fast');
//   });
//  }
// }

(function($, Drupal, drupalSettings){

  $(document).ready(function(){
    console.log('Hello tonton');
    $("a[href^='http']").attr('target', '_blank');
    $("a[href^='http']").addClass('iconlink');

    //collapsable block

    $(".sidebar .block h2").click(function() {
      $(this).siblings('.content').slideToggle('fast');
    });
  });
//jqueryTabs
  $( function() {
      $( "#tabs" ).tabs();
    } );


})(jQuery, Drupal, drupalSettings);

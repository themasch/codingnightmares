/*
$('.popup-login form').submit(function(evt) {
  var data = $(this).serialize();
  var path = $(this).attr('action');
  $.post(path, data, function(d) {
    console.log(d);
  });
  evt.preventDefault();
  return false;
});
 */

// open popups with links
$('a[class^=btn-]').click(function(evt) {
  var className = $(this).attr('class').replace(/^btn-/, 'popup-');
  $ele = $('.' + className);
  if($ele.length) {
    $('.popup:not(.'+className+')').addClass('hidden-popup');
    $ele.toggleClass('hidden-popup');
    $ele.find('input:first').focus();
    evt.preventDefault();
    return false;
  }
});
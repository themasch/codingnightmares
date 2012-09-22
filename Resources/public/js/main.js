
// open popups with links
$('a[href^=#]').click(function(evt) {
  var className = $(this).attr('href').replace(/^#/, 'popup-');
  $ele = $('.' + className);
  if($ele.length) {
    $ele.toggleClass('hidden-popup');
    evt.preventDefault();
    return false; 
  }
});
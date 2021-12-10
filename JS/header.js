$(document).ready(function(){
    $('#openMenu').click(function() {
      $('#mobile').css('right','0');
      $('body').css('overflow','hidden');
    })
    $('#closeMenu').click(function() {
      $('#mobile').css('right','-2000px');
      $('body').css('overflow','auto');
    })
  })
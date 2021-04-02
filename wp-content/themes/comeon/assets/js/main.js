$(document).ready(function(){
  let cookiesBtn = $('#acceptCookies');
  cookiesBtn.on('click', function (e){
    e.preventDefault();

    let banner = $('.cookies-banner');
    banner.addClass('hidden');
    console.log("Cookies were accepted!");
  });
});
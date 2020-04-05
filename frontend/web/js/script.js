$(document).ready(function () {
  $(document).on('click', '#toggle-btn', function() {
    $(document).find('#sidebar-nav-wrapper').addClass('toggled');
  });

  $(document).on('click', '#close-btn, #sidebar-nav-wrapper', function() {
    $(document).find('#sidebar-nav-wrapper').removeClass('toggled');
  });
});
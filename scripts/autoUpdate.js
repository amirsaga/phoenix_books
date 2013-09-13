function autoUpdate() {
  $.ajax({
    url: 'auto_update.php',
    type: 'POST',
    complete: function(ajaxObject, status) {
      $('#ajaxContent').html(ajaxObject.responseText);
    }
  });
}
autoUpdate();
  setInterval('autoUpdate()', 15000);

function autoUpdate() {
  $.ajax({
    url: 'auto_user_update.php',
    type: 'POST',
    complete: function(ajaxObject, status) {
      $('#ajaxContent_2').html(ajaxObject.responseText);
    }
  });
}
autoUpdate();
  setInterval('autoUpdate()', 15000);

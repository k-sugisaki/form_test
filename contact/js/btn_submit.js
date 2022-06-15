$("form").submit(function() {
  var self = this;
  $("submitted", self).prop("disabled", true);
  setTimeout(function() {
    $("submitted", self).prop("disabled", false);
  }, 10000);
});
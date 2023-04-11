$(document).ready(function () {
  $('form').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var data = new FormData(form[0]);
    $.ajax({
      type: 'POST',
      url: url,
      data: data,
      processData: false,
      contentType: false,
      dataType: 'json',
      success: function (response) {
        if (response.success) {
          alertify.success(response.message);
          form[0].reset();
        } else {
          alertify.error(response.message);
        }
      },
      error: function () {
        alertify.error('Ocorreu um erro ao cadastrar o usuário.');
      }
    });
  });
});
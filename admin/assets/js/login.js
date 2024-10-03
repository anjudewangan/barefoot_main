//-----------Form Post Function--------------
$(document).ready(function () {

	$("body").click(function () {
		$('.Inpt').html('');
	});



	/*==============Page Form=========================*/
	$('.form-action').on('submit', function (event) {
		$(".Inpt").html('');

		var formurl = $(".form-action").attr('action');
		event.preventDefault();
		$.ajax({
			url: formurl,
			method: "POST",
			data: new FormData(this),
			dataType: 'JSON',
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function () {
				$("#loadpost").show();
			},
			success: function (data) {
				if (data.error) {
					$('.' + data.class_name).html('<div class="alert alert-danger">' + data.error + '</div>');
					$("#loadpost").hide();
					$('input[name="' + data.class_name + '"]').focus();

				} else {

					$('.' + data.class_name).html('<div class="alert alert-success text-center">' + data.msg + '</div>');
					$("fieldset").hide();
					setTimeout(function () {
						if (data.urlpg != '') {
							window.parent.location = data.urlpg;
						} else {
							location.reload(true);
						}
					}, 3000);
					$("#loadpost").hide();
					$(".txtfeild").val('');
				}
			}
		})
	});
});
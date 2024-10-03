$('.actionBlogForm').on('submit', function (event) {
	$(".Inpt").html('');

	var formurl = $(".actionBlogForm").attr('action');

	event.preventDefault();

	for (instance in CKEDITOR.instances) {
		CKEDITOR.instances[instance].updateElement();
	}

	$.ajax({
		url: formurl,
		method: "POST",
		data: new FormData(this),
		dataType: 'JSON',
		contentType: false,
		cache: false,
		processData: false,
		beforeSend: function () {
			$("#bloadpost").show();
		},
		success: function (data) {
			if (data.error) {
				$('.' + data.class_name).html('<div class="text-danger">' + data.error + '</div>');
				$("#bloadpost").hide();
				$('input[name="' + data.class_name + '"]').focus();

			} else {

				var toast = new iqwerty.toast.Toast();
				toast.setText(data.msg).show();
				setTimeout(function () {
					window.parent.location = data.purl;
				}, 3000);

			}
		}
	})
});
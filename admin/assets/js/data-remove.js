//-----------Form Post Function--------------
$(document).ready(function () {

	$('.remove').on('click', function (e) {
		var id = $(this).attr('data-id');
		var tablname = $(this).attr('data-tablname');
		if (confirm('Are you sure want to remove it?') == true) {
			$.post('query.php', {
					'action': 'delete',
					tablname: tablname,
					id: id
				})
				.done(function (data) {
					alert(data);
					location.reload(true);
				});

		} else {
			return false;
		}
	});
});

function deleteconfig(id,tablname){
if (confirm('Are you sure want to remove it?') == true) {
			$.post('query.php', {
					'action': 'delete',
					tablname: tablname,
					id: id
				})
				.done(function (data) {
					alert(data);
					location.reload(true);
				});

		} else {
			return false;
		}
}

function preview_image(event) {
	var reader = new FileReader();
	reader.onload = function () {
		var output = document.getElementById('output_image');
		output.src = reader.result;
	}
	reader.readAsDataURL(event.target.files[0]);
}

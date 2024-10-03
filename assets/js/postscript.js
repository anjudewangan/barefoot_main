$(document).ready(function () {
	$(".TypeInt").on("keypress keyup blur", function (event) {
		$(this).val($(this).val().replace(/[^\d].+/, ""));
		if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});

	$("body").click(function () {
		$('.Inpt').html('');
	});



	/*==============post Form=========================*/
	$('.actionForm').on('submit', function (event) {
		$(".Inpt").html('');

		var formurl = $(".actionForm").attr('action');
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
					$('.' + data.class_name).html('<div class="toltipFrm stpstoltipfrm"><div class="arrow-up"></div>' + data.error + '</div>');
					$("#loadpost").hide();
					$('input[name="' + data.class_name + '"]').focus();
					$('select[name="' + data.class_name + '"]').focus();

				} else {

					if (data.step == 2) {
						$("#Register-div").hide();
						$("#Payment-div").show();
						$(".form_type").val('payment');
						$(".reg-now").prop('type', 'button');
						$(".resv-spot").prop('type', 'submit');
						$("#loadpost").hide();
					} else {
						if (data.payurl != '') {
							window.parent.location = data.payurl;
						} else {
							var toast = new iqwerty.toast.Toast();
							toast.setText(data.msg).show();
							setTimeout(function () {
								location.reload(true);
							}, 3000);
						}
					}
				}
			}
		})
	});

	$('.contactForm').on('submit', function (event) {
		$(".Inpt").html('');

		var formurl = $(".contactForm").attr('action');
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
				$("#cload").show();
			},
			success: function (data) {
				if (data.error) {
					$('.' + data.class_name).html('<div class="text-danger">' + data.error + '</div>');
					$("#cload").hide();
					$('input[name="' + data.class_name + '"]').focus();
					$('textarea[name="' + data.class_name + '"]').focus();

				} else {

					var toast = new iqwerty.toast.Toast();
					toast.setText(data.msg).show();
					setTimeout(function () {
						location.reload(true);
					}, 3000);
				}
			}
		})
	});

	var selectedCourse = '';
	var selectedPaymentMethod = '';
	var selectedPaymentPlan = '';

	// Handle Payment Method Selection and apply discount if it's "online"
	$('#course').on('change', function () {
		selectedCourse = $(this).val();

		// Display the payment-course dropdown
		var paymentCourse = $('#course_plan');
		paymentCourse.empty().append('<option value="" selected disabled>Choose Your Payment Plan</option>');
		paymentCourse.show();

		// Add payment options based on the selected course
		if (selectedCourse === 'Core Defend (Standard Course): 4 Weeks (8 sessions)') {
			paymentCourse.append('<option value="2500">Single Payment(₹2,500)</option>');
			paymentCourse.append('<option value="350">Pay Per Session(₹350)</option>');
			paymentCourse.append('<option value="6000">Discounted Group of 3(₹6,000)</option>');
		} else if (selectedCourse === 'Total Defend (Extended Course): 8 Weeks (16 sessions)') {
			paymentCourse.append('<option value="4500">Single Payment(₹4,500)</option>');
			paymentCourse.append('<option value="350">Pay Per Session(₹350)</option>');
			paymentCourse.append('<option value="11000">Discounted Group of 3(₹11,000)</option>');
		} else if (selectedCourse === 'Trial Class (1 Session)') {
			paymentCourse.append('<option value="350">Single Session Payment(₹350)</option>');
		}
		$('.pay_drop').show();
	});
});
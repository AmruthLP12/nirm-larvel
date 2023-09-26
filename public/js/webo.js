function show_user_login() {
	var modal1 = document.getElementById('user_login');
	modal1.style.display = "block";

	var modal = document.getElementById('myModal');
	modal.style.display = "none";
}
function show_login(id) {
	var modal1 = document.getElementById('user_login');
	modal1.style.display = "none";

	var modal = document.getElementById('myModal');
	modal.style.display = "block";
}
function close_popup() {
	var modal = document.getElementById('myModal');
	modal.style.display = "none";

	var modal1 = document.getElementById('user_login');
	modal1.style.display = "none";
}

function login() {
	username = $("#username").val();
	password = $("#password").val();

	jQuery.ajax({
		type: "POST",
		url: "ajax.php?f=login",
		datatype: "text",
		data: { username: username, password: password },
		success: function (response) {
			if (response == "success") {
				window.location = "client-details.php";
			}
			else {
				alert("Invalid Username or Password..!");
				$("#username").val("");
				$("#password").val("");
				$("#username").focus();
			}
		},
		error: function (xhr, ajaxOptions, thrownError) { }
	});
}
function user_login() {
	username = $("#user_username").val();
	password = $("#user_password").val();

	jQuery.ajax({
		type: "POST",
		url: "ajax.php?f=user_login",
		datatype: "text",
		data: { username: username, password: password },
		success: function (response) {
			if (response == "success") {
				window.location = "user-details.php";
			}
			else {
				alert("Invalid Username or Password..!");
				$("#user_username").val("");
				$("#user_password").val("");
				$("#user_username").focus();
			}
		},
		error: function (xhr, ajaxOptions, thrownError) { }
	});
}
function check_user_password() {
	pass = $("#user_pass").val();
	cpass = $("#user_cpass").val();
	if (pass != "" && cpass != "") {
		if (pass != cpass) {
			alert("Password Mismatched !");
			$("#user_pass").val("");
			$("#user_cpass").val("");
		}
	}
}
function candidate_login() {
	uname = $("#u_email").val();
	password = $("#pass").val();
	jQuery.ajax({
		type: "POST",
		url: "ajax.php?f=candidate_login",
		datatype: "text",
		data: { uname: uname, password: password },
		success: function (response) {
			if (response == "success") {
				location.href = "http://localhost/saravanan/nirm/Editing/v_1.2/apply-job/";
			}
			else {
				alert("Invalid Email or Password..!");
				$("#u_email").val("");
				$("#pass").val("");
				$("#u_email").focus();
			}
		},
		error: function (xhr, ajaxOptions, thrownError) { }
	});
}
function check_user_email_availability() {
	email = $("#candidate_email").val();
	jQuery.ajax({
		type: "POST",
		url: "ajax.php?f=check_user_email_availability",
		datatype: "text",
		data: { email: email },
		success: function (response) {
			if (response == "failed") {
				alert("Email already exists..!");
				$("#candidate_email").val("");
				$("#candidate_email").focus();
			}
		},
		error: function (xhr, ajaxOptions, thrownError) { }
	});
}
function check_user_phone_availability() {
	phone = $("#candidate_phone").val();
	jQuery.ajax({
		type: "POST",
		url: "ajax.php?f=check_user_phone_availability",
		datatype: "text",
		data: { phone: phone },
		success: function (response) {
			if (response == "failed") {
				alert("Phone no already exists..!");
				$("#candidate_phone").val("");
				$("#candidate_phone").focus();
			}
		},
		error: function (xhr, ajaxOptions, thrownError) { }
	});
}
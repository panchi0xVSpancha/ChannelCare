<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="../resource/css/register.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
		integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<title>Registration Form</title>

</head>

<body>
	<div class="background-img1"><img src="../resource/img/new/register.png" alt=""></div>
	<div class="logo"><img src="../resource/img/logo1.png" alt=""></div>
	<div class="container">
		<div class="para">
			<h1><b>U</b>ser <b>R</b>egistration</h1>
			<h2 style="text-align: center">Hurry Up and register!</h2>
			<p style="text-align: center">Are you <span>finding a boarding place? </span>this is the ideal platform for
				you. find the closest place you want.<br />Do you want to <span>advertise your boarding or food delivary
					service?</span> this is the ideal platform for you. Your customers are waiting for you! </p>
		</div>
		<div class="register">

			<form method="post" id="registerForm">
				<p>First Name <span class="error" id="firstError"></span></p>
				<input type="text" id="first_name" name="first_name" placeholder="Enter First Name">

				<p>Last Name <span class="error" id="lastError"></span></p>
				<input type="text" id="last_name" name="last_name" placeholder="Enter Last Name">

				<p>Address <span class="error" id="addressError"></span></p>
				<input type="text" id="address" name="address" placeholder="Enter Address">

				<p>Phone Number <span class="error" id="phoneNumberError"></span></p>
				<input type="text" id="phone_number" name="phone_number" placeholder="Enter Phone Number">

				<p>Email <span class="error" id="emailError"></span></p>
				<input type="email" id="email" name="email" placeholder="Enter Email">

				<p>Register as</p>
				<div class="radio">
					<input type="radio" name="level" value="patient" checked="checked" id="1">
					<label for="1">Patient</label>
				</div>
				<div class="radio">
					<input type="radio" name="level" value="doctor" id="2">
					<label for="2">Doctor</label>
				</div>
				<input type="submit" name="submit" value="Next">
			</form>
		</div>
	</div>
</body>
<script src="../resource/js/jquery.js"></script>
<script src="../resource/js/register.js"></script>

</html>
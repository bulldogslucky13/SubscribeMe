<?php
	error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Divisima | eCommerce Template</title>
	<meta charset="UTF-8">
	<meta name="description" content=" Divisima | eCommerce Template">
	<meta name="keywords" content="divisima, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">


	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/flaticon.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
	<link rel="stylesheet" href="css/jquery-ui.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<?php
		include "includes/header.php";
	?>
	<!-- Header section end -->


	<!--- Register section -->
	<section class="cart-section spad">
		<div class="container">
			<div class="row">
				<form class="register-form col-lg-10" action="" method="post">
					<div class="cart-table">
						<h3>Create an Account</h3>

								<?php
									require_once 'core/init.php';
									if(Input::exists()){
										if(Token::check(Input::get('token'))){
											echo "<div class=\"messages\"><h5>";
											$validate = new Validate();
											$validation = $validate->check($_POST, array(
												'first-name' => array (
													'name' => 'First Name',
													'required' => true,
													'min' => 2
												),
												'last-name' => array (
													'name' => 'Last Name',
													'required' => true,
													'min' => 2
												),
												'username' => array (
													'name' => 'Username',
													'required' => true,
													'min' => 8,
													'max' => 20,
													'unique' => 'users'
												),
												'email' => array (
													'name' => 'Email',
													'required' => true,
													'unique' => 'users'
												),
												'password' => array (
													'name' => 'Password',
													'required' => true,
													'min' => 8
												),
												'confirm-password' => array (
													'name' => 'Confirmed Password',
													'required' => true,
													'matches' => 'password',
													'min' => 8

												)
											));
											if($validation->passed()){
												//TODO: Register the user
												Session::flash('success', "Your account has been made! Check your email for a confirmation link from us. <a href='login.php' style='color: black;'>Login</a>");
												if(Session::exists('success')){
													echo Session::flash('success');
												}
											} else {
												echo "<h5>The following errors have occurred:</h5><ul>";
												foreach($validation->errors() as $error){
													echo "<li>" . $error. "</li>";
												}
												echo "</ul>";
											}
											echo "</h5></div>";
										}
									}
								?>
						<div class="cart-table-warp" style="padding-top: 24px;">
							<table>
							<tbody>
								<tr>
									<input type="text" name="first-name" class="first-name" id="first-name" placeholder = "First Name" value="<?php echo escape(Input::get('first-name')) ?>">
									<input type="text" name="last-name" class="last-name" id="last-name" placeholder = "Last Name" value="<?php echo escape(Input::get('last-name')) ?>">
								</tr>
								<tr>
									<input type="text" name="username" id="username" placeholder="Username" value="<?php echo escape(Input::get('username')) ?>">
								</tr>
								<tr>
									<input type="text" name="email" id="email" placeholder="Email" value="<?php echo escape(Input::get('email')) ?>">
								</tr>
								<tr>
									<input type="password" name="password" id="password" placeholder = "Password" value="<?php echo escape(Input::get('password')) ?>">
									<input type="password" name="confirm-password" id="confirm-password" placeholder = "Confirm Password" value="<?php echo escape(Input::get('confirm-password')) ?>">
								</tr>
							</tbody>
						</table>
						</div>
						<div class="register-button">
							<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
							<input type="submit" name="register" id="register" value="Register">
						</div>
					</div>
				</form>
			</div>
				<div class="row">
					<form class="register-form col-lg-10" action="register.php" method="post">
						<div class="cart-table">
							<h3>Create Account with Social Media</h3>
							<div class="cart-table-warp">
								<div class="social-media-login" style="padding-left: 20%;">
									<div class="btn"><a href="#" class="login-facebook"><i class="fa fa-facebook"></i> Login via Facebook</a></div>
									<div class="btn"><a href="#" class="login-google"><i class="fa fa-google"></i> Sign in with Google</a></div>
									<div class="btn"><a href="#" class="login-twitter"><i class="fa fa-twitter"></i> Login via Twitter</a></div>
								</div>
							</div>
						</div>
					</div>
		</div>
	</section>
	<!-- register section end -->
	<!-- Footer section -->
	<?php
		include "includes/footer.php";
	?>
	<!-- Footer section end -->


	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>

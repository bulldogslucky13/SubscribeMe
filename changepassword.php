<?php
	require_once 'core/init.php';
	$user = new User();
	if (!$user->isLoggedIn()) {
		Redirect::to('index.php');
	}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>SubscribeMe</title>
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
	<!-- Page Preloder
	<div id="preloder">
		<div class="loader"></div>
	</div>
-->

	<!-- Header section -->
	<?php
		include "includes/header.php";
	?>
	<!-- Header section end -->


	<!-- update section -->
	<section class="cart-section spad">
		<div class="container">
			<div class="row">
				<form class="login-form col-lg-10" action="" method="post">
					<div class="cart-table">
						<h3>Update Account</h3>
						<?php
							if (Input::exists()) {
								if (Token::check(Input::get('token'))) {
										echo "<div class=\"messages\">";
										$validate = new Validate();
										$validation = $validate->check($_POST, array(
											'password_current' => array(
												'name' => 'current password',
												'required' => true
											),
											'password_new' => array(
												'name' => 'new password',
												'required' => true,
												'min' => 6

											),
											'password_new_again' => array(
												'name' => 'Re-typed new password',
												'required' => true,
												'min' => 6,
												'p_matches' => 'password_new'
											)
										));
										if ($validation->passed()) {
											if (Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
												echo "<h5>The following errors have occurred:</h5><ul><li>Your current password is wrong.</li></ul>";
											} else {
												$salt = Hash::salt(32);
												$user->update(array(
													'password' => Hash::make(Input::get('password_new'), $salt),
													'salt' => $salt
												));
												echo "<div class=\"messages\"><h5>Your password has been successfully updated!</h5></div>";
											}
										} else {
											echo "<h5>The following errors have occurred:</h5><ul>";
											foreach($validation->errors() as $error){
												echo "<li>" . $error. "</li>";
											}
											echo "</ul>";
										}
										echo "</div>";
								}
							}
						?>
						<div class="cart-table-warp" style="padding-top: 24px;">
							<table>
							<tbody>
									<tr>
										<label>Current Password</label><input type="password" name="password_current" id="password_current">
									</tr>
								<tr>
									<label>New Password</label><input type="password" name="password_new" id="password_new">
								</tr>
								<tr>
									<label>Re-type Password</label><input type="password" name="password_new_again" id="password_new_again">
								</tr>
							</tbody>
						</table>
						</div>
						<div class="login-button">
							<input type="submit" value="Update">
							<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

						</div>
					</div>
				</form>
			</div>
				<div class="row">
					<form class="register-form col-lg-10" action="register.php" method="post">
						<div class="cart-table">
							<h3>Link Social Media</h3>
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
	<!-- update section end -->
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

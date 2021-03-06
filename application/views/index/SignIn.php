<?php include_once "header-sign.php";?>

<body class="state-login">
	<main class="flex-wrapper">
<!--
	<section class="section section--login-left">
		<form action="/action_page.php">
			sdfdss
		</form>
	</section>
	<section class="section section--login-right">

	</section>
-->
<div class="container container-fluid">
	<div class="row row-no-margin">
		<div class="col-sm-6 col-xs-12 col-no-padding col-login-left">
			<section class="section section-login">
				<h1 class="heading-h1 heading-tac heading-login-top">Petsfame logo</h1>
				<img src="img/login-picture.jpeg" alt="" class="image image-login-mobile hidden-sm hidden-md hidden-lg">
				<div class="section-login-form-wrapper">
					<form action="" method="post">
						<h1 class="heading-h1 heading-no-margin heading-tac">Welcome back!</h1>
						<p class="paragraph paragraph-no-margin paragraph-underheader"> Sign in to your account here:</p>
						<p class="authorization_error"><?php  $error = authorization(); echo $error;?></p>
						<label for="login-email">
							<?php 

							if ($error == "Password incorrect!") {?>
							<input id="login-email" placeholder="Email Address" name="login-email" type="email" class="input input-full-width" value="<?= $_SESSION['login-email'];?>">
							<?php } else{?>
							<input id="login-email" placeholder="Email Address" name="login-email" type="email" class="input input-full-width">
							<?php } ?>
							
						</label>
						<label for="login-password">
							<input id="login-password" placeholder="Password" name="login-password" type="password" class="input input-full-width">
						</label>
						<p class="paragraph paragraph-forgotten-pass tar">
							<a href="restore" class="link link-blue ">Forgotten password?</a>
						</p>
						<input type="submit" name="authorize" class="button button-full-width button-cta-green" value="Sign in">
					</form>
					<div class="flex-wrapper flex-wrapper-jc-space-between flex-wrapper-or">
						<hr class="hr hr-or">
						<p class="paragraph paragraph-or tac">
							Or continue with
						</p>
						<hr class="hr hr-or">
					</div>
					<div class="flex-wrap flex-wrapper-jc-space-between">
						<?php  require_once $_SERVER['DOCUMENT_ROOT']. "/application/models/sign-network.php";?>
					</div>
				</div>
				<p class="paragraph tac paragraph-login-bottom">Don’t have an account? <a href="SignUp" class="link link-blue">Sign Up</a></p>
			</section>
		</div>
		<div class="col-sm-6 hidden-xs col-no-padding">
			<section class="section section-login-image">
				<img src="img/login-picture.jpeg" alt="" class="image ">
			</section>
		</div>
	</div>
</div>
</main>



<!-- Optimized loading JS Start -->

<!-- <script>
	var scr = {"scripts":[
	{"src" : "js/libs.min.js", "async" : false},
	{"src" : "js/common.js", "async" : false}
	]};!function(t,n,r){"use strict";var c=function(t){if("[object Array]"!==Object.prototype.toString.call(t))return!1;for(var r=0;r<t.length;r++){var c=n.createElement("script"),e=t[r];c.src=e.src,c.async=e.async,n.body.appendChild(c)}return!0};t.addEventListener?t.addEventListener("load",function(){c(r.scripts);},!1):t.attachEvent?t.attachEvent("onload",function(){c(r.scripts)}):t.onload=function(){c(r.scripts)}}(window,document,scr);
</script> -->


<!-- Optimized loading JS End -->

</body>
</html>

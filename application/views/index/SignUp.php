<?php include_once "header-sign.php"; ?>


<body class="state-signup">
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
					<form name="myForm" action="" method="POST" id="signup" onsubmit="return validateForm();">
						<h1 class="heading-h1 heading-no-margin heading-tac">Welcome to Pets Overload</h1>
						<p class="paragraph paragraph-no-margin paragraph-underheader"> Sign Up to get into the world of dogs</p>
						<?php
						 //  Если есть ОШИБКА
						if(isset($_SESSION['msg'])){
							echo "<p class='authorization_error'>" .$_SESSION['msg'] . "</p>";
							unset ($_SESSION['msg']);} 
							?>
							<label for="signup-name">
								<input id="signup-name" placeholder="Your name" name="signup-name" type="text" class="input input-full-width">
							</label>
							<label for="signup-email">
								<input id="signup-email" placeholder="Email Address" name="signup-email" type="email" class="input input-full-width">
							</label>
							<label for="signup-password">
								<input title="Password must contain at least 8 characters, including UPPER/lowercase and numbers" id="signup-password" placeholder="Password" name="signup-password" type="password" class="input input-full-width" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');">
							</label>
							<label for="signup-location">
								<input id="signup-location" placeholder="Your Location" name="signup-location" type="text" class="input input-full-width">
							</label>

							<div class="settings-row settings-row-with-link">
								<p class="link link-green" onclick="getLocation_signUp()" id="getLocation_signUp">Define my location</p>
							</div>
							<input type="submit" name="signup-reg" class="input button button-full-width button-cta-green" value="Sign in">
						</form>
						

					</div>
					<p class="paragraph tac paragraph-login-bottom">Already have an account? <a href="SignIn" class="link link-blue">Sign In </a></p>
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

<script>
	function validateForm() {
		var x = document.forms["myForm"]["signup-email"].value;
		var atpos = x.indexOf("@");
		var dotpos = x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			alert("Not a valid e-mail address");
			return false;
		}
	}
</script>

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

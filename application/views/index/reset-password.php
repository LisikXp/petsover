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
				<img src="/img/login-picture.jpeg" alt="" class="image image-login-mobile hidden-sm hidden-md hidden-lg">
				<div class="section-login-form-wrapper">
					<form action="" method="post">
						<h1 class="heading-h1 heading-no-margin heading-tac">Reset Your Password</h1>
						<p></p>
						<label for="login-email">
							<input class="input input-full-width" title="Password must contain at least 8 characters, including UPPER/lowercase and numbers" type="password" class="input" id="settings-location" placeholder="Enter your new password" name="new_password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');if(this.checkValidity()) form.Re_Type_password.pattern = this.value;">
						</label>
						<label for="login-password">
							<input class="input input-full-width" title="Please enter the same Password as above" type="password" class="input" id="settings-location" placeholder="Re-Type New Password" name="Re_Type_password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');">
						</label>
						<p></p>
						<input type="submit" class="button button-full-width button-cta-green" name="reset_pwd" value="Change password">
					</form>
					
				</section>
			</div>
			<div class="col-sm-6 hidden-xs col-no-padding">
				<section class="section section-login-image">
					<img src="/img/login-picture.jpeg" alt="" class="image ">
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

<!-- <form action="" method="post">
					<h1 class="heading-h1 heading-no-margin heading-tac">Reset Your Password</h1>
					
					<label for="login-email">New Password
						<input title="Password must contain at least 8 characters, including UPPER/lowercase and numbers" type="password" class="input" id="settings-location" placeholder="Enter your new password" name="new_password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');if(this.checkValidity()) form.Re_Type_password.pattern = this.value;">
					</label>
					<label for="login-password">Re-Type New Password
						<input title="Please enter the same Password as above" type="password" class="input" id="settings-location" placeholder="Enter your new password once again" name="Re_Type_password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');">
					</label>
					<p></p>
					<input type="submit" class="link button button-cta-green contest-button" name="reset_pwd" value="Change password">
				</form> -->
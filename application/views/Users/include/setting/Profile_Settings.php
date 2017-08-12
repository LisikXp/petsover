<?php require_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include/header/header-singl.php"; ?>
<main class="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-3  col-sm-3-custom-left">
				<a href="<?= $home;?>" class="link link-gray back-to-section-link"> Back to profile</a>
				<p class="category-subname">Account Settings</p>
				<ul class="list category-list">
					<li class="list-item">
						<a href="#" class="link link-with-avatar">Account Settings</a>
					</li>
					<li class="list-item">
						<a href="#" class="link link-with-avatar">Notifications</a>
					</li>
				</ul>
				<p class="category-subname">
					Profile Settings
				</p>
				<ul class="list category-list">
					<li class="list-item list-item-with-image">
						<a href="#" class="link link-with-avatar link-with-avatar-current"><?= $owner_name;?></a>
					</li>
				</ul>
				<a href="#" class="link link-green">+ Add a pet</a>
			</div>
			<div class="col-sm-6 col-sm-6-custom">
				<div class="tile">
					<div class="settings">
						<form action="" method="post">
							<h3 class="heading-h3 category-name no-margin">
								Login Email
							</h3>
							<hr class="hr-full-width hr-body">
							<fieldset>
								<div class="settings-row">
									<label for="settings-username"> Email Address </label>
									<input type="text" class="input" id="settings-username" placeholder="Username" value="<?= $myaacountuser['email'];?>" name="email">
								</div>
							</fieldset>
							<h3 class="heading-h3 category-name no-margin category-name-mt">
								Change Password
							</h3>
							<hr class="hr-full-width hr-body">
							<fieldset>
								<div class="settings-row">
									<label for="settings-username"> Current Password </label>
									<input type="password" class="input" id="settings-username" placeholder="Enter your current password" name="curr_password" >
								</div>
								<div class="settings-row">
									<label for="settings-username">New Password</label>
									<input title="Password must contain at least 8 characters, including UPPER/lowercase and numbers" type="password" class="input" id="settings-location" placeholder="Enter your new password" name="new_password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');if(this.checkValidity()) form.Re_Type_password.pattern = this.value;">
								</div>
								<div class="settings-row">
									<label for="settings-username">Re-Type New Password</label>
									<input title="Please enter the same Password as above" type="password" class="input" id="settings-location" placeholder="Enter your new password once again" name="Re_Type_password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');">
								</div>
							</fieldset>
							<h3 class="heading-h3 category-name no-margin  category-name-mt">
								Social Networks
							</h3>
							<hr class="hr-full-width hr-body">
							<fieldset>
								<div class="settings-row">
									<label for="settings-username">Facebook</label>
									<input type="text" class="input" id="settings-username" placeholder="Enter a link to your facebook account" name="facebook" value="<?= $mynetwork['facebook'];?>">
								</div>
								<div class="settings-row">
									<label for="settings-username">Twitter</label>
									<input type="text" class="input" id="settings-location" placeholder="Enter a link to your twitter account" name="twitter" value="<?= $mynetwork['twitter'];?>">
								</div>
								<div class="settings-row">
									<label for="settings-username">Instagram</label>
									<input type="text" class="input" id="settings-location" placeholder="Enter a link to your instagram account" name="instagram" value="<?= $mynetwork['instagram'];?>">
								</div>
								<div class="settings-row">
									<label for="settings-username">Tumblr</label>
									<input type="text" class="input" id="settings-location" placeholder="Enter a link to your tumblr account" name="tumblr" value="<?= $mynetwork['tumblr'];?>">
								</div>
								<div class="settings-row">
									<label for="settings-username">Google+</label>
									<input type="text" class="input" id="settings-location" placeholder="Enter a link to your google plus account" name="google" value="<?= $mynetwork['google'];?>">
								</div>

							</fieldset>
							<h3 class="heading-h3 category-name no-margin category-name-mt">
								Delete Account
							</h3>
							<hr class="hr-full-width hr-body">
							<fieldset>
								<div class="delete-account-message">
									<p>Lorem ipsum porta, nec molestie risus justo, eu vulputate, sagittis eget ultricies eros sagittis nibh, elementum, justo eu urna proin lectus, porttitor.</p>
									<p>
										Eu malesuada arcu quisque sapien sodales quam nibh eget congue cursus enim a nam lorem curabitur orci at, nec. Vivamus rutrum bibendum molestie — morbi risus a magna nec ligula enim. Rutrum donec eu rutrum ut justo lorem proin eu sodales rutrum commodo enim fusce orci donec integer, in — at.
										<a href="#" class="delete-link">Request Deleting Account</a>
									</p>
								</div>
							</fieldset>

							<hr class="hr-full-width hr-body">
							<div class="settings-action-button">
								<a href="#" class="link link-gray">
									Cancel
								</a>
								<input type="submit" class="link button button-cta-green contest-button" name="save_setting" value="Save changes">
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-3  col-sm-3-custom-right">

				<div class="banner">
					<img src="http://via.placeholder.com/270x240" alt="" class="banner-content">
				</div>
				<div class="follow">
					<?php require_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include/tofollow/follow-dogs.php"; ?>
				</div>

				<?php require_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include/footer.php"; ?>
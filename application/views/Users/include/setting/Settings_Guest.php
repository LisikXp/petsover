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
						<a href="#" class="link link-with-avatar link-with-avatar-current"><?= $user_name;?></a>
					</li>
				</ul>
				<a href="add_pets" class="link link-green">+ Add a pet</a>
			</div>
			<div class="col-sm-6 col-sm-6-custom">
				<div class="tile">
					<div class="settings">
						<h3 class="heading-h3 category-name no-margin">
							Owner
						</h3>
						<hr class="hr-full-width hr-body">
						
						<fieldset>
							<form action="">
								<div class="settings-row">
									<label for="settings-username"> Username </label>
									<input type="text" class="input" id="settings-username" placeholder="Username" value="<?= $user_name;?>">
								</div>
								<div class="settings-row">
									<label for="settings-username"> Location </label>
									<input type="text" class="input" id="signup-location" placeholder="Location" value="<?= $location;?>">
								</div>
							</form>
							<div class="settings-row settings-row-with-link">
								<button class="link link-green" onclick="getLocation()">Define my location</button>
							</div>
						</fieldset>

						<hr class="hr-full-width hr-body">
						<div class="settings-action-button">
							<a href="#" class="link link-gray">
								Cancel
							</a>
							<input type="submit" class="link button button-cta-green contest-button" name="save_setting_guest" id="save_setting_guest" value="Save changes">
						</div>

					</div>
				</div>
				<div class="tile">
					<div class="welcome">
						<div class="welcome-image">
							<img src="img/welcome-dog.png" alt="welcome" class="image">
						</div>
						<p class="welcome-message tac ">
							<p class="tac">Looks like you have a guest profile. That means you cannot post anything until you add at least one pet to your account.</p>
						</p>
						<div class="welcome-button">
							<a href="#" class="link button button-cta-green contest-button">+ Add a pet</a>
						</div>
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
<?php require_once "header/header-singl.php";?>
<main class="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-3  col-sm-3-custom-left">

				<?php require_once "sidebar/guest-sidebar.php"; ?>
				
			</div>
			<div class="col-sm-6 col-sm-6-custom">
				
				
				<?php if ($mypage == $uid) {?>
					<div class="tile">
						<div class="welcome">
							<div class="welcome-image">
								<img src="/img/welcome-dog.png" alt="welcome" class="image">
							</div>
							<p class="welcome-message tac ">
								<h3 class="heading-h3 tac">Welcome to Petsfame <span class="welcome-name"><?php echo $user_name;?></span>,</h3>
								<p class="tac">Looks like you have a guest profile. That means you cannot post anything until you add at least one pet to your account.</p>
							</p>
							<div class="welcome-button">
								<a href="#" class="link button button-cta-green contest-button popup-trigger" data-popup-id="<?= $setting->cheking_a_family($name);?>">+ Add a pet</a>
							</div>
						</div>
					</div>
					<?php } ?>
					
					
					<?php if ($mypage == $uid) { ?>
					<div class="tile tile_invite">
						<?php require_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/invite.php"; ?>
					</div>
					<?php } ?>
				</div>
				<div class="col-sm-3 col-sm-3-custom-right">

					<div class="banner">
						<img src="http://via.placeholder.com/270x240" alt="" class="banner-content">
					</div>
					<div class="follow">
						<?php require_once "tofollow/follow-dogs.php"; ?>
					</div>
					<?php require_once "footer.php"; ?>

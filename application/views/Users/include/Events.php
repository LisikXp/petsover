<?php require_once "header/header-singl.php";?>

<main class="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-3  col-sm-3-custom-left">
				
				<?php require_once "sidebar/sidebar.php"; ?>
				
			</div>
			<div class="user_wall_event col-sm-6 col-sm-6-custom">
				<h3 class="heading heading-h3 heading-no-margin">Events</h3>
				<hr class="hr-full-width">
				<ul class="user_wall user_wall_event" id="user_wall" data-user="<?= $get_id;?>">
					<?php 
					$notifi->get_all_event_page();
					?>
				</ul>
		<!-- 		<?php if ($Wall->get_all_count_post($get_id) <= 20 ) {?>

				<?php } else { ?>

				<button class="link link-green tac block view_more_post" id="view_more_post" data-count="<?php echo $Wall->get_all_count_post($get_id);?>">View more</button>
				<hr class="hr-full-width">
				<?php } ?> -->
			</div>
			<div class="col-sm-3 col-sm-3-custom-right">
				<?php require_once "contest/contest-main.php"; ?>
				<div class="banner">
					<img src="http://via.placeholder.com/270x240" alt="" class="banner-content">
				</div>
				<div class="follow">
					<?php require_once "tofollow/follow-dogs.php"; ?>
				</div>
				
				<?php require_once "footer.php"; ?>

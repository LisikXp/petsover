<?php require_once "header/header-singl.php";?>
<main class="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-3  col-sm-3-custom-left">
				<?php require_once "sidebar/sidebar-main.php"; ?>
			</div>
			<div class="col-sm-6 col-sm-6-custom">
				<div class="tile">
					<h3 class="heading heading-h3 heading-no-margin"><?= $follow->followers_count($get_id);?> Followers of <?= $user_name;?></h3>
					<hr class="hr hr-full-width hr-body">
					<ul class="list followers">
						<?php
						
						$follow->get_follow(0, 10);

						?>
					</ul>
					<hr class="hr-full-width">
					<?php if ($follow->followers_count($get_id) < 10) {
						# code...
					}else{?>
					<a href="#" class="link link-green tac block" id="more_follow" data-count="<?= $follow->followers_count($get_id);?>">View 10 more</a>
					<?php } ?>
					
				</div>
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

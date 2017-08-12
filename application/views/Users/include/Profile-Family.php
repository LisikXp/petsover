<?php require_once "header/header-singl.php";?>

<main class="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-3  col-sm-3-custom-left">
				
				<?php require_once "sidebar/sidebar.php"; ?>
				
			</div>
			<div class="col-sm-6 col-sm-6-custom">
				<?php if ($get_id == $mypage) {?>
				<div class=" tile"><?php
					require_once "new-post.php";?>
				</div> 
				<?php	} ?>
				<ul class="user_wall" id="user_wall" data-user="<?= $get_id;?>">
					<?php 
					$Wall->get_posts($_GET['id'], 0, 20);
					?>
				</ul>
				<?php if ($Wall->get_all_count_post($get_id) <= 20 ) {?>

				<?php } else { ?>

				<button class="link link-green tac block view_more_post" id="view_more_post" data-count="<?php echo $Wall->get_all_count_post($get_id);?>">View more</button>
				<hr class="hr-full-width">
				<?php } ?>
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

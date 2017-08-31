<?php require_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include/header/header-singl.php";?>
<main class="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-3  col-sm-3-custom-left">
				<?php require_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include/sidebar/discover-sidebar.php";?>
			</div>
			<div class="col-sm-6 col-sm-6-custom">
				<div class="tile">
					<h3 class="heading heading-h3 heading-no-margin">WHO TO FOLLOW</h3>
					<hr class="hr hr-full-width hr-body">
					<ul class="list followers" id="discover_list">
						<?php
						
						$valuation->get_all_list_users(0, 10);

						?>
					</ul>
					<hr class="hr-full-width">
					<?php if ($valuation->get_count_user()<10) {?>
					
					<?php }else{?>
					<a href="#" class="link link-green tac block" id="whotofollow_view" data-count="<?= $valuation->get_count_user();?>">View 10 more</a>
					<?php } ?>
					
					
					
				</div>
			</div>
			<div class="col-sm-3 col-sm-3-custom-right">
				<?php require_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include/contest/contest-main.php"; ?>
				<div class="banner">
					<img src="http://via.placeholder.com/270x240" alt="" class="banner-content">
				</div>
				<div class="follow">
					
				</div>
				<?php require_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include/footer.php"; ?>

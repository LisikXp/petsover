<?php require_once "header/header-singl.php";?>
<main class="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-3  col-sm-3-custom-left">
				<sidebar class="sidebar search-filter">
					<?php require_once "sidebar/discover-sidebar.php";?>
				</sidebar>
			</div>
			<div class="col-sm-6 col-sm-6-custom">
				<div class="tile">
					<h3 class="heading heading-h3 heading-no-margin">Discover</h3>
					<hr class="hr-full-width">
					<ul class="list discover">
						<?php $discover->get_wall_discover();?>
					</ul>
					
					<?php if ($discover->max < 10) {?>

					<?php } else{ ?>
					<hr class="hr-full-width">
					<button class="link link-green tac block" id="discover_view" data-count="<?= $discover->max;?>">View 10 more</button>
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
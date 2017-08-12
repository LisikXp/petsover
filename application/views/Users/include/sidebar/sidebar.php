				<sidebar class="sidebar tile">
					<div class="userprofile userprofile-family">
						<!-- 
							userprofile-image my-profile-image -->

						<div class="userprofile-image">
							<img src="<?php echo $user_photo;?>" alt="" class="image my-profile-image-change">
							<?php if ($mypage == $get_id) { ?>
							<img src="img/photo.svg" alt="" class="my-profile-image hidden">
							<?php } ?>
						</div>
						<h3 class="heading-h3 userprofile-name">
							<?php echo $user_name;?>
						</h3>
						<p class="userprofile-count">
							<?php echo $mbreed;?>
						</p>
						<a href="Discover?location=<?php echo str_replace(' ', '+', $location); ?>" class="link link-blue userprofile-location"><?php echo $location;?></a>
						<?php 
						$setting->check_family_by_setting($get_id);
						?>
						<div class="userprofile-counters counters flex-wrapper ">
							<?php
							$Wall->get_count_post($get_id);
							$follow->count_follow_me($get_id);
							$follow->count_followers_me($get_id);
							?>
						</div>
						<div class="family">
							<?php if (!is_numeric($get_id)) { ?>

							<div class="flex-wrapper flex-wrapper-jc-space-between">
								<h3 class="heading heading-h3 family-heading">Family members</h3>
							</div>
							<hr class="hr  hr-full-width hr-full-width hr-full-width-exp family-hr">
							<ul class="list follow-dogs">
								<?php $family->get_family_list($get_id); ?>
								<li class="list-item follow-dog follow-dog-owner" id="Owner">
									<div class="flex-wrapper">
										<div class="follow-dog-image">
											<a href="user?id=<?= $owner; ?>">
												<img src="<?php echo $maine_photo;?>" alt="dog picture" id="Owner">
											</a>
										</div>
										<div class="follow-dog-description">
											<a href="user?id=<?= $owner; ?>">
												<p class="follow-dog-name">
													<?php echo $owner;?>
												</p>
											</a>
											<p class="follow-dog-breed">
												Owner
											</p>
										</div>
									</div>
									<div class="owner-contacts">

										<?php require_once "network-link.php";?>
										
									</div>
								</li>
							</ul>

							<?php } else { ?>

							<ul class="list follow-dogs">
								<li class="list-item follow-dog follow-dog-owner">
									<div class="flex-wrapper">
										<div class="follow-dog-image">
											<a href="user?id=<?= $owner; ?>">
												<img src="<?php echo $maine_photo;?>" alt="dog picture">
											</a>
										</div>
										<div class="follow-dog-description">
											<a href="user?id=<?= $owner; ?>">
												<p class="follow-dog-name">
													<?php echo $owner;?>
												</p>
											</a>
											<p class="follow-dog-breed">
												Owner
											</p>
										</div>
									</div>
									<div class="owner-contacts">
										
										<?php require_once "network-link.php";?>
										
									</div>
								</li>
							</ul>

							<?php } ?>

						</div>
					</div>
				</sidebar>
				<?php if ($mypage == $get_id) { ?>
				<a href="#" class="link button button-cta-green button-full-width contest-button popup-trigger" data-popup-id="<?= $setting->cheking_a_family($name);?>">+ Add another pet</a>
				<?php } ?>
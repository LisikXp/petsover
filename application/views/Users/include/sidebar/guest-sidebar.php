				<sidebar class="sidebar tile">
					<div class="userprofile userprofile-family">
						<h3 class="heading-h3 userprofile-name">
							<?php echo $user_name;?>
						</h3>

						<a href="Discover?location=<?php echo str_replace(' ', '+', $location); ?>" class="link link-blue userprofile-location"><?php echo $location;?></a>
						<?php if ($_SESSION['user_id'] == $uid) { ?>
						<a href="Settings" class="link button button-full-width userprofile-edit-button  button-cta-gray ">Edit profile</a>
						<?php } else{ 

						} ?>
						<div class="userprofile-counters counters flex-wrapper ">
							<?php $follow->count_follow_me($uid);?>
						</div>
					</div>
				</sidebar>
				<?php if ($_SESSION['user_id'] == $uid) { ?>
				<a href="#" class="link button button-cta-green button-full-width contest-button popup-trigger" data-popup-id="<?= $setting->cheking_a_family($name);?>">+ Add a pet</a>
				<?php } else{ } ?>
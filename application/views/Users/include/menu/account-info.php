							<div class="flex-wrapper por">
								<div class="account-text">
									<h3 class="account-text-name">
										<?php echo $name;?>
									</h3>
									<p class="account-text-breed">
										<?php echo $breed;?>
									</p>
								</div>
								<div class="account-image">
									<img src="<?php echo $photo;?>" alt="pet-image">
								</div>
								<div class="account-dropdown-arrow">
								</div>

								<div class="tile account-choice-dropdown hidden dropdown">
									<ul class="list follow-dogs ">
										<li class="list-item account-action">
											<p class="no-margin">
												Account Settings
											</p>
										</li>
										<li class="list-item account-action">
											<form action="" method="POST">
												<input id="logout" name="LogUot" value="Log out" type="submit">
											</form>
										</li>
									</ul>
								</div>


							</div>
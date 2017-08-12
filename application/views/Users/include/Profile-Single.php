<?php require_once "header/header-main.php";?>
<main class="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-3  col-sm-3-custom-left">
				<sidebar class="sidebar tile">
					<div class="userprofile userprofile-family">
						<div class="userprofile-image">
							<img src="<?php echo $user->user_photo;?>" alt="" class="image">
						</div>
						<h3 class="heading-h3 userprofile-name">
							<?php echo $user->dog_name;?>
						</h3>
						<p class="userprofile-count">
							<?php echo $user->breed;?>
						</p>
						<a href="#" class="link link-blue userprofile-location"><?php echo $user->location;?></a>
						<p class="userprofile-count" style="margin-top: -10px; margin-bottom: 10px;">
							<?php echo $user->sex .", Age ".  $user->birthday;?>
						</p>
						<?php if ($_SESSION['user_id'] == $_GET['id']) { ?>
						<a href="#" class="link button button-full-width userprofile-edit-button  button-cta-gray ">Edit profile</a>
						<?php } else{ 

						}?>
						<div class="userprofile-counters counters flex-wrapper ">
							<?php
							$Wall->get_count_post($_GET['id']);
							$follow->count_follow_me($_GET['id']);
							$follow->count_followers_me($_GET['id']);
							?>
							
						</div>
						<div class="family">

							<ul class="list follow-dogs">
								<li class="list-item follow-dog follow-dog-owner">
									<div class="flex-wrapper">
										<div class="follow-dog-image">
											<img src="<?php echo $user->maine_photo;?>" alt="dog picture">
										</div>
										<div class="follow-dog-description">
											<p class="follow-dog-name">
												<?php echo $user->user_name;?>
											</p>
											<p class="follow-dog-breed">
												Owner
											</p>
										</div>
									</div>
									<div class="owner-contacts">
										<div class="owner-contacts-fb">
											<a href="#" class="link link-black">/jennydoe</a>
										</div>
										<div class="owner-contacts-tw">
											<a href="#" class="link link-black">/j.doe</a>
										</div>
										<div class="owner-contacts-gp">
											<a href="#" class="link link-black">/jenny</a>
										</div>
									</div>
								</li>

							</ul>
						</div>
					</div>
				</sidebar>
				
				<a href="#" class="link button button-cta-green button-full-width contest-button">+ Add another pet</a>
				
			</div>
			<div class="col-sm-6 col-sm-6-custom">
				<div class=" tile">
					<div class="newpost">
						<img src="<?php echo $user_photo;?>" alt="" class="newpost-avatar" id="newpost-avatar">
						<form action="comment" class="newpost-form">
							<textarea id="text_set" maxlength="400" rows="1" onkeyup="auto_grow(this)" class="newpost-text" placeholder="Share something with your followers"></textarea>
						</form>
						<div class="newpost-active-part hidden">

							<div class="attach hidden">
								<hr class="hr  hr-full-width hr-full-width hr-full-width-exp family-hr">
								<div class="attach-image">
									<img src="img/attach2.png" alt="" class="image ">
									<button class="attach-image-close">
										<img src="img/red-cross.svg" alt="" class="image">
									</button>
								</div>
								<div class="attach-image">
									<img src="img/attach2.png" alt="" class="image ">
									<button class="attach-image-close">
										<img src="img/red-cross.svg" alt="" class="image">
									</button>
								</div>
								<div class="attach-image attach-image-placeholder">

								</div>
							</div>
							<hr class="hr  hr-full-width hr-full-width hr-full-width-exp family-hr">
							<div class="flex-wrapper flex-wrapper-jc-space-between">
								<div class="flext-wrapper-left-side">
									<button class="link button userprofile-edit-button  button-cta-gray post-button post-button-upload-photos">
										<img src="img/photo.svg" alt="" class="image sub">
										<span>Upload photos</span>
									</button>
									<button class="link button userprofile-edit-button  button-cta-gray post-button">
										<img src="img/video.svg" alt="" class="image sub">
										<span>Upload videos</span>
									</button>
								</div>
								<div class="flex-wrapper-right-side flex-wrapper">
									<div class="post-account-menu flex-wrapper">
										<div class="account-image">
											<img src="<?php echo $user_photo;?>" alt="pet-image" class="image" id="account-image">
										</div>
										<div class="account-dropdown-arrow"></div>
										<div class="tile account-choice-dropdown hidden">
											<p class=" account-choice-dropdown-title">Liking and commenting as:</p>
											<ul class="list follow-dogs">
											<?php $user->get_account_choice($id);?>
											</ul>
										</div>
									</div>
									<input type="submit" id="send" class="link button button-cta-green contest-button post-button" value="Send">
								</div>
							</div>
						</div>
					</div>
				</div>
				<ul class="user_wall" id="user_wall">
					<?php 
					$Wall->get_posts($_GET['id']);
					?>
					<!-- <div class="tile">
						<div class="post">
							<a href="#" class="link post-dots">
								<img src="img/dots.svg" alt="" class="image">
							</a>
							<div class="flex-wrapper">
								<div class="post-dog-image">
									<img src="img/Bailey.png" alt="dog picture">
								</div>
								<div class="post-dog-description">
									<p class="post-dog-name">
										Charley
									</p>
									<p class="post-dog-time">
										20 min
									</p>
								</div>
							</div>
							<p class="post-text">
								Just look at me. Pure Labrador’s patience…
							</p>
							<div class="post-images-container two-images">
								<img src="img/Labrador%20patience.png" class="image" alt="post photo">
								<img src="img/Labrador%20patience.png" class="image" alt="post photo">
							</div>
							<div class="post-action flex-wrapper flex-wrapper-jc-space-between">
								<div class="post-rating">
									<a href="#" class="link link-green highpawes">15 <span class="hidden-sm hidden-xs">High Pawes!</span></a>
								</div>
								<div class="right-part flex-wrapper">
									<div class="post-comment">
										<a href="#" class="link link-gray comments">1 <span class="hidden-sm hidden-xs">Comment</span></a>
									</div>
									<div class="post-share">
										<a href="#" class="link link-gray share">Share</a>
										<ul class="tile list  share-list flex-wrapper hidden">
											<li class="list-item share-list-item">
												<a href="#" class="link">
													<img src="img/facebook_icon_dark.svg" alt="fb" class="image">
												</a>
											</li>
											<li class="list-item share-list-item">
												<a href="#" class="link">
													<img src="img/twitter_icon_dark.svg" alt="tw" class="image">
												</a>
											</li>
											<li class="list-item share-list-item">
												<a href="#" class="link">
													<img src="img/pinterest_icon_dark.svg" alt="pin" class="image">
												</a>
											</li>
											<li class="list-item share-list-item">
												<a href="#" class="link">
													<img src="img/tumblr_icon_dark.svg" alt="tmb" class="image">
												</a>
											</li>
											<li class="list-item share-list-item">
												<a href="#" class="link">
													<img src="img/mail.svg " alt="mail" class="image">
												</a>
											</li>
										</ul>
									</div>
									<div class="post-account-menu flex-wrapper">
										<div class="account-image">
											<img src="img/Charlie%20avatar.png" alt="pet-image">
										</div>
										<div class="account-dropdown-arrow"></div>
										<div class="tile account-choice-dropdown hidden">
											<p class=" account-choice-dropdown-title">Liking and commenting as:</p>
											<ul class="list follow-dogs">
												<li class="list-item follow-dog follow-dog-option current">
													<div class="flex-wrapper">
														<div class="follow-dog-image">
															<img src="img/Molie.png" alt="dog picture">
														</div>
														<div class="follow-dog-description">
															<p class="follow-dog-breed">
																Molie
															</p>
															<p class="follow-dog-breed">
																Siberian Husky
															</p>
														</div>
													</div>
												</li>
												<li class="list-item follow-dog follow-dog-option">
													<div class="flex-wrapper">
														<div class="follow-dog-image">
															<img src="img/Maggie.png" alt="dog picture">
														</div>
														<div class="follow-dog-description">
															<p class="follow-dog-breed">
																Maggie
															</p>
															<p class="follow-dog-breed">
																Siberian Husky
															</p>
														</div>
													</div>
												</li>
												<li class="list-item follow-dog follow-dog-option">
													<div class="flex-wrapper">
														<div class="follow-dog-image">
															<img src="img/Jenny%20Doe.png" alt="dog picture">
														</div>
														<div class="follow-dog-description">
															<p class="follow-dog-breed">
																Maggie
															</p>
															<p class="follow-dog-breed">
																Owner
															</p>
														</div>
													</div>
												</li>
					
											</ul>
										</div>
									</div>
								</div>
							</div>
							<hr class="hr hr-full-width hr-full-width-exp  post-hr">
							<div class="flex-wrapper comment">
								<div class="comment-image">
									<img src="img/Bailey.png" alt="" class="image">
								</div>
								<div class="comment-text">
									<h3 class="heading-h5 comment-text-name">Bailey <span class="comment-text-time">2 min </span></h3>
									<p class="comment-text-content">
										Looks beautiful!
									</p>
									<button class=" button-delete comment-delete">
										<img src="img/cross.svg" alt="close" class="image">
									</button>
								</div>
							</div>
							<div class="newpost newcomment">
								<img src="img/Charlie%20avatar.png" alt="" class="newcomment-avatar">
								<form action="comment" class="newcomment-form">
									<textarea maxlength="400" rows="1" onkeyup="auto_grow(this)" class="newpost-text" placeholder="Share something with your followers"></textarea>
								</form>
								<div class="newpost-active-part hidden">
					
									<div class="attach hidden">
										<hr class="hr  hr-full-width hr-full-width hr-full-width-exp family-hr">
										<div class="attach-image">
											<img src="img/attach2.png" alt="" class="image ">
											<button class="attach-image-close">
												<img src="img/red-cross.svg" alt="" class="image">
											</button>
										</div>
										<div class="attach-image">
											<img src="img/attach2.png" alt="" class="image ">
											<button class="attach-image-close">
												<img src="img/red-cross.svg" alt="" class="image">
											</button>
										</div>
										<div class="attach-image attach-image-placeholder">
					
										</div>
									</div>
									<hr class="hr  hr-full-width hr-full-width hr-full-width-exp family-hr">
									<div class="flex-wrapper flex-wrapper-jc-space-between">
										<div class="flext-wrapper-left-side">
											<button class="link button userprofile-edit-button  button-cta-gray post-button post-button-upload-photos">
												<img src="img/photo.svg" alt="" class="image sub">
												<span>Upload photos</span>
											</button>
											<button class="link button userprofile-edit-button  button-cta-gray post-button">
												<img src="img/video.svg" alt="" class="image sub">
												<span>Upload videos</span>
											</button>
										</div>
										<div class="flex-wrapper-right-side flex-wrapper">
											<div class="post-account-menu flex-wrapper">
												<div class="account-image">
													<img src="img/Charlie%20avatar.png" alt="pet-image" class="image">
												</div>
												<div class="account-dropdown-arrow"></div>
												<div class="tile account-choice-dropdown hidden">
													<p class=" account-choice-dropdown-title">Liking and commenting as:</p>
													<ul class="list follow-dogs">
														<li class="list-item follow-dog follow-dog-option current">
															<div class="flex-wrapper">
																<div class="follow-dog-image">
																	<img src="img/Molie.png" alt="dog picture">
																</div>
																<div class="follow-dog-description">
																	<p class="follow-dog-breed">
																		Molie
																	</p>
																	<p class="follow-dog-breed">
																		Siberian Husky
																	</p>
																</div>
															</div>
														</li>
														<li class="list-item follow-dog follow-dog-option">
															<div class="flex-wrapper">
																<div class="follow-dog-image">
																	<img src="img/Maggie.png" alt="dog picture">
																</div>
																<div class="follow-dog-description">
																	<p class="follow-dog-breed">
																		Maggie
																	</p>
																	<p class="follow-dog-breed">
																		Siberian Husky
																	</p>
																</div>
															</div>
														</li>
														<li class="list-item follow-dog follow-dog-option">
															<div class="flex-wrapper">
																<div class="follow-dog-image">
																	<img src="img/Jenny%20Doe.png" alt="dog picture">
																</div>
																<div class="follow-dog-description">
																	<p class="follow-dog-breed">
																		Maggie
																	</p>
																	<p class="follow-dog-breed">
																		Owner
																	</p>
																</div>
															</div>
														</li>
					
													</ul>
												</div>
											</div>
											<input type="submit" class="link button button-cta-green contest-button post-button" value="Send">
										</div>
									</div>
								</div>
							</div>
					
						</div>
					</div>
					<div class="tile">
						<div class="post">
							<a href="#" class="link post-dots">
								<img src="img/dots.svg" alt="" class="image">
							</a>
							<div class="flex-wrapper">
								<div class="post-dog-image">
									<img src="img/Bailey.png" alt="dog picture">
								</div>
								<div class="post-dog-description">
									<p class="post-dog-name">
										Charley
									</p>
									<p class="post-dog-time">
										20 min
									</p>
								</div>
							</div>
							<p class="post-text">
								Just look at me. Pure Labrador’s patience…
							</p>
							<div class="post-images-container three-images">
								<img src="img/Labrador%20patience.png" class="image" alt="post photo">
								<img src="img/Labrador%20patience.png" class="image" alt="post photo">
								<img src="img/Labrador%20patience.png" class="image" alt="post photo">
							</div>
							<div class="post-action flex-wrapper flex-wrapper-jc-space-between">
								<div class="post-rating">
									<a href="#" class="link link-green highpawes">15 <span class="hidden-sm hidden-xs">High Pawes!</span></a>
								</div>
								<div class="right-part flex-wrapper">
									<div class="post-comment">
										<a href="#" class="link link-gray comments">1 <span class="hidden-sm hidden-xs">Comment</span></a>
									</div>
									<div class="post-share">
										<a href="#" class="link link-gray share">Share</a>
										<ul class="tile list  share-list flex-wrapper hidden">
											<li class="list-item share-list-item">
												<a href="#" class="link">
													<img src="img/facebook_icon_dark.svg" alt="fb" class="image">
												</a>
											</li>
											<li class="list-item share-list-item">
												<a href="#" class="link">
													<img src="img/twitter_icon_dark.svg" alt="tw" class="image">
												</a>
											</li>
											<li class="list-item share-list-item">
												<a href="#" class="link">
													<img src="img/pinterest_icon_dark.svg" alt="pin" class="image">
												</a>
											</li>
											<li class="list-item share-list-item">
												<a href="#" class="link">
													<img src="img/tumblr_icon_dark.svg" alt="tmb" class="image">
												</a>
											</li>
											<li class="list-item share-list-item">
												<a href="#" class="link">
													<img src="img/mail.svg " alt="mail" class="image">
												</a>
											</li>
										</ul>
									</div>
									<div class="post-account-menu flex-wrapper">
										<div class="account-image">
											<img src="img/Charlie%20avatar.png" alt="pet-image">
										</div>
										<div class="account-dropdown-arrow"></div>
										<div class="tile account-choice-dropdown hidden">
											<p class=" account-choice-dropdown-title">Liking and commenting as:</p>
											<ul class="list follow-dogs">
												<li class="list-item follow-dog follow-dog-option current">
													<div class="flex-wrapper">
														<div class="follow-dog-image">
															<img src="img/Molie.png" alt="dog picture">
														</div>
														<div class="follow-dog-description">
															<p class="follow-dog-breed">
																Molie
															</p>
															<p class="follow-dog-breed">
																Siberian Husky
															</p>
														</div>
													</div>
												</li>
												<li class="list-item follow-dog follow-dog-option">
													<div class="flex-wrapper">
														<div class="follow-dog-image">
															<img src="img/Maggie.png" alt="dog picture">
														</div>
														<div class="follow-dog-description">
															<p class="follow-dog-breed">
																Maggie
															</p>
															<p class="follow-dog-breed">
																Siberian Husky
															</p>
														</div>
													</div>
												</li>
												<li class="list-item follow-dog follow-dog-option">
													<div class="flex-wrapper">
														<div class="follow-dog-image">
															<img src="img/Jenny%20Doe.png" alt="dog picture">
														</div>
														<div class="follow-dog-description">
															<p class="follow-dog-breed">
																Maggie
															</p>
															<p class="follow-dog-breed">
																Owner
															</p>
														</div>
													</div>
												</li>
					
											</ul>
										</div>
									</div>
								</div>
							</div>
							<hr class="hr hr-full-width hr-full-width-exp  post-hr">
							<div class="flex-wrapper comment">
								<div class="comment-image">
									<img src="img/Bailey.png" alt="" class="image">
								</div>
								<div class="comment-text">
									<h3 class="heading-h5 comment-text-name">Bailey <span class="comment-text-time">2 min </span></h3>
									<p class="comment-text-content">
										Looks beautiful!
									</p>
									<button class=" button-delete comment-delete">
										<img src="img/cross.svg" alt="close" class="image">
									</button>
								</div>
							</div>
							<div class="newpost newcomment">
								<img src="img/Charlie%20avatar.png" alt="" class="newcomment-avatar">
								<form action="comment" class="newcomment-form">
									<textarea maxlength="400" rows="1" onkeyup="auto_grow(this)" class="newpost-text" placeholder="Share something with your followers"></textarea>
								</form>
								<div class="newpost-active-part hidden">
					
									<div class="attach hidden">
										<hr class="hr  hr-full-width hr-full-width hr-full-width-exp family-hr">
										<div class="attach-image">
											<img src="img/attach2.png" alt="" class="image ">
											<button class="attach-image-close">
												<img src="img/red-cross.svg" alt="" class="image">
											</button>
										</div>
										<div class="attach-image">
											<img src="img/attach2.png" alt="" class="image ">
											<button class="attach-image-close">
												<img src="img/red-cross.svg" alt="" class="image">
											</button>
										</div>
										<div class="attach-image attach-image-placeholder">
					
										</div>
									</div>
									<hr class="hr  hr-full-width hr-full-width hr-full-width-exp family-hr">
									<div class="flex-wrapper flex-wrapper-jc-space-between">
										<div class="flext-wrapper-left-side">
											<button class="link button userprofile-edit-button  button-cta-gray post-button post-button-upload-photos">
												<img src="img/photo.svg" alt="" class="image sub">
												<span>Upload photos</span>
											</button>
											<button class="link button userprofile-edit-button  button-cta-gray post-button">
												<img src="img/video.svg" alt="" class="image sub">
												<span>Upload videos</span>
											</button>
										</div>
										<div class="flex-wrapper-right-side flex-wrapper">
											<div class="post-account-menu flex-wrapper">
												<div class="account-image">
													<img src="img/Charlie%20avatar.png" alt="pet-image" class="image">
												</div>
												<div class="account-dropdown-arrow"></div>
												<div class="tile account-choice-dropdown hidden">
													<p class=" account-choice-dropdown-title">Liking and commenting as:</p>
													<ul class="list follow-dogs">
														<li class="list-item follow-dog follow-dog-option current">
															<div class="flex-wrapper">
																<div class="follow-dog-image">
																	<img src="img/Molie.png" alt="dog picture">
																</div>
																<div class="follow-dog-description">
																	<p class="follow-dog-breed">
																		Molie
																	</p>
																	<p class="follow-dog-breed">
																		Siberian Husky
																	</p>
																</div>
															</div>
														</li>
														<li class="list-item follow-dog follow-dog-option">
															<div class="flex-wrapper">
																<div class="follow-dog-image">
																	<img src="img/Maggie.png" alt="dog picture">
																</div>
																<div class="follow-dog-description">
																	<p class="follow-dog-breed">
																		Maggie
																	</p>
																	<p class="follow-dog-breed">
																		Siberian Husky
																	</p>
																</div>
															</div>
														</li>
														<li class="list-item follow-dog follow-dog-option">
															<div class="flex-wrapper">
																<div class="follow-dog-image">
																	<img src="img/Jenny%20Doe.png" alt="dog picture">
																</div>
																<div class="follow-dog-description">
																	<p class="follow-dog-breed">
																		Maggie
																	</p>
																	<p class="follow-dog-breed">
																		Owner
																	</p>
																</div>
															</div>
														</li>
					
													</ul>
												</div>
											</div>
											<input type="submit" class="link button button-cta-green contest-button post-button" value="Send">
										</div>
									</div>
								</div>
							</div>
					
						</div>
					</div>
					<div class="tile">
						<div class="post">
							<a href="#" class="link post-dots">
								<img src="img/dots.svg" alt="" class="image">
							</a>
							<div class="flex-wrapper">
								<div class="post-dog-image">
									<img src="img/Bailey.png" alt="dog picture">
								</div>
								<div class="post-dog-description">
									<p class="post-dog-name">
										Charley
									</p>
									<p class="post-dog-time">
										20 min
									</p>
								</div>
							</div>
							<p class="post-text">
								Just look at me. Pure Labrador’s patience…
							</p>
							<div class="post-images-container four-images">
								<img src="img/Labrador%20patience.png" class="image" alt="post photo">
								<img src="img/Labrador%20patience.png" class="image" alt="post photo">
								<img src="img/Labrador%20patience.png" class="image" alt="post photo">
								<img src="img/Labrador%20patience.png" class="image" alt="post photo">
							</div>
							<div class="post-action flex-wrapper flex-wrapper-jc-space-between">
								<div class="post-rating">
									<a href="#" class="link link-green highpawes">15 <span class="hidden-sm hidden-xs">High Pawes!</span></a>
								</div>
								<div class="right-part flex-wrapper">
									<div class="post-comment">
										<a href="#" class="link link-gray comments">1 <span class="hidden-sm hidden-xs">Comment</span></a>
									</div>
									<div class="post-share">
										<a href="#" class="link link-gray share">Share</a>
										<ul class="tile list  share-list flex-wrapper hidden">
											<li class="list-item share-list-item">
												<a href="#" class="link">
													<img src="img/facebook_icon_dark.svg" alt="fb" class="image">
												</a>
											</li>
											<li class="list-item share-list-item">
												<a href="#" class="link">
													<img src="img/twitter_icon_dark.svg" alt="tw" class="image">
												</a>
											</li>
											<li class="list-item share-list-item">
												<a href="#" class="link">
													<img src="img/pinterest_icon_dark.svg" alt="pin" class="image">
												</a>
											</li>
											<li class="list-item share-list-item">
												<a href="#" class="link">
													<img src="img/tumblr_icon_dark.svg" alt="tmb" class="image">
												</a>
											</li>
											<li class="list-item share-list-item">
												<a href="#" class="link">
													<img src="img/mail.svg " alt="mail" class="image">
												</a>
											</li>
										</ul>
									</div>
									<div class="post-account-menu flex-wrapper">
										<div class="account-image">
											<img src="img/Charlie%20avatar.png" alt="pet-image">
										</div>
										<div class="account-dropdown-arrow"></div>
										<div class="tile account-choice-dropdown hidden">
											<p class=" account-choice-dropdown-title">Liking and commenting as:</p>
											<ul class="list follow-dogs">
												<li class="list-item follow-dog follow-dog-option current">
													<div class="flex-wrapper">
														<div class="follow-dog-image">
															<img src="img/Molie.png" alt="dog picture">
														</div>
														<div class="follow-dog-description">
															<p class="follow-dog-breed">
																Molie
															</p>
															<p class="follow-dog-breed">
																Siberian Husky
															</p>
														</div>
													</div>
												</li>
												<li class="list-item follow-dog follow-dog-option">
													<div class="flex-wrapper">
														<div class="follow-dog-image">
															<img src="img/Maggie.png" alt="dog picture">
														</div>
														<div class="follow-dog-description">
															<p class="follow-dog-breed">
																Maggie
															</p>
															<p class="follow-dog-breed">
																Siberian Husky
															</p>
														</div>
													</div>
												</li>
												<li class="list-item follow-dog follow-dog-option">
													<div class="flex-wrapper">
														<div class="follow-dog-image">
															<img src="img/Jenny%20Doe.png" alt="dog picture">
														</div>
														<div class="follow-dog-description">
															<p class="follow-dog-breed">
																Maggie
															</p>
															<p class="follow-dog-breed">
																Owner
															</p>
														</div>
													</div>
												</li>
					
											</ul>
										</div>
									</div>
								</div>
							</div>
							<hr class="hr hr-full-width hr-full-width-exp  post-hr">
							<div class="flex-wrapper comment">
								<div class="comment-image">
									<img src="img/Bailey.png" alt="" class="image">
								</div>
								<div class="comment-text">
									<h3 class="heading-h5 comment-text-name">Bailey <span class="comment-text-time">2 min </span></h3>
									<p class="comment-text-content">
										Looks beautiful!
									</p>
									<button class=" button-delete comment-delete">
										<img src="img/cross.svg" alt="close" class="image">
									</button>
								</div>
							</div>
							<div class="newpost newcomment">
								<img src="img/Charlie%20avatar.png" alt="" class="newcomment-avatar">
								<form action="comment" class="newcomment-form">
									<textarea maxlength="400" rows="1" onkeyup="auto_grow(this)" class="newpost-text" placeholder="Share something with your followers"></textarea>
								</form>
								<div class="newpost-active-part hidden">
					
									<div class="attach hidden">
										<hr class="hr  hr-full-width hr-full-width hr-full-width-exp family-hr">
										<div class="attach-image">
											<img src="img/attach2.png" alt="" class="image ">
											<button class="attach-image-close">
												<img src="img/red-cross.svg" alt="" class="image">
											</button>
										</div>
										<div class="attach-image">
											<img src="img/attach2.png" alt="" class="image ">
											<button class="attach-image-close">
												<img src="img/red-cross.svg" alt="" class="image">
											</button>
										</div>
										<div class="attach-image attach-image-placeholder">
					
										</div>
									</div>
									<hr class="hr  hr-full-width hr-full-width hr-full-width-exp family-hr">
									<div class="flex-wrapper flex-wrapper-jc-space-between">
										<div class="flext-wrapper-left-side">
											<button class="link button userprofile-edit-button  button-cta-gray post-button post-button-upload-photos">
												<img src="img/photo.svg" alt="" class="image sub">
												<span>Upload photos</span>
											</button>
											<button class="link button userprofile-edit-button  button-cta-gray post-button">
												<img src="img/video.svg" alt="" class="image sub">
												<span>Upload videos</span>
											</button>
										</div>
										<div class="flex-wrapper-right-side flex-wrapper">
											<div class="post-account-menu flex-wrapper">
												<div class="account-image">
													<img src="img/Charlie%20avatar.png" alt="pet-image" class="image">
												</div>
												<div class="account-dropdown-arrow"></div>
												<div class="tile account-choice-dropdown hidden">
													<p class=" account-choice-dropdown-title">Liking and commenting as:</p>
													<ul class="list follow-dogs">
														<li class="list-item follow-dog follow-dog-option current">
															<div class="flex-wrapper">
																<div class="follow-dog-image">
																	<img src="img/Molie.png" alt="dog picture">
																</div>
																<div class="follow-dog-description">
																	<p class="follow-dog-breed">
																		Molie
																	</p>
																	<p class="follow-dog-breed">
																		Siberian Husky
																	</p>
																</div>
															</div>
														</li>
														<li class="list-item follow-dog follow-dog-option">
															<div class="flex-wrapper">
																<div class="follow-dog-image">
																	<img src="img/Maggie.png" alt="dog picture">
																</div>
																<div class="follow-dog-description">
																	<p class="follow-dog-breed">
																		Maggie
																	</p>
																	<p class="follow-dog-breed">
																		Siberian Husky
																	</p>
																</div>
															</div>
														</li>
														<li class="list-item follow-dog follow-dog-option">
															<div class="flex-wrapper">
																<div class="follow-dog-image">
																	<img src="img/Jenny%20Doe.png" alt="dog picture">
																</div>
																<div class="follow-dog-description">
																	<p class="follow-dog-breed">
																		Maggie
																	</p>
																	<p class="follow-dog-breed">
																		Owner
																	</p>
																</div>
															</div>
														</li>
					
													</ul>
												</div>
											</div>
											<input type="submit" class="link button button-cta-green contest-button post-button" value="Send">
										</div>
									</div>
								</div>
							</div>
					
						</div>
					</div> -->
				</ul>
			</div>
			<div class="col-sm-3 col-sm-3-custom-right">
				<div class="contest">
					<h3 class="heading heading-h3 contest-heading">Petsfame Live Contes</h3>
					<hr class="hr  hr-full-width hr-body">
					<div class="contest-image">

					</div>
					<div class="contest-description">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, autem dolor exercitationem.
					</div>
					<a href="#" class="link button button-cta-green button-full-width contest-button">Join contest</a>
				</div>
				<div class="banner">
					<img src="http://via.placeholder.com/270x240" alt="" class="banner-content">
				</div>
				<div class="follow">
					<?php require_once "tofollow/follow-dogs.php"; ?>
				</div>
				<?php require_once "footer.php"; ?>
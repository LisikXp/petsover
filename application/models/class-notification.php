<?php

Class Notification{

	public $user_from;
	public $user_owner;
	public $event;
	public $post;

	

	function set_event(){

		/*if (($_SESSION['family']) != null) {
			$user_from = $_SESSION['family'];
		} else {
			$user_from = $_SESSION['user_id'];
		}*/
		$user_from = $this->user_from;
		$user_owner = $this->user_owner;
		$event = $this->event;
		$post = $this->post;
		$active = 1;
		$timevent = strtotime(date('d-m-Y H:i:s'));

		$result = mysql_query ("INSERT INTO notification SET user_from='$user_from', user_owner='$user_owner', event='$event', post='$post', active='$active', timevent='$timevent'");

	}

	function remove_active(){
		if (($_SESSION['family']) != null) {
			$user_id = $_SESSION['family'];
		} else {
			$user_id = $_SESSION['user_id'];
		}
		$active = 0;
		$result = mysql_query ("UPDATE notification SET active='$active'  WHERE user_owner='$user_id'");
	}

	function get_family_members(){
		$family = new Family;
		$countfamily = $family->get_my_family_members();
		return $countfamily;
	}

	function get_event(){
		$family = new Family;
		$myfamily = $family->get_my_family_members();
		if (($_SESSION['family']) != null) {
			$user_id = $_SESSION['family'];

		} else {
			$user_id = $_SESSION['user_id'];
			
		}
		$active = 1;
		$new_myfamily = array_merge(array_diff($myfamily, array('')));
		for ($r=0; $r < count($new_myfamily); $r++) { 
			$ret[$r] = "AND user_from <>'$new_myfamily[$r]'";
		}
		$ter = implode(' ', $ret);
		$ter = "user_owner='$user_id' AND active='$active' AND user_from <>'$user_id' " . $ter;
		$sql_res = mysql_query("SELECT * FROM notification WHERE $ter") or die(mysql_error());
		if(mysql_num_rows($sql_res) != 0 ){ 
			
			for ($i=0; $i < mysql_num_rows($sql_res); $i++) { 
				$arr[] = mysql_fetch_assoc($sql_res);
			}
			return count($arr);
		} else {
			return 0;
		}

	}

	function get_all_event(){
		$users = new Users;
		$wall = new Wall;
		$family = new Family;
		$myfamily = $family->get_my_family_members();
		if (($_SESSION['family']) != null) {
			$user_id = $_SESSION['family'];
		} else {
			$user_id = $_SESSION['user_id'];
		}
		$active = 1;
		$new_myfamily = array_merge(array_diff($myfamily, array('')));
		for ($r=0; $r < count($new_myfamily); $r++) { 
			$ret[$r] = "AND user_from <>'$new_myfamily[$r]'";
		}
		$ter = implode(' ', $ret);
		$ter = "user_owner='$user_id' AND user_from <>'$user_id' " . $ter . ' ORDER BY timevent DESC LIMIT 10';

		$sql_res = mysql_query("SELECT * FROM notification WHERE $ter") or die(mysql_error());
		if(mysql_num_rows($sql_res) != 0 ){ 
			for ($i=0; $i < mysql_num_rows($sql_res); $i++) { 
				$arr = mysql_fetch_assoc($sql_res);
				$uid = $arr['user_from'];
				$post_id = $arr['post'];
				$user_event = $users->users($uid);
				if (!is_numeric($uid)) {
					$fotos = "http://" . $_SERVER['HTTP_HOST']. '/img/avatar/' . $user_event['f_photo'];
					$dname = $user_event['f_name'];
					if ($user_event['f_photo'] == null) {
						$fotos = "http://" . $_SERVER['HTTP_HOST']. '/img/avatar/' . $user_event['maine_photo'];
						$dname = $user_event['user_name'];
					} 
				} else {
					$fotos = "http://" . $_SERVER['HTTP_HOST']. '/img/avatar/' . $user_event['user_photo'];
					$dname = $user_event['dog_name'];
					if ($user_event['user_photo'] == null) {
						$fotos = "http://" . $_SERVER['HTTP_HOST']. "/img/avatar/no-photo@2x.png";
					}
					if ($user_event['dog_name'] == null) {
						$dname = $user_event['user_name'];
					}
				}
				
				$wall_attach = $wall->get_attach_post($post_id);
				$attachment = $wall_attach['attachment'];
				if ($arr['active'] == 1 && $arr['event'] == 'Likes') {?>
				<li class="list-item follow-dog list-notifi-event event-active" id="list-notifi-event">
					<div class="flex-wrapper" id="<?= $post_id;?>">
						<div class="event-dog-image">
							<a href="user?id=<?= $uid; ?>">
								<img src="<?php echo $fotos; ?>" alt="dog picture" id="event-dog-image_<?php echo $dname; ?>">
							</a>
						</div>
						<div class="follow-dog-description">
							<a href="user?id=<?= $uid; ?>">
								<p class="follow-dog-breed">
									<?php echo $dname; ?>
								</p>
							</a>
							<p class="follow-dog-breed">
								liked your photo
							</p>
							
						</div>
						<div class="follow-dog-description event-post-attach">
							<?php 
							if ($wall_attach['attachment'] != null) {
								$pieces = explode(",",$attachment);
								switch (count($pieces)) {
									case '1':
									$post_img = 'post-images-container';
									break;
									case '2':
									$post_img = 'post-images-container two-images multiple-images';
									break;
									case '3':
									$post_img = 'post-images-container three-images multiple-images';
									break;
									case '4':
									$post_img = 'post-images-container four-images multiple-images';
									break;

									default:

									break;
								} ?>
								<div class="attach posts_attach posts_content_<?= $post_id;?>">
									<div class="<?= $post_img;?>" id="posts_attach_<?= $post_id;?>">
										<img src="http://petsoverload.yaskravo.net/<?= $pieces[0];?>" alt="dog picture">
										<?php for ($t=1; $t < count($pieces); $t++) { ?>
										<img src="http://petsoverload.yaskravo.net/<?= $pieces[$t];?>" alt="dog picture" class="hidden">
										<?php } ?>
									</div>
								</div>
								<?php } else { ?>
								<p class="follow-dog-breed">
									<?php $string = substr($wall_attach['message'], 0, 20);
									echo $string."…";
									?>
								</p>
								<?php }?>
							</div>
						</div>
					</li>
					<?php } elseif ($arr['active'] == 1 && $arr['event'] == 'comment') { ?>
					<li class="list-item follow-dog list-notifi-event event-active" id="list-notifi-event">
						<div class="flex-wrapper" id="<?= $post_id;?>">
							<div class="event-dog-image">
								<a href="user?id=<?= $uid; ?>">
									<img src="<?php echo $fotos; ?>" alt="dog picture" id="event-dog-image_<?php echo $dname; ?>">
								</a>
							</div>
							<div class="follow-dog-description">
								<a href="user?id=<?= $uid; ?>">
									<p class="follow-dog-breed">
										<?php echo $dname; ?>
									</p>
								</a>
								<p class="follow-dog-breed">
									comment your photo
								</p>
							</div>
							<div class="follow-dog-description event-post-attach">
								<?php 
								if ($wall_attach['attachment'] != null) {
									$pieces = explode(",",$attachment);
									switch (count($pieces)) {
										case '1':
										$post_img = 'post-images-container';
										break;
										case '2':
										$post_img = 'post-images-container two-images multiple-images';
										break;
										case '3':
										$post_img = 'post-images-container three-images multiple-images';
										break;
										case '4':
										$post_img = 'post-images-container four-images multiple-images';
										break;

										default:

										break;
									} ?>
									<div class="attach posts_attach posts_content_<?= $post_id;?>">
										<div class="<?= $post_img;?>" id="posts_attach_<?= $post_id;?>">
											<img src="http://petsoverload.yaskravo.net/<?= $pieces[0];?>" alt="dog picture">
											<?php for ($t=1; $t < count($pieces); $t++) { ?>
											<img src="http://petsoverload.yaskravo.net/<?= $pieces[$t];?>" alt="dog picture" class="hidden">
											<?php } ?>
										</div>
									</div>
									<?php } else { ?>
									<p class="follow-dog-breed">
										<?php $string = substr($wall_attach['message'], 0, 20);
										echo $string."…";
										?>
									</p>
									<?php }?>
								</div>
							</div>
						</li>
						<?php } elseif ($arr['active'] == 1 && $arr['event'] == 'following') { ?>
						<li class="list-item follow-dog list-notifi-event event-active" id="list-notifi-event">
							<div class="flex-wrapper">
								<div class="event-dog-image">
									<a href="user?id=<?= $uid; ?>">
										<img src="<?php echo $fotos; ?>" alt="dog picture" id="event-dog-image_<?php echo $dname; ?>">
									</a>
								</div>
								<div class="follow-dog-description">
									<a href="user?id=<?= $uid; ?>">
										<p class="follow-dog-breed">
											<?php echo $dname; ?>
										</p>
									</a>
									<p class="follow-dog-breed">
										follows you
									</p>
								</div>
							</div>
						</li>
						<?php } elseif ($arr['active'] == 1 && $arr['event'] == 'password') { ?>
						<li class="list-item follow-dog list-notifi-event event-active" id="list-notifi-event">
							<div class="flex-wrapper">
								<div class="event-dog-image">
									<a href="user?id=<?= $uid; ?>">
										<img src="<?php echo $fotos; ?>" alt="dog picture" id="event-dog-image_<?php echo $dname; ?>">
									</a>
								</div>
								<div class="follow-dog-description">
									<a href="user?id=<?= $uid; ?>">
										<p class="follow-dog-breed">
											<?php echo $dname; ?>
										</p>
									</a>
									<p class="follow-dog-breed">
										You changed your password
									</p>
								</div>
							</div>
						</li>
						<?php } elseif ($arr['active'] == 0 && $arr['event'] == 'Likes') { ?>
						<li class="list-item follow-dog list-notifi-event" id="list-notifi-event">
							<div class="flex-wrapper" id="<?= $post_id;?>">
								<div class="event-dog-image">
									<a href="user?id=<?= $uid; ?>">
										<img src="<?php echo $fotos; ?>" alt="dog picture" id="event-dog-image_<?php echo $dname; ?>">
									</a>
								</div>
								<div class="follow-dog-description">
									<a href="user?id=<?= $uid; ?>">
										<p class="follow-dog-breed">
											<?php echo $dname; ?>
										</p>
									</a>
									<p class="follow-dog-breed">
										liked your photo
									</p>
								</div>
								<div class="follow-dog-description event-post-attach">
									<?php 
									if ($wall_attach['attachment'] != null) {
										$pieces = explode(",",$attachment);
										switch (count($pieces)) {
											case '1':
											$post_img = 'post-images-container';
											break;
											case '2':
											$post_img = 'post-images-container two-images multiple-images';
											break;
											case '3':
											$post_img = 'post-images-container three-images multiple-images';
											break;
											case '4':
											$post_img = 'post-images-container four-images multiple-images';
											break;

											default:

											break;
										} ?>
										<div class="attach posts_attach posts_content_<?= $post_id;?>">
											<div class="<?= $post_img;?>" id="posts_attach_<?= $post_id;?>">
												<img src="http://petsoverload.yaskravo.net/<?= $pieces[0];?>" alt="dog picture">
												<?php for ($t=1; $t < count($pieces); $t++) { ?>
												<img src="http://petsoverload.yaskravo.net/<?= $pieces[$t];?>" alt="dog picture" class="hidden">
												<?php } ?>
											</div>
										</div>
										<?php } else { ?>
										<p class="follow-dog-breed">
											<?php $string = substr($wall_attach['message'], 0, 20);
											echo $string."…";
											?>
										</p>
										<?php }?>
									</div>
								</div>
							</li>
							<?php }elseif ($arr['active'] == 0 && $arr['event'] == 'comment') { ?>
							<li class="list-item follow-dog list-notifi-event" id="list-notifi-event">
								<div class="flex-wrapper" id="<?= $post_id;?>">
									<div class="event-dog-image">
										<a href="user?id=<?= $uid; ?>">
											<img src="<?php echo $fotos; ?>" alt="dog picture" id="event-dog-image_<?php echo $dname; ?>">
										</a>
									</div>
									<div class="follow-dog-description">
										<a href="user?id=<?= $uid; ?>">
											<p class="follow-dog-breed">
												<?php echo $dname; ?>
											</p>
										</a>
										<p class="follow-dog-breed">
											comment your photo
										</p>
										
									</div>
									<div class="follow-dog-description event-post-attach">
										<?php 
										if ($wall_attach['attachment'] != null) {
											$pieces = explode(",",$attachment);
											switch (count($pieces)) {
												case '1':
												$post_img = 'post-images-container';
												break;
												case '2':
												$post_img = 'post-images-container two-images multiple-images';
												break;
												case '3':
												$post_img = 'post-images-container three-images multiple-images';
												break;
												case '4':
												$post_img = 'post-images-container four-images multiple-images';
												break;

												default:

												break;
											} ?>
											<div class="attach posts_attach posts_content_<?= $post_id;?>">
												<div class="<?= $post_img;?>" id="posts_attach_<?= $post_id;?>">
													<img src="http://petsoverload.yaskravo.net/<?= $pieces[0];?>" alt="dog picture"">
													<?php for ($t=1; $t < count($pieces); $t++) { ?>
													<img src="http://petsoverload.yaskravo.net/<?=$pieces[$t];?>" alt="dog picture" class="hidden">
													<?php } ?>
												</div>
											</div>
											<?php } else { ?>
											<p class="follow-dog-breed">
												<?php $string = substr($wall_attach['message'], 0, 20);
												echo $string."…";
												?>
											</p>
											<?php }?>
										</div>
									</div>
								</li>
								<?php } elseif ($arr['active'] == 0 && $arr['event'] == 'following') { ?>
								<li class="list-item follow-dog list-notifi-event" id="list-notifi-event">
									<div class="flex-wrapper">
										<div class="event-dog-image">
											<a href="user?id=<?= $uid; ?>">
												<img src="<?php echo $fotos; ?>" alt="dog picture" id="event-dog-image_<?php echo $dname; ?>">
											</a>
										</div>
										<div class="follow-dog-description">
											<a href="user?id=<?= $uid; ?>">
												<p class="follow-dog-breed">
													<?php echo $dname; ?>
												</p>
											</a>
											<p class="follow-dog-breed">
												follows you
											</p>
										</div>
									</div>
								</li>
								<?php } elseif ($arr['active'] == 0 && $arr['event'] == 'password') { ?>
								<li class="list-item follow-dog list-notifi-event" id="list-notifi-event">
									<div class="flex-wrapper">
										<div class="event-dog-image">
											<a href="user?id=<?= $uid; ?>">
												<img src="<?php echo $fotos; ?>" alt="dog picture" id="event-dog-image_<?php echo $dname; ?>">
											</a>
										</div>
										<div class="follow-dog-description">
											<a href="user?id=<?= $uid; ?>">
												<p class="follow-dog-breed">
													<?php echo $dname; ?>
												</p>
											</a>
											<p class="follow-dog-breed">
												You changed your password
											</p>
										</div>
									</div>
								</li>
								<?php }

							}

						} else {?>
						<li class="list-item follow-dog list-notifi-event" id="list-notifi-event">
							<div class="flex-wrapper">
								<div class="follow-dog-description">
									<p class="follow-dog-breed">
										You don't have any notifications
									</p>
								</div>
							</div>
						</li>
						<?php }
					}

					function get_all_event_page(){
						$users = new Users;
						$wall = new Wall;
						$family = new Family;
						$myfamily = $family->get_my_family_members();
						if (($_SESSION['family']) != null) {
							$user_id = $_SESSION['family'];
						} else {
							$user_id = $_SESSION['user_id'];
						}
						$active = 1;
						$new_myfamily = array_merge(array_diff($myfamily, array('')));
						for ($r=0; $r < count($new_myfamily); $r++) { 
							$ret[$r] = "AND user_from <>'$new_myfamily[$r]'";
						}
						$ter = implode(' ', $ret);
						$ter = "user_owner='$user_id' AND user_from <>'$user_id' " . $ter . ' ORDER BY timevent DESC LIMIT 20';

						$sql_res = mysql_query("SELECT * FROM notification WHERE $ter") or die(mysql_error());
						if(mysql_num_rows($sql_res) != 0 ){ 
							for ($i=0; $i < mysql_num_rows($sql_res); $i++) { 
								$arr = mysql_fetch_assoc($sql_res);
								$uid = $arr['user_from'];
								$post_id = $arr['post'];
								$timevent = $arr['timevent'];
								$user_event = $users->users($uid);
								if (!is_numeric($uid)) {
									$fotos = "http://" . $_SERVER['HTTP_HOST']. '/img/avatar/' . $user_event['f_photo'];
									$dname = $user_event['f_name'];
									if ($user_event['f_photo'] == null) {
										$fotos = "http://" . $_SERVER['HTTP_HOST']. '/img/avatar/' . $user_event['maine_photo'];
										$dname = $user_event['user_name'];
									} 
								} else {
									$fotos = "http://" . $_SERVER['HTTP_HOST']. '/img/avatar/' . $user_event['user_photo'];
									$dname = $user_event['dog_name'];
									if ($user_event['user_photo'] == null) {
										$fotos = "http://" . $_SERVER['HTTP_HOST']. "/img/avatar/no-photo@2x.png";
									}
									if ($user_event['dog_name'] == null) {
										$dname = $user_event['user_name'];
									}
								}

								$date = new DateTime();
								$date->setTimestamp($timevent);
								$gdate = $date->format("d F Y");
								$gday = $date->format("d");
								$gHour = $date->format("H");
								$gTime = $date->format("i");


								$wall_attach = $wall->get_attach_post($post_id);
								$attachment = $wall_attach['attachment'];
								if ($arr['active'] == 0 && $arr['event'] == 'Likes') { ?>
								<li class="list-item follow-dog list-notifi-event" id="list-notifi-event">
									<div class="flex-wrapper" id="<?= $post_id;?>">
										<div class="event-dog-image-event">
											<a href="user?id=<?= $uid; ?>">
												<img src="<?php echo $fotos; ?>" alt="dog picture" id="event-dog-image_<?php echo $dname; ?>">
											</a>
										</div>
										<div class="follow-dog-description">
											<a href="user?id=<?= $uid; ?>">
												<p class="follow-dog-breed">
													<?php echo $dname; ?>
												</p>
											</a>
											<p class="follow-dog-breed">
												liked your photo
											</p>
											<p class="follow-dog-breed">
												<?php
												if ($gdate == date('d F Y')) {
													if ($date->format("i") == date('i')) {
														echo (date('s') - $date->format('s')) . " sec";
													}elseif ($gHour == date('H')) {
														echo (date('i') - $gTime) . " min";
													} elseif ($gday == date('d')) {
														echo (date('H') - $gHour) . " hour";
													} else {
														echo $gdate;
													}
												} else {
													echo $gdate;
												}
												?>
											</p>
										</div>
										<div class="follow-dog-description-event event-post-attach">
											<?php 
											if ($wall_attach['attachment'] != null) {
												$pieces = explode(",",$attachment);
												switch (count($pieces)) {
													case '1':
													$post_img = 'post-images-container';
													break;
													case '2':
													$post_img = 'post-images-container two-images multiple-images';
													break;
													case '3':
													$post_img = 'post-images-container three-images multiple-images';
													break;
													case '4':
													$post_img = 'post-images-container four-images multiple-images';
													break;

													default:

													break;
												} ?>
												<div class="attach posts_attach posts_content_<?= $post_id;?>">
													<div class="<?= $post_img;?>" id="posts_attach_<?= $post_id;?>">
														<img src="http://petsoverload.yaskravo.net/<?=$pieces[0];?>" alt="dog picture">
														<?php for ($t=1; $t < count($pieces); $t++) { ?>
														<img src="http://petsoverload.yaskravo.net/<?=$pieces[$t];?>" alt="dog picture" class="hidden">
														<?php } ?>
													</div>
												</div>
												<?php } else { ?>
												<p class="follow-dog-breed">
													<?php $string = substr($wall_attach['message'], 0, 20);
													echo $string."…";
													?>
												</p>
												<?php }?>
											</div>
										</div>
									</li>
									<?php }elseif ($arr['active'] == 0 && $arr['event'] == 'comment') { ?>
									<li class="list-item follow-dog list-notifi-event" id="list-notifi-event">
										<div class="flex-wrapper" id="<?= $post_id;?>">
											<div class="event-dog-image-event">
												<a href="user?id=<?= $uid; ?>">
													<img src="<?php echo $fotos; ?>" alt="dog picture" id="event-dog-image_<?php echo $dname; ?>">
												</a>
											</div>
											<div class="follow-dog-description">
												<a href="user?id=<?= $uid; ?>">
													<p class="follow-dog-breed">
														<?php echo $dname; ?>
													</p>
												</a>
												<p class="follow-dog-breed">
													comment your photo
												</p>
												<p class="follow-dog-breed">
													<?php
													if ($gdate == date('d F Y')) {
														if ($date->format("i") == date('i')) {
															echo (date('s') - $date->format('s')) . " sec";
														}elseif ($gHour == date('H')) {
															echo (date('i') - $gTime) . " min";
														} elseif ($gday == date('d')) {
															echo (date('H') - $gHour) . " hour";
														} else {
															echo $gdate;
														}
													} else {
														echo $gdate;
													}
													?>
												</p>

											</div>
											<div class="follow-dog-description-event event-post-attach">
												<?php 
												if ($wall_attach['attachment'] != null) {
													$pieces = explode(",",$attachment);
													switch (count($pieces)) {
														case '1':
														$post_img = 'post-images-container';
														break;
														case '2':
														$post_img = 'post-images-container two-images multiple-images';
														break;
														case '3':
														$post_img = 'post-images-container three-images multiple-images';
														break;
														case '4':
														$post_img = 'post-images-container four-images multiple-images';
														break;

														default:

														break;
													} ?>
													<div class="attach posts_attach posts_content_<?= $post_id;?>">
														<div class="<?= $post_img;?>" id="posts_attach_<?= $post_id;?>">
															<img src="http://petsoverload.yaskravo.net/<?=$pieces[0];?>" alt="dog picture"">
															<?php for ($t=1; $t < count($pieces); $t++) { ?>
															<img src="http://petsoverload.yaskravo.net/<?=$pieces[$t];?>" alt="dog picture" class="hidden">
															<?php } ?>
														</div>
													</div>
													<?php } else { ?>
													<p class="follow-dog-breed">
														<?php $string = substr($wall_attach['message'], 0, 20);
														echo $string."…";
														?>
													</p>
													<?php }?>
												</div>
											</div>
										</li>
										<?php } elseif ($arr['active'] == 0 && $arr['event'] == 'following') { ?>
										<li class="list-item follow-dog list-notifi-event" id="list-notifi-event">
											<div class="flex-wrapper">
												<div class="event-dog-image-event">
													<a href="user?id=<?= $uid; ?>">
														<img src="<?php echo $fotos; ?>" alt="dog picture" id="event-dog-image_<?php echo $dname; ?>">
													</a>
												</div>
												<div class="follow-dog-description">
													<a href="user?id=<?= $uid; ?>">
														<p class="follow-dog-breed">
															<?php echo $dname; ?>
														</p>
													</a>
													<p class="follow-dog-breed">
														follows you
													</p>
													<p class="follow-dog-breed">
														<?php
														if ($gdate == date('d F Y')) {
															if ($date->format("i") == date('i')) {
																echo (date('s') - $date->format('s')) . " sec";
															}elseif ($gHour == date('H')) {
																echo (date('i') - $gTime) . " min";
															} elseif ($gday == date('d')) {
																echo (date('H') - $gHour) . " hour";
															} else {
																echo $gdate;
															}
														} else {
															echo $gdate;
														}
														?>
													</p>
												</div>
											</div>
										</li>
										<?php } elseif ($arr['active'] == 0 && $arr['event'] == 'password') { ?>
										<li class="list-item follow-dog list-notifi-event" id="list-notifi-event">
											<div class="flex-wrapper">
												<div class="event-dog-image">
													<a href="user?id=<?= $uid; ?>">
														<img src="<?php echo $fotos; ?>" alt="dog picture" id="event-dog-image_<?php echo $dname; ?>">
													</a>
												</div>
												<div class="follow-dog-description">
													<a href="user?id=<?= $uid; ?>">
														<p class="follow-dog-breed">
															<?php echo $dname; ?>
														</p>
													</a>
													<p class="follow-dog-breed">
														You changed your password
													</p>
													<p class="follow-dog-breed">
														<?php
														if ($gdate == date('d F Y')) {
															if ($date->format("i") == date('i')) {
																echo (date('s') - $date->format('s')) . " sec";
															}elseif ($gHour == date('H')) {
																echo (date('i') - $gTime) . " min";
															} elseif ($gday == date('d')) {
																echo (date('H') - $gHour) . " hour";
															} else {
																echo $gdate;
															}
														} else {
															echo $gdate;
														}
														?>
													</p>
												</div>
											</div>
										</li>
										<?php }

									}

								} else {?>
								<li class="list-item follow-dog list-notifi-event" id="list-notifi-event">
									<div class="flex-wrapper">
										<div class="follow-dog-description">
											<p class="follow-dog-breed">
												You don't have any notifications
											</p>
										</div>
									</div>
								</li>
								<?php }
							}



						}
						?>
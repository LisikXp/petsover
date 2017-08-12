<?php
class Wall{

	function post($post_id, $message, $attachment, $user_from, $user_owner, $publish_date){

		$likes = new Likes;
		$user = new Users;
		$family = new Family;
		$comment = new Comments;
		$myprof = $user->users($user_from);
		$count_comment = $comment->get_count_comment($post_id);

		if (!is_numeric($user_from)) {
			$fotos = $myprof['f_photo'];
			$dname = $myprof['f_name'];
			if ($fotos == null) {
				$fotos = $myprof['maine_photo'];
				$dname = $myprof['user_name'];
			}
		} else {
			$fotos = $myprof['user_photo'];
			$dname = $myprof['dog_name'];
		}
		if ($fotos == null) {
			$fotos = "no-photo@2x.png";
		}
		
		$get_id = $_SESSION['get_id'];

		if (($_SESSION['family']) != null) {
			$myaacount = $family->my_account();
			$user_id = $myaacount['f_name'];
			$name = $myaacount['f_name'];
			$breed = $myaacount['breed'];
			$owner_name = $family->myowner;
			$owner_photo = $family->myownerphoto;
			$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" .$myaacount['f_photo'];
			$mypage = $_SESSION['family'];
		} else {
			$myaacount = $user->my_account();
			$user_id = $myaacount['user_id'];
			$owner_name = $myaacount['user_name']; 
			$name = $myaacount['dog_name'];
			$breed = $myaacount['breed'];
			$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" .$myaacount['user_photo'];
			$owner_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $myaacount['maine_photo'];
			$mypage = $_SESSION['user_id'];
		}
		$count_like = $likes->get_post_likes($post_id);
		$serch_like = $likes->serch_user_like($post_id, $user_id);?>

		<li class="tile users_wall_posts wall_posts_<?= $post_id;?>" id="<?= $post_id;?>" data-user-post="<?=$user_owner;?>">
			<div class="post" id="<?= $post_id;?>">
				<?php if ($user_owner == $mypage) {?>
				<button class="button link post-dots">
					<img src="img/dots.svg" alt="" class="image">
				</button>
				<div class="tile post-dots-choice-dropdown hidden dropdown">
					<ul class="list follow-dogs">
						<li class="list-item account-action">
							<p class="no-margin">
								Edit
							</p>
						</li>
						<li class="list-item account-action" id="remove_post">
							<p class="no-margin">
								Delete
							</p>
						</li>
					</ul>
				</div>
				<?php	} ?>
				<div class="flex-wrapper">
					<div class="post-dog-image users_posts">
						<a href="user?id=<?= $user_from; ?>">
							<img src="http://<?= $_SERVER['HTTP_HOST']. '/img/avatar/' . $fotos;?>" alt="dog picture">
						</a>
					</div>
					<div class="post-dog-description">
						<a href="user?id=<?= $user_from; ?>">
							<p class="post-dog-name">  
								<?= $dname;?>
							</p>
						</a>
						<p class="post-dog-time post_time_<?= $post_id;?>">

							<?php
							$date = new DateTime();
							$date->setTimestamp($publish_date);
							$gdate = $date->format("d F Y");
							$gday = $date->format("d");
							$gHour = $date->format("H");
							$gTime = $date->format("i");
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
				<p class="post-text post_message_<?= $post_id;?>">
					<?= $message;?>
				</p>
				<?php 
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
				} 
				
				?>
				<div class="attach posts_attach posts_content_<?= $post_id;?>">

					<div class="<?= $post_img;?>" id="posts_attach_<?= $post_id;?>">
						<?php for ($i=0; $i < count($pieces); $i++) { 
							$attch = trim('http://petsoverload.yaskravo.net/' . $pieces[0]);
							?>

							<img class="image posts_attach_photo_<?= $post_id;?>" src="<?= $pieces[$i];?>">
							<?php }

							$pies = trim(implode('&', $attch));
							?>

						</div>

					</div>
					

					<div class="post-action flex-wrapper flex-wrapper-jc-space-between" id="<?= $post_id;?>">
						<div class="post-rating post_likes" id="post_likes_<?= $post_id;?>" data-user="<?php echo $user_id;?>">
							<?php 
							if ($serch_like == 1) { ?>
							<div class="link link-green highpawes post_likes_<?= $post_id;?>"><?php echo $count_like;?> <span class="hidden-sm hidden-xs">High Pawes!</span>
							</div>
							<?php } else {?>
							<div class="link link-gray highpawes-grey post_likes_<?= $post_id;?>"><?php echo $count_like;?> <span class="hidden-sm hidden-xs">High Pawes!</span>
							</div>
							<?php } ?>
							
						</div>
						<div class="right-part flex-wrapper">
							<div class="post-comment">
								<div class="link link-gray comments post_comment_<?= $post_id;?>"><?php echo $count_comment;?> <span class="hidden-sm hidden-xs">Comment</span></div>
							</div>
							<div class="post-share">
								<a href="#" class="link link-gray share">Share</a>
								<ul class="tile list  share-list flex-wrapper hidden">
									<li class="list-item share-list-item">
										<a class="link sharer button" data-sharer="facebook" data-url="<?= $attch;?>">
											<img src="img/facebook_icon_dark.svg" alt="fb" class="image">
										</a>
									</li>
									<li class="list-item share-list-item">
										<a class="link sharer button" data-sharer="twitter" data-title="Checkout Sharer!" data-hashtags="<?php echo "$message"; ?>" data-url="<?php echo $attch; ?>">
											<img src="img/twitter_icon_dark.svg" alt="tw" class="image">
										</a>
										<!-- <a class="link" onclick="set_twitter('<?php echo "$message"; ?>', '<?php echo $attch; ?>')">
											<img src="img/twitter_icon_dark.svg" alt="tw" class="image">
										</a> -->
									</li> 
									<li class="list-item share-list-item">
										<a class="link" target="_blank" data-pin-do="buttonPin" href="https://www.pinterest.com/pin/create/button/?url=http://petsoverload.yaskravo.net&media=<?= $attch;?>&description=<?= $message;?>" data-pin-custom="true">
											<img src="img/pinterest_icon_dark.svg" alt="pin" class="image">
										</a>
									</li>
									<li class="list-item share-list-item">
										<!-- <a class="link" target="_blank" href="http://www.tumblr.com/share/link?url=http://petsoverload.yaskravo.net&name=<?= $message;?>&description=<?= $attch;?>"> -->
										<a class="link sharer button" data-sharer="tumblr" data-caption="<?= $message;?>" data-title="<?= $message;?>" data-tags="social,share" data-url="<?= $attch;?>">
											<img src="img/tumblr_icon_dark.svg" alt="tmb" class="image">
										</a>
									</li>
									<li class="list-item share-list-item">

										<a class="link sharer button" data-sharer="email" data-title="petsoverload" data-url="http://petsoverload.yaskravo.net/<?= $attch;?>" data-subject="<?= $message;?>" data-to="<?= $email;?>">
											<img src="img/mail.svg " alt="mail" class="image">
										</a>
									</li>
									
									<script>
										$( function() {

											function auto_grow(element) {
												element.style.height = "5px";
												element.style.height = (element.scrollHeight)+"px";
											}

										});
									</script>
								</ul>
							</div>
							<div class="post-account-menu flex-wrapper">
								<div class="account-image" id="<?= $post_id;?>">
									<img src="<?php echo $photo;?>" alt="pet-image" class="image" id="account-image_<?= $post_id;?>">
								</div>
								<div class="account-dropdown-arrow account-dropdown-arrow-post"></div>
								<div class="tile account-choice-dropdown hidden">
									<p class=" account-choice-dropdown-title">Liking and commenting as:</p>
									<ul class="list list-follow-dogs select_users_<?= $post_id;?>" id="<?= $post_id;?>">
										<?php $this->list_follow_dogs(); ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<hr class="hr hr-full-width hr-full-width-exp  post-hr">
					<ul class="comment_list comment_list_<?= $post_id;?>" id="<?= $post_id;?>">
						<?php 
						$comment->get_comment($post_id, 0, 10);?>
					</ul>
					<?php if ($comment->get_count_comment($post_id) <= 10 ) {?>

					<?php } else { ?>

					<button class="link link-green tac block comment_view_<?= $post_id;?>" id="comment_view" data-count="<?= $comment->get_count_comment($post_id);?>">View more</button>
					<hr class="hr-full-width">

					<?php } 

					if ($comment->get_count_comment($post_id) > 1) {
						$place = "Leave a comment for your friend";
					} else {
						$place = "Share something with your followers";
						}?>
					<div class="newpost newcomment newcomment_<?= $post_id;?>" id="<?= $post_id;?>">
						<img src="<?php echo $photo;?>" alt="" class="newcomment-avatar" id="newcomment-avatar_<?= $post_id;?>">
						<form action="comment" class="newcomment-form">
							<textarea maxlength="400" rows="1" onkeyup="auto_grow(this)" class="newpost-text text_add_comment" id="text_add_comment_<?= $post_id;?>" placeholder="<?= $place;?>"></textarea>
						</form>
						<div class="newpost-active-part hidden">

							<hr class="hr  hr-full-width hr-full-width hr-full-width-exp family-hr">
							<div class="flex-wrapper flex-wrapper-jc-space-between">

								<div class="flex-wrapper-right-side flex-wrapper" id="<?= $post_id;?>">
									<input type="submit" id="add_comment_wall" class="link button button-cta-green contest-button post-button" value="Send" data-user="<?php echo $user_id;?>">
								</div>
							</div>
						</div>
					</div>

				</li>
				<?php }

				function list_follow_dogs(){
					$family = new Family;
					$user = new Users;
					if (($_SESSION['family']) != null) {
						$myaacount = $family->my_account();
						$user_id = $myaacount['f_name'];
						$name = $myaacount['f_name'];
						$breed = $myaacount['breed'];
						$owner_name = $family->myowner;
						$owner_photo = $family->myownerphoto;
						$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" .$myaacount['f_photo']; ?>
						<li class="list-item follow-dogs follow-dog-option" id="<?php echo $name;?>">
							<div class="flex-wrapper">
								<div class="follow-dog-image">
									<img src="<?php echo $photo;?>" alt="dog picture" id="follow-dog-image_<?= $name; ?>">
								</div>
								<div class="follow-dog-description">
									<p class="follow-dog-breed">
										<?php echo $name; ?>
									</p>
									<p class="follow-dog-breed">

									</p>
								</div>
							</div>
						</li>
						<?php $family->get_family_wall_choice(); ?>
						<li class="list-item follow-dogs follow-dog-option" id="<?php echo $owner_name; ?>">
							<div class="flex-wrapper">
								<div class="follow-dog-image">
									<img src="<?php echo $owner_photo; ?>" alt="dog picture" id="follow-dog-image_<?php echo $owner_name; ?>">
								</div>
								<div class="follow-dog-description">
									<p class="follow-dog-breed">
										<?php echo $owner_name; ?>
									</p>
									<p class="follow-dog-breed">
										Owner
									</p>
								</div>
							</div>
						</li>

						<?php } else {
							$myaacount = $user->my_account();
							$user_id = $myaacount['user_id'];
							$owner_name = $myaacount['user_name']; 
							$name = $myaacount['dog_name'];
							$breed = $myaacount['breed'];
							$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" .$myaacount['user_photo'];
							$owner_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $myaacount['maine_photo']; ?>

							<li class="list-item follow-dogs follow-dog-option" id="<?php echo $name;?>">
								<div class="flex-wrapper">
									<div class="follow-dog-image">
										<img src="<?php echo $photo;?>" alt="dog picture" id="follow-dog-image_<?= $name; ?>">
									</div>
									<div class="follow-dog-description">
										<p class="follow-dog-breed">
											<?php echo $name; ?>
										</p>
										<p class="follow-dog-breed">

										</p>
									</div>
								</div>
							</li>
							<li class="list-item follow-dogs follow-dog-option" id="<?php echo $owner_name; ?>">
								<div class="flex-wrapper">
									<div class="follow-dog-image">
										<img src="<?php echo $owner_photo; ?>" alt="dog picture" id="follow-dog-image_<?php echo $owner_name; ?>">
									</div>
									<div class="follow-dog-description">
										<p class="follow-dog-breed">
											<?php echo $owner_name; ?>
										</p>
										<p class="follow-dog-breed">
											Owner
										</p>
									</div>
								</div>
							</li>

							<?php }
						}


						function get_posts($uid, $start, $limit){
							$sql_res = mysql_query("SELECT post_id FROM wall WHERE user_owner='$uid'");
							if(mysql_num_rows($sql_res) != 0 ){

								for ($t=0; $t < mysql_num_rows($sql_res); $t++) { 

									$arr[] = mysql_fetch_assoc($sql_res);
								}
							}

							rsort($arr);
							for ($g=$start; $g < $limit; $g++) { 
								$pd[$g] = $arr[$g]['post_id'];
								$sql_ress = mysql_query("SELECT * FROM wall WHERE post_id='$pd[$g]' ORDER BY publish_date DESC");
								if(mysql_num_rows($sql_ress) != 0 ){
									for ($r=0; $r < mysql_num_rows($sql_ress); $r++) { 
										$arrar = mysql_fetch_assoc($sql_ress);
										$this->post($arrar['post_id'], $arrar['message'], $arrar['attachment'],$arrar['user_from'], $arrar['user_owner'], $arrar['publish_date']);
									}

								}
							}
						}

						function get_all_count_post($uid){
							$sql_res = mysql_query("SELECT * FROM wall WHERE user_owner='$uid'");
							if(mysql_num_rows($sql_res) != 0 ){ 

								return mysql_num_rows($sql_res);
							}
						}

						function get_count_post($uid){
							$sql_res = mysql_query("SELECT * FROM wall WHERE user_from='$uid'");
							$arr = mysql_fetch_assoc($sql_res);?>
							<div class="userprofile-counter counter">
								<a href="#" class="link">
									<p class="counter-value">
										<?= mysql_num_rows($sql_res);?>
									</p>
									<p class="counter-description">
										Posts
									</p>
								</a>
							</div>
							<?php
						}

						function set_post($user_from, $message, $attachment, $count_attach){

							if (($_SESSION['family']) != null) {
								$user_owner = $_SESSION['family'];
							} else {
								$user_owner = $_SESSION['user_id'];
							}
							$newattachment = trim($attachment);
						//$user_owner = $_SESSION['get_id'];
							$publish_date = strtotime("now");
							$result = mysql_query ("INSERT INTO wall SET user_from='$user_from', user_owner='$user_owner', message='$message', attachment='$newattachment', count_attach='$count_attach', publish_date='$publish_date'");
							$post_id = mysql_insert_id();
							$this->post($post_id, $message, $newattachment, $user_from, $user_owner, $publish_date);
						}

						function remove_post($post_id){
							$sql_res = mysql_query("SELECT * FROM wall WHERE post_id='$post_id'");
							if(mysql_num_rows($sql_res) != 0 ){
								$arr = mysql_fetch_assoc($sql_res);

								$pieces = explode(",",$arr['attachment']);
								for ($r=0; $r < count($pieces); $r++) { 
                              //unlink(trim($pieces[$r]));

								}
								echo $arr['post_id'] . "| " . $arr['user_from'] . "| " . $arr['user_owner'] . "| " . $arr['message'] . "| " . $arr['attachment'] . "| " . $arr['count_attach'] . "| " . $arr['publish_date'];
								$result = mysql_query ("DELETE FROM wall WHERE post_id='$post_id'");
								if ($result == "true") {
									//$rem_comm = mysql_query ("DELETE FROM comments WHERE post_id='$post_id'");
								}
							}
						}

						function edit_post($message, $attachment, $count_attach, $post_id){
							$publish_date = strtotime("now");
							$result = mysql_query ("UPDATE wall SET message='$message', attachment='$attachment',
								count_attach='$count_attach', publish_date='$publish_date' WHERE post_id='$post_id'");
							if ($result == 'true') {
								echo "true";
							}
						}
						function undo_removing_post($post_id){

							$myarr = explode("|", $post_id);
							$mypost_id = trim($myarr[0]);
							$user_from = trim($myarr[1]);
							$user_owner = trim($myarr[2]);
							$message = trim($myarr[3]);
							$attachment = trim($myarr[4]);
							$count_attach = trim($myarr[5]);
							$publish_date = trim($myarr[6]);
                        //echo $mypost_id .", " . $message;

							$result = mysql_query ("INSERT INTO wall SET post_id='$mypost_id', user_from='$user_from', user_owner='$user_owner', message='$message', attachment='$attachment', count_attach='$count_attach', publish_date='$publish_date'");
							if ($result == "true") {
								echo $mypost_id .", " . $message;
							}
						}

						function get_attach_post($post_id){
							$sql_res = mysql_query("SELECT * FROM wall WHERE post_id='$post_id'");
							if(mysql_num_rows($sql_res) != 0 ){
								$arr = mysql_fetch_assoc($sql_res);
								return $arr;
							}
						}

						function get_post_photo_popup($post_id, $url){

							$likes = new Likes;
							$user = new Users;
							$family = new Family;
							$comment = new Comments;


							$sql_res = mysql_query("SELECT * FROM wall WHERE post_id='$post_id'");
							if(mysql_num_rows($sql_res) != 0 ){
								$arr = mysql_fetch_assoc($sql_res);

								$myprof = $user->users($arr['user_from']);
								if (!is_numeric($arr['user_from'])) {
									$fotos = $myprof['f_photo'];
									$dname = $myprof['f_name'];
									if ($fotos == null) {
										$fotos = $myprof['maine_photo'];
										$dname = $myprof['user_name'];
									}
								} else {
									$fotos = $myprof['user_photo'];
									$dname = $myprof['dog_name'];
								}
								if ($fotos == null) {
									$fotos = "no-photo@2x.png";
								}



								if (($_SESSION['family']) != null) {
									$myaacount = $family->my_account();
									$user_id = $myaacount['f_name'];
									$name = $myaacount['f_name'];
									$breed = $myaacount['breed'];
									$owner_name = $family->myowner;
									$owner_photo = $family->myownerphoto;
									$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" .$myaacount['f_photo'];
								} else {
									$myaacount = $user->my_account();
									$user_id = $myaacount['user_id'];
									$owner_name = $myaacount['user_name']; 
									$name = $myaacount['dog_name'];
									$breed = $myaacount['breed'];
									$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" .$myaacount['user_photo'];
									$owner_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $myaacount['maine_photo'];
								}
								$count_like = $likes->get_post_likes($post_id);
								$serch_like = $likes->serch_user_like($post_id, $user_id);
								$count_comment = $comment->get_count_comment($post_id);?>

								<script>
									$( function() {
										initShare();
										$(document).on('click','.follow-dogs', function() {
											value = $(this).attr('id');

											var parid = this.parentNode.id;

											var scrim = $('#follow-dog-image_' + value).attr('src');

											document.getElementById("account_image_popup_" + parid).src = scrim; 

											document.getElementById("newcomment_avatar_popup_" + parid).src = scrim;
											document.getElementById('post_likes_' + parid).setAttribute('data-user', value);

										});

								 //$.getScript('https://cdn.jsdelivr.net/sharer.js/latest/sharer.min.js'); 
								 function auto_grow(element) {
								 	element.style.height = "5px";
								 	element.style.height = (element.scrollHeight)+"px";
								 }

								} );
							</script>
							<div class="popup popup-photo" id="<?= $post_id;?>">
								<div class="tile">
									<div class="post-popup-image">
										<img src="<?= $url;?>" alt="" class="image">
									</div>
									<div class="post-popup-details">
										<div class="flex-wrapper">
											<div class="post-dog-image">
												<a href="user?id=<?= $arr['user_from']; ?>">
													<img src="http://<?= $_SERVER['HTTP_HOST']. '/img/avatar/' . $fotos;?>" alt="dog picture">
												</a>
											</div>
											<div class="post-dog-description">
												<a href="user?id=<?= $arr['user_from']; ?>">
													<p class="post-dog-name">
														<?= $dname;?>
													</p>
												</a>
												<p class="post-dog-time post_time_<?= $post_id;?>">

													<?php
													$date = new DateTime();
													$date->setTimestamp($arr['publish_date']);
													$gdate = $date->format("d F Y");
													$gday = $date->format("d");
													$gHour = $date->format("H");
													$gTime = $date->format("i");
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
										<div class="post-action flex-wrapper flex-wrapper-jc-space-between" id="<?= $post_id;?>">

											<div class="post-rating post_likes" id="post_likes_<?= $post_id;?>" data-user="<?php echo $user_id;?>">
												<?php 
												if ($serch_like == 1) { ?>
												<div class="link link-green highpawes post_likes_popup_<?= $post_id;?>"><?php echo $count_like;?>
												</div>
												<?php } else {?>
												<div class="link link-gray highpawes post_likes_popup_<?= $post_id;?>"><?php echo $count_like;?>
												</div>
												<?php } ?>

											</div>

											<div class="right-part flex-wrapper">
												<div class="post-comment">
													<div class="link link-gray comments post_comment_popup_<?= $post_id;?>"><?php echo $count_comment;?></div>
												</div>
												<div class="post-share">
													<a href="#" class="link link-gray share"></a>
													<ul class="tile list  share-list flex-wrapper hidden">
														<li class="list-item share-list-item">
															<a class="link sharer button" data-sharer="facebook" data-url="<?= $attch;?>">
																<img src="img/facebook_icon_dark.svg" alt="fb" class="image">
															</a>
														</li>
														<li class="list-item share-list-item">
															<a class="link sharer button" data-sharer="twitter" data-title="Checkout Sharer!" data-hashtags="<?php echo "$message"; ?>" data-url="<?php echo $attch; ?>">
																<img src="img/twitter_icon_dark.svg" alt="tw" class="image">
															</a>

														</li> 
														<li class="list-item share-list-item">
															<a class="link" target="_blank" data-pin-do="buttonPin" href="https://www.pinterest.com/pin/create/button/?url=http://petsoverload.yaskravo.net&media=<?= $attch;?>&description=<?= $message;?>" data-pin-custom="true">
																<img src="img/pinterest_icon_dark.svg" alt="pin" class="image">
															</a>
														</li>
														<li class="list-item share-list-item">

															<a class="link sharer button" data-sharer="tumblr" data-caption="<?= $message;?>" data-title="<?= $message;?>" data-tags="social,share" data-url="<?= $attch;?>">
																<img src="img/tumblr_icon_dark.svg" alt="tmb" class="image">
															</a>
														</li>
														<li class="list-item share-list-item">

															<a class="link sharer button" data-sharer="email" data-title="petsoverload" data-url="http://petsoverload.yaskravo.net/<?= $attch;?>" data-subject="<?= $message;?>" data-to="<?= $email;?>">
																<img src="img/mail.svg " alt="mail" class="image">
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="flex-wrapper comment_list_popup">
											<ul class="comment_list comment_list_<?= $post_id;?>" id="<?= $post_id;?>">
												<?php 
												$comment->get_comment($post_id, 0, 5);?>

												<?php
												if ($comment->get_count_comment($post_id) <= 5 ) {?>

												<?php } else { ?>

												<button class="link link-green tac block comment_view_popup_<?= $post_id;?>" id="comment_view_popup" data-count="<?= $comment->get_count_comment($post_id);?>">View more</button>
												<hr class="hr-full-width">
												<?php } ?>
											</ul>
										</div>
										<div class="newpost newcomment newcomment_<?= $post_id;?>" id="<?= $post_id;?>">
											<img src="<?php echo $photo;?>" alt="" class="newcomment-avatar" id="newcomment_avatar_popup_<?= $post_id;?>">
											<form action="comment" class="newcomment-form">
												<textarea maxlength="400" rows="1" onkeyup="auto_grow(this)" class="newpost-text text_add_comment_popup" id="text_add_comment_popup_<?= $post_id;?>" placeholder="Your comment"></textarea>
											</form>
											<div class="newpost-active-part hidden">


												<hr class="hr  hr-full-width hr-full-width  family-hr">
												<div class="flex-wrapper flex-wrapper-jc-space-between" style="float: right;">

													<div class="flex-wrapper-right-side flex-wrapper">
														<div class="post-account-menu flex-wrapper">
															<div class="account-image" id="<?= $post_id;?>">
																<img src="<?php echo $photo;?>" alt="pet-image" class="image" id="account_image_popup_<?= $post_id;?>">
															</div>
															<div class="account-dropdown-arrow account-dropdown-arrow-popup"></div>
															<div class="tile account-choice-dropdown hidden dropdown">
																<p class=" account-choice-dropdown-title">Liking and commenting as:</p>
																<ul class="list list-follow-dogs select_users_<?= $post_id;?>" id="<?= $post_id;?>">
																	<?php $this->list_follow_dogs(); ?>
																</ul>
															</div>
														</div>
														<div class="flex-wrapper-right-side flex-wrapper" id="<?= $post_id;?>">
															<input type="submit" id="add_comment_popup" class="link button button-cta-green post-button" value="Send" data-user="<?php echo $user_id;?>">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<?php
						}
					}

				}
				?>
<?php
include_once "functions.php";

class Followers{

	/*ищем на кого подписан я для Profile-Guest*/
	function count_follow_me($owner_id){
		
		$result = mysql_query("SELECT * FROM followers WHERE owner_id='$owner_id'") or die(mysql_error());
		
		$arr = mysql_fetch_assoc($result);?>
		
		<div class="userprofile-counter counter count_follow_me">
			<a href="Following" class="link">
				<p class="counter-value">
					<?= mysql_num_rows($result);?>
				</p>
				<p class="counter-description">
					Following
				</p>
			</a>
		</div>
		<?php 
	}

	function count_following($owner_id){
		
		$result = mysql_query("SELECT * FROM followers WHERE owner_id='$owner_id'") or die(mysql_error());
		return mysql_num_rows($result);
	}

	/*ищем кто подписан на нас для Profile-Guest*/
	function count_followers_me($owner_id){
		
		$result = mysql_query("SELECT * FROM followers WHERE my_following='$owner_id'") or die(mysql_error());
		
		$arr = mysql_fetch_assoc($result);?>
		
		<div class="userprofile-counter counter count_followers_me">
			<a href="follower" class="link">
				<p class="counter-value">
					<?= mysql_num_rows($result);?>
				</p>
				<p class="counter-description">
					Followers
				</p>
			</a>
		</div>
		<?php 
	}

	function followers_count($owner_id){
		
		$result = mysql_query("SELECT * FROM followers WHERE my_following='$owner_id'") or die(mysql_error());
		
		return mysql_num_rows($result);
	}


	function serch_follow($id){
		if(($_SESSION['family']) != null ) {

			$user_id = $_SESSION['family'];
		} else {
			$user_id = $_SESSION['user_id'];
		}
		$getid = $_SESSION['get_id'];
		if ($user_id != $id) {

			$result = mysql_query("SELECT * FROM followers WHERE owner_id='$user_id' AND my_following='$id'") or die(mysql_error());
			if(mysql_num_rows($result) != 0 ){ 
				$arr = mysql_fetch_assoc($result);?>
				<div class="follow-list-item-state state-unfollow state-unfollow_<?= $id; ?>" id="<?= $id; ?>">
					<button class="link button button-cta-green contest-button follow-cta add_follow" id="add_following">
						Follow
					</button>
					<button class="link button contest-button following-message add_follow" id="remove_following">
						Following
					</button>
				</div>
				<?php } else { ?>
				<div class="follow-list-item-state state-follow state-follow_<?= $id; ?>" id="<?= $id; ?>">
					<button class="link button button-cta-green contest-button follow-cta add_follow" id="add_following">
						Follow
					</button>
					<p class="following-message">
						Following
					</p>
					<button class="link button contest-button unfollow-cta add_follow" id="remove_following">
						Unfollow
					</button>
				</div>
				<?php }
			} else {

			}
		}

		function serch_follow_sidebar($id){
			if(($_SESSION['family']) != null ) {

				$user_id = $_SESSION['family'];
			} else {
				$user_id = $_SESSION['user_id'];
			}
			$getid = $_SESSION['get_id'];
			if ($user_id != $id) {

				$result = mysql_query("SELECT * FROM followers WHERE owner_id='$user_id' AND my_following='$id'") or die(mysql_error());
				if(mysql_num_rows($result) != 0 ){ 
					$arr = mysql_fetch_assoc($result);?>
					<div class="follow-list-item-state state-unfollow state_follow_sidebar state-unfollow_<?= $id; ?>" id="<?= $id; ?>">
						<button class="link button button-cta-green contest-button follow-cta add_follow follow_sidebar" id="add_following">
							Follow
						</button>
						<button class="link button contest-button following-message add_follow follow_sidebar" id="remove_following">
							Following
						</button>
					</div>
					<?php } else { ?>
					<div class="follow-list-item-state state-follow state_follow_sidebar state-follow_<?= $id; ?>" id="<?= $id; ?>">
						<button class="link button button-cta-green contest-button follow-cta add_follow follow_sidebar" id="add_following">
							Follow
						</button>
						<p class="following-message">
							Following
						</p>
						<button class="link button contest-button unfollow-cta add_follow follow_sidebar" id="remove_following">
							Unfollow
						</button>
					</div>
					<?php }
				} else {

				}
			}

			function follow($id, $owner_id, $my_following){
				$followe = new Followers;
				$user_f = new Users;
		/*	if(($_SESSION['family']) != null ) {

					$user_id = $_SESSION['family'];
				} else {
					$user_id = $_SESSION['user_id'];
				}*/
				$user_id = $_SESSION['get_id'];

				if ($my_following == $user_id) {
					$ufrom = $user_f->users($owner_id);

					if (!is_numeric($owner_id)) {
						$fotos = $ufrom['f_photo'];
						$dname = $ufrom['f_name'];
						$fdresult = mysql_query("SELECT * FROM users WHERE family='$dname'");
						for ($tr=0; $tr < mysql_num_rows($fdresult); $tr++) {
							$treu[$tr] = mysql_fetch_assoc($fdresult);
					//print_r($treu);
							$bredstr[] = $treu[$tr]['breed'];
							$locstr[] = $treu[$tr]['location'];
							$breedcount = mysql_num_rows($fdresult);

						}
					//$strbred = implode(",", $bredstr);
					//$strloc = implode(",", $locstr);
						$breed = $breedcount . " pets ";
					//$location = $strloc;
					} else {
						if ($ufrom['dog_name']) {
							$fotos = $ufrom['user_photo'];
							$dname = $ufrom['dog_name'];
							$breed = $ufrom['breed'];
							$location = $ufrom['location'];
						} else{
							$fotos = $ufrom['maine_photo'];
							$dname = $ufrom['user_name'];
							$breed = $ufrom['breed'];
							$location = $ufrom['location'];
						}
						
					}
					if ($fotos == null) {
						$fotos = "paw-avatar.png";
					}
					?>
					<li class="list-element followers followers_<?= $owner_id; ?>" id="<?= $owner_id; ?>">
						<div class="flex-wrapper follow-list-item">

							<div class="flex-wrapper user_follower_photo">
								<div class="follow-dog-image follow-dog-image-centered">
									<a href="user?id=<?= $owner_id; ?>">
										<img src="http://<?= $_SERVER['HTTP_HOST']. '/img/avatar/' . $fotos;?>" alt="dog picture">
									</a>
								</div>
								<div class="follow-dog-description">
									<a href="user?id=<?= $owner_id; ?>">
										<p class="follow-dog-name follow-dog-name-centered">
											<?= $dname;?>
										</p>
									</a>
									<p class="follow-dog-breed ">
										<?= $breed;?>
									</p>
									<p class="follow-dog-age">
										<a href="Discover?location=<?php echo str_replace(' ', '+', $location); ?>" class="link link-blue">
											<?= $location;?>
										</a>
									</p>
								</div>
							</div>
							<?php $this->serch_follow($owner_id); ?>
						<!-- <div class="follow-list-item-state state-follow" id="<?= $owner_id; ?>">
							<button class="link button button-cta-green contest-button follow-cta add_follow" id="add_following">
								Follow
							</button>
							<p class="following-message">
								Following
							</p>
							<button class="link button contest-button unfollow-cta add_follow" id="remove_following">
								Unfollow
							</button>
						</div> -->
					</div>
				</li>
				<?php } 
			}
			function following($id, $owner_id, $my_following){
				$followe = new Followers;
				$user_f = new Users;
			/*	if(($_SESSION['family']) != null ) {

					$user_id = $_SESSION['family'];
				} else {
					$user_id = $_SESSION['user_id'];
				}*/
				$user_id = $_SESSION['get_id'];
				if ($owner_id == $user_id) {
					$ufrom = $user_f->users($my_following);
					if (!is_numeric($my_following)) {
						$fotos = $ufrom['f_photo'];
						$dname = $ufrom['f_name'];
						$fdresult = mysql_query("SELECT * FROM users WHERE family='$dname'");
						for ($tr=0; $tr < mysql_num_rows($fdresult); $tr++) {
							$treu[$tr] = mysql_fetch_assoc($fdresult);
					//print_r($treu);
							$bredstr[] = $treu[$tr]['breed'];
							$locstr[] = $treu[$tr]['location'];
							$breedcount = mysql_num_rows($fdresult);

						}
						$strbred = implode(",", $bredstr);
						$strloc = implode(",", $locstr);
						$breed = $breedcount . " pets ";
						//$location = $strloc;
					} else{
						if ($ufrom['dog_name']) {
							$fotos = $ufrom['user_photo'];
							$dname = $ufrom['dog_name'];
							$breed = $ufrom['breed'];
							$location = $ufrom['location'];
						} else{
							$fotos = $ufrom['maine_photo'];
							$dname = $ufrom['user_name'];
							$breed = $ufrom['breed'];
							$location = $ufrom['location'];
						}
					}
					if ($fotos == null) {
						$fotos = "paw-avatar.png";
					}
					?>
					<li class="list-element followers followers_<?= $my_following; ?>" id="<?= $my_following; ?>">
						<div class="flex-wrapper follow-list-item">

							<div class="flex-wrapper" id="<?= $my_following; ?>">
								<div class="follow-dog-image follow-dog-image-centered user_follower_photo">
									<a href="user?id=<?= $my_following; ?>">
										<img src="http://<?= $_SERVER['HTTP_HOST']. '/img/avatar/' . $fotos;?>" alt="dog picture">
									</a>
								</div>
								<div class="follow-dog-description">
									<a href="user?id=<?= $my_following; ?>">
										<p class="follow-dog-name follow-dog-name-centered">
											<?= $dname;?>
										</p>
									</a>
									<p class="follow-dog-breed ">
										<?= $breed;?>
									</p>
									<p class="follow-dog-age">
										<a href="Discover?location=<?php echo str_replace(' ', '+', $location); ?>" class="link link-blue">
											<?= $location;?>
										</a>
									</p>
								</div>
							</div>
							<?php $this->serch_follow($my_following); ?>
							<!-- <div class="follow-list-item-state state-unfollow state-unfollow_<?= $my_following; ?>" id="<?= $my_following; ?>">
								<button class="link button button-cta-green contest-button follow-cta add_follow" id="add_following">
									Follow
								</button>
							<p class="following-message">
								Following
							</p>
							<button class="link button contest-button following-message add_follow" id="remove_following">
								Following
							</button>
						</div> -->
					</div>
				</li>
				<?php }
			}

			/*-------------------FOLLOWERS - те, кто следят/следуют за тобой----------------------*/
			function get_follow($start, $limit){

			/*	if(($_SESSION['family']) != null ) {

					$user_id = $_SESSION['family'];
				} else {
					$user_id = $_SESSION['user_id'];
				}*/
				$user_id = $_SESSION['get_id'];
				$result = mysql_query("SELECT * FROM followers WHERE my_following='$user_id' LIMIT $limit") or die(mysql_error());
				if(mysql_num_rows($result) != 0 ){ 
					while($arr = mysql_fetch_assoc($result)){
						$this->follow($arr['id'], $arr['owner_id'], $arr['my_following']);
						
					}
					
					
				}
			}

			/*---------------FOLLOWING - те, за кем слежу/следую я. То есть я на них подписан--------------*/
			function get_following($start, $limit){

			/*	if(($_SESSION['family']) != null ) {

					$user_id = $_SESSION['family'];
				} else {
					$user_id = $_SESSION['user_id'];
				}*/
				$user_id = $_SESSION['get_id'];
				$result = mysql_query("SELECT * FROM followers WHERE owner_id='$user_id' LIMIT $start, $limit") or die(mysql_error());
				if(mysql_num_rows($result) != 0 ){ 
					while($arr = mysql_fetch_assoc($result)){
						$this->following($arr['id'], $arr['owner_id'], $arr['my_following']);
					}
				}
			}
			function set_follow($user_id, $my_following){
				$meresult = mysql_query("SELECT * FROM followers WHERE owner_id='$user_id' AND my_following='$my_following'") or die(mysql_error());
				if(mysql_num_rows($meresult) != 0 ){ 

				} else{

					$result = mysql_query ("INSERT INTO followers SET owner_id='$user_id', my_following='$my_following'");
				}


			}

			function remove_following($user_id, $my_following){
				$result = mysql_query ("DELETE FROM followers WHERE owner_id='$user_id'AND my_following='$my_following'");
			}
		}
		?>
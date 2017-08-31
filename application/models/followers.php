<?php
include_once "functions.php";

class Followers{

	/*ищем на кого подписан я для Profile-Guest*/
	function count_follow_me($owner_id){
		
		$result = mysql_query("SELECT * FROM followers WHERE owner_id='$owner_id'") or die(mysql_error());
		
		$arr = mysql_fetch_assoc($result);?>
		
		<div class="userprofile-counter counter count_follow_me">
			<a href="/Following" class="link">
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
			<a href="/follower" class="link">
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
		if(($_SESSION['family_id']) != null ) {

			$user_id = $_SESSION['family_id'];
		} else {
			$user_id = $_SESSION['user_id'];
		}
		$oid = $_SESSION['owner_id'];
		$getid = $_SESSION['get_id'];


		if ($user_id != $id ) {

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
			if(($_SESSION['family_id']) != null ) {

				$user_id = $_SESSION['family_id'];
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

				$user_id = $_SESSION['get_id'];

				if ($my_following == $user_id) {
					$ufrom = $user_f->users($owner_id);

					$fotos = $ufrom['photo'];
					$dname = $ufrom['name'];
					if ($ufrom['user_id'] == $ufrom['family_id']) {
						$breed = $user_f->get_count_family_members($ufrom['family_id']) . " pets ";
					} else {
						$breed = $ufrom['breed'] ."<br>" . $ufrom['sex'] . ", Age " . (date('Y') - gmdate("Y", $timestamp));
					}
					if ($ufrom['owner'] == 1) {
						$location = $ufrom['location'];
						$breed = "";
					} else {
						$location="";
					}

					if ($fotos == null) {
						$fotos = "paw-avatar.png";
					}
					$user_f->get_user_account($owner_id, $fotos, $dname, $breed, $location, 1);
				} 
			}
			function following($id, $owner_id, $my_following){
				$followe = new Followers;
				$user_f = new Users;

				$user_id = $_SESSION['get_id'];
				if ($owner_id == $user_id) {
					$ufrom = $user_f->users($my_following);
					$fotos = $ufrom['photo'];
					$dname = $ufrom['name'];
					if ($ufrom['user_id'] == $ufrom['family_id']) {
						$breed = $user_f->get_count_family_members($ufrom['family_id']) . " pets ";
					} else {
						$breed = $ufrom['breed'] ."<br>" . $ufrom['sex'] . ", Age " . (date('Y') - gmdate("Y", $timestamp));
					}
					if ($ufrom['owner'] == 1) {
						$location = $ufrom['location'];
						$breed = "";
					} else {
						$location="";
					}
					if ($fotos == null) {
						$fotos = "paw-avatar.png";
					}
					$user_f->get_user_account($my_following, $fotos, $dname, $breed, $location, 1);
				}
			}

			/*-------------------FOLLOWERS - те, кто следят/следуют за тобой----------------------*/
			function get_follow($start, $limit){

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

				$user_id = $_SESSION['get_id'];
				$result = mysql_query("SELECT * FROM followers WHERE owner_id='$user_id' LIMIT $limit") or die(mysql_error());
				if(mysql_num_rows($result) != 0 ){ 
					while($arr = mysql_fetch_assoc($result)){
						$this->following($arr['id'], $arr['owner_id'], $arr['my_following']);
					}
				}
			}
			function set_follow($user_id, $my_following){
				$family = new Family;
				$meresult = mysql_query("SELECT * FROM followers WHERE owner_id='$user_id' AND my_following='$my_following'") or die(mysql_error());
				if(mysql_num_rows($meresult) != 0 ){ 

				} else{
					$ufamily = $family->get_owner($my_following);
					if ($ufamily == 0 ) {
						$result = mysql_query ("INSERT INTO followers SET owner_id='$user_id', my_following='$my_following'");
					} else {
						$cnt_family = $family->get_user_family_members($ufamily);
						for ($i=0; $i < count($cnt_family); $i++) { 
						$result = mysql_query ("INSERT INTO followers SET owner_id='$user_id', my_following='$cnt_family[$i]'");
						}
					}

				}
			}

			function remove_following($user_id, $my_following){
				$family = new Family;
				$ufamily = $family->get_owner($my_following);
				if ($ufamily == 0) {
					$result = mysql_query ("DELETE FROM followers WHERE owner_id='$user_id'AND my_following='$my_following'");
				} else {
					$cnt_family = $family->get_user_family_members($ufamily);
					for ($i=0; $i < count($cnt_family); $i++) { 
						$result = mysql_query ("DELETE FROM followers WHERE owner_id='$user_id'AND my_following='$cnt_family[$i]'");
					}
				}
				
			}
		}
		?>
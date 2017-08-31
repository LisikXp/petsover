<?php
require_once "functions.php";
class Valuat{

	public $myid;
	public $allinfo;
	
	public $mybreed;
	public $mylocation;
	public $uid;
	public $sumvalua;
	public $family_sumvalua;
	public $myfamily;

	function __construct(){
		$myuser = new Users;
		
		if (($_SESSION['family_id']) != null ) {

			$user_id = $_SESSION['family_id'];
			$myfamily = $_SESSION['family_id'];
		} else {
			$user_id = $_SESSION['user_id'];
			
		}
		$my_valuat = $myuser->my_owner();
		$this->mybreed = $myuser->my_breed();
		$this->mylocation = $my_valuat['location'];
		$this->uid = $_SESSION['user_id'];
		$this->sumvalua = 0;
	}

	function get_my_info(){
		
	}

	/*----------USERS----------*/

	/*----------------------------выборка пользователей с общими фоловерами----------------------------*/
	function common_followers($uid){
		
		
		$myfollowers = $this->get_follow_family($uid);
		$myfollow = $this->get_my_follower();
		for ($q=0; $q < count($myfollowers); $q++) {
			
			$folower_serch = mysql_query("SELECT * FROM followers WHERE owner_id<>'$uid' AND my_following='$myfollowers[$q]'");
			if(mysql_num_rows($folower_serch) != 0 ){
				for ($n=0; $n < mysql_num_rows($folower_serch); $n++) { 
					$serch_follow_arr = mysql_fetch_assoc($folower_serch);
					$common[] =  $serch_follow_arr['my_following'];
				}
			}
		}
		$rat = array_unique($common);
		$arr = array_merge($rat);
		for ($z=0; $z < count($myfollow); $z++) { 
			for ($i=0; $i < count($arr); $i++) { 
				if ($myfollow[$z]['my_following'] == $arr[$i]) {
					$comara[] = 1;
				} 
			}
			
		}
		return $comara;
	}
	
	/*----------------------------------------end------------------------------------------------------*/

	/*---------------------выводим всех пользователей кроме данного пользователя--------------------*/
	function get_all_account(){
		$uid = $_SESSION['user_id'];
		$oid = $_SESSION['owner_id'];
		
		$result = mysql_query("SELECT * FROM user WHERE owner_id<>'$oid' AND owner<>'1'");
		if(mysql_num_rows($result) != 0 ){
			for ($i=0; $i < mysql_num_rows($result); $i++) { 
				$row = mysql_fetch_assoc($result);
				$owner_id = $row['user_id'];

      		//$arr[] = $row['breed'];
				if ($row['breed'] == $this->mybreed) {
					$sumvalua['breed'] = 3;
				} else {
					$sumvalua['breed'] = 0;
				}
				if ($row['location'] == $this->mylocation) {
					$sumvalua['location'] = 1;
				} else {
					$sumvalua['location'] = 0;
				}	

				$get_follow_family = $this->common_followers($owner_id);


				$sumvalua['common'] = count($get_follow_family);
				/*----------------------------------подсчитываем количество фолловеров--------------------------------------*/

				$sumvalua['follow'] = ($this->get_follow($owner_id));

				/*-----------------------------------------------end-------------------------------------------------------*/

				/*---------------------------------подсчитываем кол-во коментариев-----------------------------------------*/

				$sumvalua['comment'] = ($this->get_comment($owner_id));

				/*-----------------------------------------------end-------------------------------------------------------*/

				/*----------------------------------подсчитываем количество лайков-------------------------------------*/


				$sumvalua['like'] = ($this->get_likes($owner_id));


				/*-----------------------------------------------------end-------------------------------------------------*/

				/*----------------------------------подсчет количества загруженных фото------------------------------------*/

				$get_wall_photo_uid = $this->get_wall($owner_id);

				if ($row['user_id'] == $get_wall_photo_uid['owner_id']) {
					$sumvalua['photo'] = (($get_wall_photo_uid['count']/10));
					$sumvalua['post'] = (($get_wall_photo_uid['count_post']/10));


				}
				//$sumvalua = $this->sumvalua;
				/*-----------------------------------------------end-------------------------------------------------------*/
				
				$family_sumvaluaхsum = array_sum($sumvalua);

				$user_row[$i] = array_merge( array( 'mainsum' => $family_sumvaluaхsum, 'name' => $row['name'], 'photo' => $row['photo'], 'breed' => $row['breed'], 'location' => $row['location'], 'user_id' => $row['user_id'], 'owner_id' => $row['owner_id']) );
				
			}
			rsort($user_row);
			return $user_row;
		}
		
	}

	/*------------------------------------------end----------------------------------------------------------*/

	function sumvalue_add(){
		$users = new Users;
		$oid = $_SESSION['owner_id'];
		$all_account = $this->get_all_account();
		$result = mysql_query("SELECT * FROM user WHERE owner_id<>'$oid' AND owner<>'1'");
		if(mysql_num_rows($result) != 0 ){
			
			for ($i=0; $i < mysql_num_rows($result); $i++) { 
				$row = mysql_fetch_assoc($result);

				$arr[] = $row['owner_id'];

			}
			$all_owner = array_merge(array_unique($arr));
			for ($r=0; $r < count($all_owner); $r++) { 
				for ($t=0; $t < count($all_account); $t++) { 

					if ($all_owner[$r] == $all_account[$t]['owner_id']) {
						$all_ac[$r][] = $all_account[$t]['mainsum'];
						

					}
				}
			}
			for ($y=0; $y < count($all_ac); $y++) { 
				$rty[] = array_sum($all_ac[$y]);
			}

			for ($w=0; $w < count($all_owner); $w++) { 
				$fresult = mysql_query("SELECT * FROM user WHERE owner_id='$all_owner[$w]' AND profile='1'");
				if(mysql_num_rows($fresult) != 0 ){
					$row = mysql_fetch_assoc($fresult);
					$count = $users->get_count_family_members($row['user_id']);
					if ($row['user_id'] == $row['family_id']) {
						$fcount = ($rty[$w]/($count + 2));
					} else {
						$fcount = $rty[$w];
					}
					$user_row[$w] = array_merge( array( 'mainsum' => $fcount, 'name' => $row['name'], 'photo' => $row['photo'], 'breed' => $row['breed'], 'location' => $row['location'], 'user_id' => $row['user_id'], 'sex' => $row['sex'], 'family_id' => $row['family_id'], 'owner_id' => $row['owner_id'], 'birthday' => $row['birthday']) );
				}
			}
/*
rsort($user_row);
			echo "<pre>";
			print_r($user_row);
			echo "</pre>";*/
			rsort($user_row);
			return $user_row;
		}
	}

	/*--------------end-----------------*/

	function get_list_users(){
		$myfamily = $_SESSION['family_id'];
		$all_profile = $this->sumvalue_add();
		$users = new Users;
		 $main_url = new Main_url;
/*		echo "<pre>";
		print_r($all_account);
		echo "</pre>";*/
		for ($i=0; $i < 10; $i++) {
			$myfolow = $this->get_common_follower($all_profile[$i]['user_id']);
			if ($myfolow['my_following'] != $all_profile[$i]['user_id']) {
				$fotos = $all_profile[$i]['photo'];
				$timestamp = $all_profile[$i]['birthday'];
				if ($fotos == null) {
					$fotos = "paw-avatar.png";
				} ?>
				<li class="list-item follow-dog followers_<?= $all_profile[$i]['user_id']; ?>" id="<?= $all_profile[$i]['user_id']; ?>" data-val="<?= $all_profile[$i]['mainsum'];?>">
					<div class="flex-wrapper">
						<div class="follow-dog-image">
							<a href="<?= $main_url->get_url($all_profile[$i]['user_id']); ?>">
								<img src="http://<?= $_SERVER['HTTP_HOST']. '/img/avatar/' . $fotos;?>" alt="dog picture">
							</a>
						</div>
						<div class="follow-dog-description">
							<a href="<?= $main_url->get_url($all_profile[$i]['user_id']); ?>">
								<p class="follow-dog-name">
									<?php echo $all_profile[$i]['name'];?>
								</p>
							</a>
							<p class="follow-dog-breed">
								<?php if ($all_profile[$i]['user_id'] == $all_profile[$i]['family_id']) {
									$breed = $users->get_count_family_members($all_profile[$i]['user_id']) . " pets ";
								} else {
									$breed = $all_profile[$i]['breed'];
								};
								echo $breed;?>
							</p>
							<div class="add_remove_followers add_remove_followers_<?= $all_profile[$i]['user_id'];?>" id="<?= $all_profile[$i]['user_id'];?>">
								<button class="link link-green follow-dog-follow-link add_follow" id="add_following_tofollow">
									+ Follow
								</button>
								<button class="link link-green follow-dog-follow-link add_follow" id="removing_following_tofollow">
									Unfollow
								</button>

							</div>
						</div>
					</div>
				</li>
				<?php
			}
		}
	}

	function get_count_user(){
		$all_profile = $this->sumvalue_add();
		$myfolow = $this->get_my_follower();

		rsort($all_profile);

		return (count($all_profile) - count($myfolow));
	}

	function get_all_list_users($start, $limit){
		$followers = new Followers;
		$users = new Users;
		$all_profile = $this->sumvalue_add();
		for ($i=0; $i < $limit; $i++) {
			$myfolow = $this->get_common_follower($all_profile[$i]['user_id']);
			if ($myfolow['my_following'] != $all_profile[$i]['user_id']) {
				$fotos = $all_profile[$i]['photo'];
				$timestamp = $all_profile[$i]['birthday'];
				if ($fotos == null) {
					$fotos = "paw-avatar.png";
				}

				if ($all_profile[$i]['user_id'] == $all_profile[$i]['family_id']) {
					$breed = $users->get_count_family_members($all_profile[$i]['user_id']) . " pets ";
				} else {
					$breed = $all_profile[$i]['breed'] ."<br>" . $all_profile[$i]['sex'] . ", Age " . (date('Y') - gmdate("Y", $timestamp));
				}
				if ($all_profile[$i]['owner'] == 1) {
					$location = $all_profile[$i]['location'];
					$breed = "";
				} else {
					$location="";
				}

				$users->get_user_account($all_profile[$i]['user_id'], $fotos, $all_profile[$i]['name'], $breed, $location, 1);

			}
		}
	}

	function get_likes($uid){
		$likes_fam_result = mysql_query("SELECT * FROM likes WHERE user_id='$uid'");
		if(mysql_num_rows($likes_fam_result) != 0 ){

			return (mysql_num_rows($likes_fam_result)/100);
		}
	}

	function get_comment($uid){
		$comment_result_family = mysql_query("SELECT * FROM comments WHERE user_from='$uid'");
		if(mysql_num_rows($comment_result_family) != 0 ){

			return (mysql_num_rows($comment_result_family)/100);
		}
	}

	function get_follow($uid){
		$folower_result = mysql_query("SELECT * FROM followers WHERE owner_id='$uid'");
		if(mysql_num_rows($folower_result) != 0 ){

			return (mysql_num_rows($folower_result));
		}
	}

	function get_follow_family($uid){
		$folower_fname = mysql_query("SELECT * FROM followers WHERE owner_id='$uid'");
		if(mysql_num_rows($folower_fname) != 0 ){
			for ($l=0; $l < mysql_num_rows($folower_fname); $l++) { 
				$family_foll = mysql_fetch_assoc($folower_fname);
				$arrr[]= $family_foll['my_following'];
				/*$arrr['count'] = mysql_num_rows($folower_fname);*/
			}

		}
		return $arrr;
	}

	function get_common_follower($uid){
		if (($_SESSION['family_id']) != null ) {

			$user_id = $_SESSION['family_id'];

		} else {
			$user_id = $_SESSION['user_id'];

		}
		$my_followerr = mysql_query("SELECT * FROM followers WHERE owner_id='$user_id' AND my_following='$uid'");
		if(mysql_num_rows($my_followerr) != 0 ){
			for ($ter=0; $ter < mysql_num_rows($my_followerr); $ter++) { 
				$myar = mysql_fetch_assoc($my_followerr);

			}
			$myarray['my_following'] = $myar['my_following'];
		}
		return $myarray;
	}

	function get_my_follower(){
		if (($_SESSION['family_id']) != null ) {

			$user_id = $_SESSION['family_id'];

		} else {
			$user_id = $_SESSION['user_id'];

		}
		$my_followerr = mysql_query("SELECT * FROM followers WHERE owner_id='$user_id'");
		if(mysql_num_rows($my_followerr) != 0 ){
			for ($ter=0; $ter < mysql_num_rows($my_followerr); $ter++) { 
				$myar[] = mysql_fetch_assoc($my_followerr);

			}
			return $myar;
		}

	}

	function get_wall($uid){
		$wallphoto_result_uid = mysql_query("SELECT * FROM wall WHERE user_from='$uid'");
		if(mysql_num_rows($wallphoto_result_uid) != 0 ){

			for ($d=0; $d < mysql_num_rows($wallphoto_result_uid); $d++) { 
				$wallphoto = mysql_fetch_assoc($wallphoto_result_uid);
				$ecrt[$d] =  $wallphoto['count_attach'];
			}
			$count_photo = array_sum($ecrt);      			
			$wallphoto_arr['owner_id'] = $wallphoto['user_from'];
			$wallphoto_arr['count'] = $count_photo;
			$wallphoto_arr['count_post'] = mysql_num_rows($wallphoto_result_uid);
		}
		return $wallphoto_arr;
	}



}
?>
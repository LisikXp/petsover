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
		
		if (($_SESSION['family']) != null ) {

			$user_id = $_SESSION['family'];
			$myfamily = $_SESSION['family'];
		} else {
			$user_id = $_SESSION['user_id'];
			
		}
		$my_valuat = $myuser->users($_SESSION['user_id']);
		$this->mybreed =  $my_valuat['breed'];
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
		
		
		$result = mysql_query("SELECT * FROM users WHERE user_id<>'$uid' AND dog_name>'' AND family=''");
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
				/*$user_row[$i] = array_merge( array( 'sumvaluasum' => $family_sumvaluaхsum, 'sumvalua' => $sumvalua, 'user_id' => $row['user_id'], 'user_name' => $row['user_name'], 'dog_name' => $row['dog_name'], 'maine_photo' => $row['maine_photo'], 'user_photo' => $row['user_photo'], 'breed' => $row['breed'], 'sex' => $row['sex'], 'location' => $row['location'], 'family' => $row['family']) );*/
				$user_row[$i] = array_merge( array( 'mainsum' => $family_sumvaluaхsum, 'user_name' => $row['user_name'], 'dog_name' => $row['dog_name'], 'maine_photo' => $row['maine_photo'], 'user_photo' => $row['user_photo'], 'breed' => $row['breed'], 'location' => $row['location'], 'user_id' => $row['user_id'],) );
				
			}
			rsort($user_row);
			return $user_row;
		}
		
	}

	function get_all_account_family($family){

		$result = mysql_query("SELECT * FROM users WHERE family='$family'");
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
				
				$family_sumvaluaхsum[$i] = array_sum($sumvalua);
				/*	$user_row[$i] = array_merge( array( 'sumvalua' => $sumvalua, 'sumvaluasum' => $family_sumvaluaхsum, 'user_id' => $row['user_id'], 'user_name' => $row['user_name'], 'dog_name' => $row['dog_name'], 'maine_photo' => $row['maine_photo'], 'user_photo' => $row['user_photo'], 'breed' => $row['breed'], 'sex' => $row['sex'], 'location' => $row['location'], 'family' => $row['family']) );*/
				$user_row[$i] = array_merge( array( 'sumvalua' => $sumvalua, 'sumvaluasum' => $family_sumvaluaхsum, 'dog_name' => $row['dog_name'], 'location' => $row['location']) );
				
			}
			
			return $family_sumvaluaхsum;
		}
		
	}
	/*------------------------------------------end----------------------------------------------------------*/

	/* ------------get family------------*/
	function get_all_family(){
		$myfamily = $_SESSION['family'];
		$uresult = mysql_query("SELECT * FROM family WHERE f_name<>'$myfamily'");
		if(mysql_num_rows($uresult) != 0 ){
			for ($r=0; $r < mysql_num_rows($uresult); $r++) { 
				$roww = mysql_fetch_assoc($uresult);

				$fname = $roww['f_name'];
				$fphoto = $roww['f_photo'];
				$users_of_family = $this->get_all_account_family($fname);
				/*----------------------достаем общих кол-во фолловеров семьи-----------------------------------*/

				$get_follow_family = $this->common_followers($fname);


				$this->family_sumvalua['common'] = count($get_follow_family);

				/*-------------------------end-----------------------------------------------------*/

				/*----------------------------------подсчитываем количество фолловеров--------------------------------------*/

				$this->family_sumvalua['followers'] = ($this->get_follow($fname));

				/*-----------------------------------------------end-------------------------------------------------------*/

				/*---------------------------------подсчитываем кол-во коментариев-----------------------------------------*/

				$this->family_sumvalua['comment'] = ($this->get_comment($fname));

				/*-----------------------------------------------end-------------------------------------------------------*/

				/*----------------------------------подсчитываем количество лайков-------------------------------------*/


				$this->family_sumvalua['like'] = ($this->get_likes($fname));


				/*-----------------------------------------------------end-------------------------------------------------*/

				/*----------------------------------подсчет количества загруженных фото------------------------------------*/

				$get_wall_photo_uid = $this->get_wall($fname);

				if ($fname == $get_wall_photo_uid['owner_id']) {
					$this->family_sumvalua['photo'] = (($get_wall_photo_uid['count']/10));
					$this->family_sumvalua['post'] = (($get_wall_photo_uid['count_post']/10));


				}
				$family_sumvaluaх = $this->family_sumvalua;

				$family_sumvaluaхsum = array_sum($this->family_sumvalua);
			/*	for ($i=0; $i < count($users_of_family); $i++) { 

					$user_sum[$i] = $users_of_family[$i]['sumvaluasum'];

				}
				*/

			//print_r($user_sum);
				$user_summ = array_sum($users_of_family);
				$main_summ = ($family_sumvaluaхsum + $user_summ)/count($users_of_family);

				/*$user_row[$r] = array_merge( array( 'mainsum' => $main_summ, 'sumvalua' => $family_sumvaluaх, 'sumvaluasum' => $family_sumvaluaхsum, 'sumvaluauser' => $user_summ, 'count' => count($users_of_family)), $roww, $users_of_family);*/

				/*$user_row[$r] = array_merge( array( 'mainsum' => $main_summ, 'sumvalua' => $family_sumvaluaх, 'sumvaluasum' => $family_sumvaluaхsum, 'sumvaluauser' => $user_summ, 'commosumm' => ($family_sumvaluaхsum + $user_summ), 'count' => count($users_of_family)), $roww, $users_of_family);*/
				$user_row[$r] = array_merge( array( 'mainsum' => $main_summ, 'dog_name' => $fname, 'user_photo' => $fphoto, 'user_id' => $fname, 'breed' => count($users_of_family)." pets"), $roww);



			}
			rsort($user_row);
			return $user_row;
		}
	}
	/*--------------end-----------------*/

	function get_list_users(){
		$myfamily = $_SESSION['family'];
		$all_account = $this->get_all_account();
		$get_all_family = $this->get_all_family();
		$all_profile = array_merge($all_account, $get_all_family);
		rsort($all_profile);
	/*	echo "<pre>";
		print_r($all_profile);
		echo "</pre>";*/
		for ($i=0; $i < 10; $i++) {
			$myfolow = $this->get_common_follower($all_profile[$i]['user_id']);
			if ($myfolow['my_following'] != $all_profile[$i]['user_id']) {
				$fotos = $all_profile[$i]['user_photo'];
				if ($fotos == null) {
					$fotos = "paw-avatar.png";
				} ?>
				<li class="list-item follow-dog followers_<?= $all_profile[$i]['user_id']; ?>" id="<?= $all_profile[$i]['user_id']; ?>" data-val="<?= $all_profile[$i]['mainsum'];?>">
					<div class="flex-wrapper">
						<div class="follow-dog-image">
							<a href="user?id=<?= $all_profile[$i]['user_id']; ?>">
								<img src="http://<?= $_SERVER['HTTP_HOST']. '/img/avatar/' . $fotos;?>" alt="dog picture">
							</a>
						</div>
						<div class="follow-dog-description">
							<a href="user?id=<?= $all_profile[$i]['user_id']; ?>">
								<p class="follow-dog-name">
									<?php echo $all_profile[$i]['dog_name'];?>
								</p>
							</a>
							<p class="follow-dog-breed">
								<?php echo $all_profile[$i]['breed'];?>
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
		$all_account = $this->get_all_account();
		$get_all_family = $this->get_all_family();
		$myfolow = $this->get_my_follower();
		$all_profile = array_merge($all_account, $get_all_family);
		rsort($all_profile);

		return (count($all_profile) - count($myfolow));
	}

	function get_all_list_users($start, $limit){
		$followers = new Followers;
		$all_account = $this->get_all_account();
		$get_all_family = $this->get_all_family();
		$all_profile = array_merge($all_account, $get_all_family);
		rsort($all_profile);
		for ($i=0; $i < $limit; $i++) {
			$myfolow = $this->get_common_follower($all_profile[$i]['user_id']);
			if ($myfolow['my_following'] != $all_profile[$i]['user_id']) {
				$fotos = $all_profile[$i]['user_photo'];
				if ($fotos == null) {
					$fotos = "paw-avatar.png";
				}?>
				<li class="list-element followers followers_<?= $all_profile[$i]['user_id']; ?>" id="<?= $all_profile[$i]['user_id']; ?>" data-val="<?= $all_profile[$i]['mainsum'];?>">
					<div class="flex-wrapper follow-list-item">

						<div class="flex-wrapper" id="<?= $all_profile[$i]['user_id']; ?>">
							<div class="follow-dog-image follow-dog-image-centered user_follower_photo">
								<a href="user?id=<?=$all_profile[$i]['user_id']; ?>">
									<img src="http://<?= $_SERVER['HTTP_HOST']. '/img/avatar/' . $fotos;?>" alt="dog picture">
								</a>
							</div>
							<div class="follow-dog-description">
								<a href="user?id=<?= $all_profile[$i]['user_id'];?>">
									<p class="follow-dog-name follow-dog-name-centered">
										<?= $all_profile[$i]['dog_name'];?>
									</p>
								</a>
								<p class="follow-dog-breed ">
									<?= $all_profile[$i]['breed'];?>
								</p>
								<p class="follow-dog-age">
									<a href="Discover?location=<?php echo str_replace(' ', '+', $all_profile[$i]['location']); ?>" class="link link-blue">
										<?= $all_profile[$i]['location'];?>
									</a>
								</p>
							</div>
						</div>
						<?php $followers->serch_follow($all_profile[$i]['user_id']); ?>
					</div>
				</li>
				<?php
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
		if (($_SESSION['family']) != null ) {

			$user_id = $_SESSION['family'];

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
		if (($_SESSION['family']) != null ) {

			$user_id = $_SESSION['family'];

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
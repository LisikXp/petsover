<?php
require_once "functions.php";
class Valuat{

	public $myid;
	public $allinfo;
	
	function get_my_info(){
		$myuser = new Users;
		
		if (($_SESSION['family']) != null ) {

			$user_id = $_SESSION['family'];
			$myfamily = $_SESSION['family'];
		} else {
			$user_id = $_SESSION['user_id'];
			
		}
		$my_valuat = $myuser->users($_SESSION['user_id']);
		$mybreed =  $my_valuat['breed'];
		$mylocation = $my_valuat['location'];
		$uid = $_SESSION['user_id'];
		$sumvalua = 0;

		/*------------достаем фолловеров данного авторизированного пользователь------------------------*/
		$comm_follower =  mysql_query("SELECT * FROM followers WHERE owner_id='$user_id'");
		if(mysql_num_rows($comm_follower) != 0 ){
			for ($j=0; $j < mysql_num_rows($comm_follower); $j++) { 
				$myf[$j] = mysql_fetch_assoc($comm_follower);
				//echo $myf['my_following'];
				$myfollow[] = $myf[$j]['my_following'];
						//print_r(mysql_fetch_assoc($comm_follower));
						//echo "</pre>";
			}
		}
		/*-----------------------------------------end-------------------------------------------------*/

		/*----------------------------выборка пользователей с общими фоловерами----------------------------*/

		for ($q=0; $q < count($myfollow); $q++) {
			$serchfoll = $myfollow[$q];
			$folower_serch = mysql_query("SELECT * FROM followers WHERE owner_id<>'$user_id' AND my_following='$serchfoll'");
			if(mysql_num_rows($folower_serch) != 0 ){
				for ($n=0; $n < mysql_num_rows($folower_serch); $n++) { 
					$serch_follow_arr[] = mysql_fetch_assoc($folower_serch);
				}
			}
		}

		/*----------------------------------------end------------------------------------------------------*/


		/*---------------------выводим всех пользователей кроме данного пользователя--------------------*/

		$result = mysql_query("SELECT * FROM users WHERE user_id<>'$uid' AND family=''");
		if(mysql_num_rows($result) != 0 ){
			for ($i=0; $i < mysql_num_rows($result); $i++) { 
				$row[$i] = mysql_fetch_assoc($result);
				$owner_id = $row[$i]['user_id'];

      		//$arr[] = $row['breed'];
				if ($row[$i]['breed'] == $mybreed) {
					$sumvalua = 3;
				} else {
					$sumvalua = 0;
				}
				if ($row[$i]['location'] == $mylocation) {
					$sumvalua = $sumvalua +1;
				} else {
					$sumvalua = $sumvalua;
				}	
				for ($z=0; $z < count($serch_follow_arr); $z++) { 
					if ($row[$i]['user_id'] == $serch_follow_arr[$z]['owner_id']) {
						$sumvalua = ($sumvalua + 1);

					}
					if ($row[$i]['family'] == $serch_follow_arr[$z]['owner_id']) {
						$sumvalua = ($sumvalua + 1);
					}
				}

				/*----------------------------------подсчитываем количество фолловеров--------------------------------------*/

				$sumvalua = ($sumvalua + $this->get_follow($owner_id));

				/*-----------------------------------------------end-------------------------------------------------------*/

				/*---------------------------------подсчитываем кол-во коментариев-----------------------------------------*/

				$sumvalua = ($sumvalua + $this->get_comment($owner_id));

				/*-----------------------------------------------end-------------------------------------------------------*/

				/*----------------------------------подсчитываем количество фолловеров-------------------------------------*/


				$sumvalua = ($sumvalua + $this->get_likes($owner_id));


				/*-----------------------------------------------------end-------------------------------------------------*/

				/*----------------------------------подсчет количества загруженных фото------------------------------------*/

				$get_wall_photo_uid = $this->get_wall($owner_id);

				if ($row[$i]['user_id'] == $get_wall_photo_uid['owner_id']) {
					$sumvalua = ($sumvalua + ($get_wall_photo_uid['count']/10));

				}

				/*-----------------------------------------------end-------------------------------------------------------*/

				$user_row[$i] = array_merge( array( 'sumvalua' => $sumvalua, 'user_id' => $row[$i]['user_id'], 'user_name' => $row[$i]['user_name'], 'dog_name' => $row[$i]['dog_name'], 'maine_photo' => $row[$i]['maine_photo'], 'user_photo' => $row[$i]['user_photo'], 'breed' => $row[$i]['breed'], 'sex' => $row[$i]['sex'], 'location' => $row[$i]['location'], 'email' => $row[$i]['email']) );
				
			}
			

		}
		/*----------------------------------------end------------------------------------------------------*/


		/* ------------get family------------*/


		$uresult = mysql_query("SELECT * FROM family WHERE f_name<>'$myfamily'");
		if(mysql_num_rows($uresult) != 0 ){
			for ($r=0; $r < mysql_num_rows($uresult); $r++) { 
				$roww[$r] = mysql_fetch_assoc($uresult);
				
				if ($roww[$r]['f_name'] != null) {
					$fname = $roww[$r]['f_name'];
				}else{
					$fname = $roww[$r]['family'];
				}

				$fnamefam[] = $fname;
				/*----------------------достаем кол-во фолловеров семьи-----------------------------------*/

				$get_follow_family = $this->get_follow_family($fname);

				/*-------------------------end-----------------------------------------------------*/

				/*----------------------------------подсчет количества загруженных фото------------------------------------*/

				$get_wall_photo = $this->get_wall($fname);

				/*-----------------------------------------------end-------------------------------------------------------*/

				/*--------------------достаем аккаунты семьи---------------------------------------*/

				$fresult = mysql_query("SELECT * FROM users WHERE family='$fname'");
				if(mysql_num_rows($fresult) != 0 ){
					for ($t=0; $t < mysql_num_rows($fresult); $t++) {
						$frow[$t] = mysql_fetch_assoc($fresult);

						if ($frow[$t]['breed'] == $mybreed) {
							$fsumvalua = 3;
						} else {
							$fsumvalua = 0;
						}
						if ($frow[$t]['location'] == $mylocation) {
							$fsumvalua = $fsumvalua +1;
						} else {
							$fsumvalua = $fsumvalua;
						}	

						if ($frow[$t]['family'] == $get_follow_family['owner_id']) {
							$fsumvalua = ($fsumvalua + $get_follow_family['count']);
						}
						for ($u=0; $u < count($serch_follow_arr); $u++) { 
							if ($frow[$t]['user_id'] == $serch_follow_arr[$u]['owner_id']) {
								$fsumvalua = ($fsumvalua + 1);

							}
							if ($frow[$t]['family'] == $serch_follow_arr[$u]['owner_id']) {
								$fsumvalua = ($fsumvalua + 1);
							}
						}
						if ($frow[$t]['family'] == $get_wall_photo['owner_id']) {
							$fsumvalua = ($fsumvalua + ($get_wall_photo['count']/10));

						}
					//$infofamily['family'] = $frow[t]['family'];
						$infofamily['breed'] = $frow[$t]['breed'];
						$infofamily['location'] = $frow[$t]['location'];
						$arrinfo[] = $infofamily;
						$owner_id =  $frow[$t]['user_id'];
						$owner_fam = $frow[$t]['family'];

						/*----------------------------------подсчитываем количество фолловеров-------------------------------------*/

						$fsumvalua = ($fsumvalua + $this->get_follow($owner_id));

						/*-----------------------------------------------------end-------------------------------------------------*/

						/*---------------------------------подсчитываем кол-во коментариев-----------------------------------------*/

						$fsumvalua = ($fsumvalua + $this->get_comment($fname));

						$fsumvalua = ($fsumvalua + $this->get_comment($owner_id));

						/*-----------------------------------------------end-------------------------------------------------------*/

						/*----------------------------------подсчитываем количество likes-------------------------------------*/

						$fsumvalua = ($fsumvalua + $this->get_likes($owner_id));

						$fsumvalua = ($fsumvalua + $this->get_likes($fname));

						/*-----------------------------------------------------end-------------------------------------------------*/


						$ffrwo[$t] = array_merge( array( 'sumvalua' => $fsumvalua ), $frow[$t] );
						/*$ffrwo['sumvalua'] = $fsumvalua;
						$ffrwo['dog_name'] = $frow[$t]['dog_name'];
						$ffrwo['user_photo'] = $frow[$t]['user_photo'];
						$ffrwo['location'] = $frow[$t]['location'];
						$ffrwo['family'] = $frow[$t]['family'];
						$ffrwo['user_id'] = $frow[$t]['user_id'];

						$ffrwos[] = $ffrwo;*/

					}
					/*--------------------------------------end-------------------------------------*/
					
				}
			}
		}


		$allrow = array_merge( $ffrwo, $user_row );
		

		$this->get_family_info($allrow, $fnamefam);
     //print_r($arrinfo);

	}

	function get_family_info($row, $fname){
		
		
		//print_r($fname);	
		for ($er=0; $er < count($fname); $er++) { 

			for ($yi=0; $yi < count($row); $yi++) { 

				if ($fname[$er] == $row[$yi]['family']) {
					
					$freet = $row[$yi]['family'];
					$frett[$freet][$yi] = $row[$yi]['sumvalua'];


				} 
				if ($row[$yi]['family'] == null) {
					$frew[$yi] = $row[$yi];
				}

			}

			$ret[$fname[$er]] = implode(",", $frett[$fname[$er]]);
			$wert[$fname[$er]] = explode(",", $ret[$fname[$er]]);
		
			$arrname[$fname[$er]] = (array_sum($wert[$fname[$er]])/count($wert[$fname[$er]]));

			$ufresult = mysql_query("SELECT * FROM family WHERE f_name='$fname[$er]'");
			if(mysql_num_rows($ufresult) != 0 ){
				//print_r(mysql_fetch_assoc($ufresult));

				$pou = mysql_fetch_assoc($ufresult);
				$fuuln['sumvalua'] =$arrname[$fname[$er]]; 
				$fuuln['family_id'] = $pou['family_id'];
				$fuuln['user_id'] = $pou['f_name'];
				$fuuln['dog_name'] = $pou['f_name'];
				$fuuln['user_photo'] = $pou['f_photo'];
				$fuuln['user_name'] =$pou['f_name'];
				$fuuln['breed'] =0;
				$fuuln['birthday'] =0;
				$fuuln['sex'] =0 ;
				$fuuln['location'] =0;
				$fuuln['time_registration'] =0;
				$fuuln['email'] =0;
				$fuuln['password'] =0;
				$fuuln['family'] =$pou['f_name'];

			}
			$tyui[] = $fuuln;
		}
		$arrmarg = array_merge($tyui, $frew);

		//rsort($arrmarg);
		//$this->get_list_users($arrmarg);
		$this->myid = $arrmarg;
		
	}

	function get_list_users(){
		$this->get_my_info();
		$array = $this->myid;
		rsort($array);
/*		echo "<pre>";
		print_r($array);
		echo "</pre>";*/
		for ($i=0; $i < 10; $i++) { //for ($i=0; $i < count($array); $i++) { 
			$fdfamnam = $array[$i]['family'];
			$fid = $array[$i]['user_id'];
			//echo $array[$i]['sumvalua'];
			$myfolow = $this->get_my_follower($fid);
			if ($myfolow['my_following'] != $fid) {

				if ($array[$i]['family'] != null) {
					$fotos = $array[$i]['user_photo'];
					$dname = $array[$i]['dog_name'];
					$id = $array[$i]['dog_name'];
					$fdresult = mysql_query("SELECT * FROM users WHERE family='$dname'");
					for ($tr=0; $tr < mysql_num_rows($fdresult); $tr++) {
						$treu[$tr] = mysql_fetch_assoc($fdresult);
					//print_r($treu);
						$bredstr[$tr] = $treu[$tr]['breed'];
						$locstr[$tr] = $treu[$tr]['location'];
						$breedcount = mysql_num_rows($fdresult);

					}
				//$strbred = implode(",", $bredstr);
				//$strloc = implode(",", $locstr);
					$breed = $breedcount . " pets " ;
					$location = $strloc;
				} else{
					$fotos = $array[$i]['user_photo'];
					$dname = $array[$i]['dog_name'];
					$breed = $array[$i]['breed'];
					$location = $array[$i]['location'];
					$id = $array[$i]['user_id'];
				}
				if ($fotos == null) {
					$fotos = "paw-avatar.png";
				}

//rsort($arrmarg);

				if ($dname != null ) {
				
					?>
					<li class="list-item follow-dog followers_<?= $id; ?>" id="<?= $id; ?>" data-val="<?= $array[$i]['sumvalua'];?>">
						<div class="flex-wrapper">
							<div class="follow-dog-image">
								<a href="user?id=<?= $id; ?>">
									<img src="http://<?= $_SERVER['HTTP_HOST']. '/img/avatar/' . $fotos;?>" alt="dog picture">
								</a>
							</div>
							<div class="follow-dog-description">
								<a href="user?id=<?= $id; ?>">
									<p class="follow-dog-name">
										<?php echo $dname;?>
									</p>
								</a>
								<p class="follow-dog-breed">
									<?php echo $breed;?>
								</p>
								<div class="add_remove_followers add_remove_followers_<?= $id;?>" id="<?= $id;?>">
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
	/*echo "<pre>";
	print_r($myfolow);

	echo "</pre>";*/
}
function get_count_whotofollow(){
	$this->get_my_info();
	$array = $this->myid;
	for ($i=0; $i < count($array); $i++) { 
		$fid = $array[$i]['user_id'];
		$myfolow = $this->get_my_follower($fid);
		if ($myfolow['my_following'] != $fid) {
			if ($array[$i]['family'] != null) {
				$user[$i]['fotos'] = $array[$i]['user_photo'];
				$user[$i]['dname'] = $array[$i]['dog_name'];
				$dname = $array[$i]['dog_name'];
				$user[$i]['id'] = $array[$i]['dog_name'];
			
				$fdresult = mysql_query("SELECT * FROM users WHERE family='$dname'");
				for ($tr=0; $tr < mysql_num_rows($fdresult); $tr++) {
					$treu[$tr] = mysql_fetch_assoc($fdresult);
					//print_r($treu);
					$bredstr[$tr] = $treu[$tr]['breed'];
					$locstr[$tr] = $treu[$tr]['location'];
					$breedcount = mysql_num_rows($fdresult);

				}
				
				$user[$i]['breed'] = $breedcount . " pets " ;
				$user[$i]['location'] = $strloc;
			} else{
				$user[$i]['fotos'] = $array[$i]['user_photo'];
				$user[$i]['dname'] = $array[$i]['dog_name'];
				$user[$i]['breed'] = $array[$i]['breed'];
				$user[$i]['location'] = $array[$i]['location'];
				$user[$i]['id'] = $array[$i]['user_id'];
				
			}
		}
	}
	return $user;
}

function get_all_list_users($start, $limit){
	$followers = new Followers;
	$this->get_my_info();
	,
		$array = $this->myid;
		rsort($array);
	/*	echo "<pre>";
		print_r($this->get_count_whotofollow());
		echo "</pre>";*/
		for ($i=0; $i < count($array); $i++) { //for ($i=0; $i < count($array); $i++) { 
			$fdfamnam = $array[$i]['family'];
			$fid = $array[$i]['user_id'];
			//echo $array[$i]['sumvalua'];
			$myfolow = $this->get_my_follower($fid);
			if ($myfolow['my_following'] != $fid) {

				if ($array[$i]['family'] != null) {
					$fotos = $array[$i]['user_photo'];
					$dname = $array[$i]['dog_name'];
					$id = $array[$i]['dog_name'];
					$fdresult = mysql_query("SELECT * FROM users WHERE family='$dname'");
					for ($tr=0; $tr < mysql_num_rows($fdresult); $tr++) {
						$treu[$tr] = mysql_fetch_assoc($fdresult);
					//print_r($treu);
						$bredstr[$tr] = $treu[$tr]['breed'];
						$locstr[$tr] = $treu[$tr]['location'];
						$breedcount = mysql_num_rows($fdresult);

					}
				//$strbred = implode(",", $bredstr);
				//$strloc = implode(",", $locstr);
					$breed = $breedcount . " pets " ;
					$location = $strloc;
				} else{
					$fotos = $array[$i]['user_photo'];
					$dname = $array[$i]['dog_name'];
					$breed = $array[$i]['breed'];
					$location = $array[$i]['location'];
					$id = $array[$i]['user_id'];
				}
				if ($fotos == null) {
					$fotos = "paw-avatar.png";
				}

//rsort($arrmarg);

				if ($dname != null ) {
					
					?>
					<li class="list-element followers followers_<?= $id; ?>" id="<?= $id; ?>" data-val="<?= $array[$i]['sumvalua'];?>">
						<div class="flex-wrapper follow-list-item">

							<div class="flex-wrapper" id="<?= $id; ?>">
								<div class="follow-dog-image follow-dog-image-centered user_follower_photo">
									<a href="user?id=<?= $id; ?>">
										<img src="http://<?= $_SERVER['HTTP_HOST']. '/img/avatar/' . $fotos;?>" alt="dog picture">
									</a>
								</div>
								<div class="follow-dog-description">
									<a href="user?id=<?= $id; ?>">
										<p class="follow-dog-name follow-dog-name-centered">
											<?= $dname;?>
										</p>
									</a>
									<p class="follow-dog-breed ">
										<?= $breed;?>
									</p>
									<p class="follow-dog-age">
										<a href="#" class="link link-blue">
											<?= $location;?>
										</a>
									</p>
								</div>
							</div>
							<?php $followers->serch_follow($id); ?>
						</div>
					</li>
					<?php
				} 
			}
		}
	/*echo "<pre>";
	print_r($myfolow);

	echo "</pre>";*/
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

		return (mysql_num_rows($folower_result)/100);
	}
}

function get_follow_family($uid){
	$folower_fname = mysql_query("SELECT * FROM followers WHERE owner_id='$uid'");
	if(mysql_num_rows($folower_fname) != 0 ){
		for ($l=0; $l < mysql_num_rows($folower_fname); $l++) { 
			$family_foll = mysql_fetch_assoc($folower_fname);
		}
		$arrr['owner_id']= $family_foll['owner_id'];
		$arrr['count'] = mysql_num_rows($folower_fname);
	}
	return $arrr;
}

function get_my_follower($fid){
	if (($_SESSION['family']) != null ) {

		$user_id = $_SESSION['family'];

	} else {
		$user_id = $_SESSION['user_id'];

	}
	$my_followerr = mysql_query("SELECT * FROM followers WHERE owner_id='$user_id' AND my_following='$fid'");
	if(mysql_num_rows($my_followerr) != 0 ){
		for ($ter=0; $ter < mysql_num_rows($my_followerr); $ter++) { 
			$myar = mysql_fetch_assoc($my_followerr);

		}
		$myarray['my_following'] = $myar['my_following'];
	}
	return $myarray;
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
	}
	return $wallphoto_arr;
}

}
?>
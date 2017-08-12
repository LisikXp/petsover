<?php
class Family{

	public $owner;
	public $myowner;
	public $myownerphoto;
	public $dog_name;
	public $breed;
	public $location;
	public $user_photo;
	public $sex;
	public $birthday;
	public $family;
	public $user_id;
	public $count_pets;
	public $network_link;
	public $myfamily_name;

	function __construct(){

		switch ($_SERVER["REQUEST_URI"]) {
			case '/feed':
			if (($_SESSION['family']) != null) {
				$uid = $_SESSION['family'];
			} else {
				$uid = $_SESSION['user_id'];
			}
			break;

			default:
			$uid = $_SESSION['get_id'];
			break;
		}
		
		
		$fresult = mysql_query("SELECT * FROM users WHERE family='$uid'");
		
		$result = mysql_query("SELECT * FROM family WHERE f_name='$uid'");
		if (mysql_num_rows($result) != 0) {
			$row = mysql_fetch_assoc($result);
		} else {
			$tresult = mysql_query("SELECT * FROM users WHERE user_name='$uid'");
			$trow = mysql_fetch_assoc($tresult);
			$fnam = $trow['family'];
			$presult = mysql_query("SELECT * FROM family WHERE f_name='$fnam'");
			$row = mysql_fetch_assoc($presult);
			$this->myfamily_name = $row['f_name'];
		}
		$frow = mysql_fetch_assoc($fresult);
		
		$this->count_pets = mysql_num_rows($fresult);
		
		$this->user_id = $frow['user_id'];
		$this->dog_name = $frow['dog_name'];
		$this->owner = $frow['user_name'];
		$this->breed = $frow['breed'];
		$this->location = $frow['location'];
		$this->sex = $frow['sex'];
		$this->family =$frow['family'];
		
		if ($frow['maine_photo'] != null) {
			$this->maine_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $frow['maine_photo'];
		} else {
			$this->maine_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png";
		}
		
		
		$timestamp=$frow['birthday'];

		if ($row['f_photo'] != null) {
			$this->user_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $row['f_photo'];
		} else {
			$this->user_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png";
		}
		
		$this->birthday = (date('Y') - gmdate("Y", $timestamp));
		$this->network_link = $frow['network_link'];

	}

	function my_account(){
		$familyy = $_SESSION['family'];
		$fresult = mysql_query("SELECT * FROM users WHERE family='$familyy'");
		$frow = mysql_fetch_assoc($fresult);
		$this->myowner = $frow['user_name'];
		if ($frow['maine_photo'] != 0) {
			$this->myownerphoto = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $frow['maine_photo'];
		} else {
			$this->myownerphoto = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png";
		}
		

		$result = mysql_query("SELECT * FROM family WHERE f_name='$familyy'");
		$row = mysql_fetch_assoc($result); 
		return $row;
		
	}

	
	function get_family_choice(){
		$family = $_SESSION['family'];

		$fresult = mysql_query("SELECT * FROM users WHERE family='$family'");
		for ($i=0; $i < mysql_num_rows($fresult); $i++) {
			$myfamily = mysql_fetch_assoc($fresult); ?>
			<li class="list-item follow-dog follow-dog-option" id="<?php echo $myfamily['user_id'];?>">
				<div class="flex-wrapper">
					<div class="follow-dog-image">
						<img src="<?php echo "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $myfamily['user_photo'];?>" alt="dog picture" id="follow-dog-image_<?= $myfamily['user_id']; ?>">
					</div>
					<div class="follow-dog-description">
						<p class="follow-dog-breed">
							<?php echo $myfamily['dog_name']; ?>
						</p>
						<p class="follow-dog-breed">
							<?php echo $myfamily['breed']; ?>
						</p>
					</div>
				</div>
			</li>
			<?php }
		}

		function get_family_wall_choice(){
			$family = $_SESSION['family'];

			$fresult = mysql_query("SELECT * FROM users WHERE family='$family'");
			for ($i=0; $i < mysql_num_rows($fresult); $i++) {
				$myfamily = mysql_fetch_assoc($fresult); ?>
				<li class="list-item follow-dogs follow-dog-option" id="<?php echo $myfamily['user_id'];?>">
					<div class="flex-wrapper">
						<div class="follow-dog-image">
							<img src="<?php echo "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $myfamily['user_photo'];?>" alt="dog picture" id="follow-dog-image_<?= $myfamily['user_id']; ?>">
						</div>
						<div class="follow-dog-description">
							<p class="follow-dog-breed">
								<?php echo $myfamily['dog_name']; ?>
							</p>
							<p class="follow-dog-breed">
								<?php echo $myfamily['breed']; ?>
							</p>
						</div>
					</div>
				</li>
				<?php }
			}

			function get_family_list($family){
			//$family = $_SESSION['family'];
				$fresult = mysql_query("SELECT * FROM users WHERE family='$family'");
				if (mysql_num_rows($fresult) == 0 ) {
					$sql_res = mysql_query("SELECT * FROM users WHERE user_name='$family'");
					$arrname = mysql_fetch_assoc($sql_res);
					$newfam = $arrname['family'];
					$fresult = mysql_query("SELECT * FROM users WHERE family='$newfam'");
				}
				for ($i=0; $i < mysql_num_rows($fresult); $i++) {
					$arr = mysql_fetch_assoc($fresult); ?>
					<li class="list-item follow-dog">
						<div class="flex-wrapper">
							<div class="follow-dog-image">
								<a href="user?id=<?= $arr['user_id']; ?>">
									<?php 
									if ($arr['user_photo'] == null) {
										$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png";
									} else {
										$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $arr['user_photo'];
									}
									?>
									<img src="<?php echo $photo;?>" alt="dog picture">
								</a>
							</div>
							<div class="follow-dog-description">
								<a href="user?id=<?= $arr['user_id']; ?>">
									<p class="follow-dog-name">
										<?php echo $arr['dog_name'];?>
									</p>
								</a>
								<p class="follow-dog-breed">
									<?php echo $arr['breed'];?>
								</p>
								<p class="follow-dog-age">
									<?php 
									$timestamp=$arr['birthday'];
									echo $arr['sex'] . ", Age " . (date('Y') - gmdate("Y", $timestamp));?>
								</p>
							</div>
						</div>
					</li>
					<?php } 
				}

				function serch_family(){
					$user_id = $_SESSION['user_id'];
					$sql_res = mysql_query("SELECT * FROM users WHERE user_id='$user_id'") or die(mysql_error());
					if(mysql_num_rows($sql_res) != 0 ){ 
						$arr = mysql_fetch_assoc($sql_res);

						if (($arr['family']) != null ) {
							$_SESSION['family'] = $arr['family'];
							header('location: user?id='. $_SESSION['family']);
						} else {
							header('location: user?id='.$_SESSION['user_id']);
						}
					}
				}
				function get_family($family){
					include_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include/Profile-Family.php";
				}


				function add_family($avatar, $dog_name, $uid){
					$fresult =  mysql_query("INSERT INTO family SET f_name='$dog_name', f_photo='$avatar'");
					$result =  mysql_query ("UPDATE users SET family='$dog_name' WHERE user_id='$uid'");
					$sql_res = mysql_query("SELECT * FROM family WHERE f_name=$dog_name");
					$arr = mysql_fetch_assoc($sql_res);         
					$_SESSION['family_id'] = $arr['family_id']; 
					$_SESSION['family'] = $arr['f_name']; 

        //header('location: user?id='. $_SESSION['family']);

				}

				function get_my_family_members(){
					$family = $_SESSION['family'];
					$fmresult = mysql_query("SELECT * FROM users WHERE family='$family'");
					if(mysql_num_rows($fmresult) != 0 ){
						for ($i=0; $i < mysql_num_rows($fmresult); $i++) { 
							$arr = mysql_fetch_assoc($fmresult);
							$uid[] = $arr['user_id'];
							$uid[] = $arr['user_name'];
						}
						return $uid;
					}
				}

				function family_members(){
					$family = $_SESSION['family'];
					$fresult = mysql_query("SELECT * FROM users WHERE family='$family'");
					while ($frow = mysql_fetch_assoc($fresult)) { 
						return $frow;
					}
				}

				function edit_family($name, $photo){
					if ($name == null) {
						$name = $_SESSION['family'];
					}
					$family = $_SESSION['family'];
					$result =  mysql_query ("UPDATE family SET f_name='$name', f_photo='$photo' WHERE f_name='$family'");
					if ($result == "true") {
						$fmresult = mysql_query("SELECT * FROM users WHERE family='$family'");
						if(mysql_num_rows($fmresult) != 0 ){
							for ($i=0; $i < mysql_num_rows($fmresult); $i++) { 
								$arr = mysql_fetch_assoc($fmresult);

								$upp =  mysql_query ("UPDATE users SET family='$name' WHERE family='$family'");
								$upq =  mysql_query ("UPDATE comments SET owner_id='$name' WHERE owner_id='$family'");
								$upw =  mysql_query ("UPDATE comments SET user_from='$name' WHERE user_from='$family'");
								$upe =  mysql_query ("UPDATE followers SET owner_id='$name' WHERE owner_id='$family'");
								$upr =  mysql_query ("UPDATE followers SET my_following='$name' WHERE my_following='$family'");
								$upt =  mysql_query ("UPDATE likes SET user_id='$name' WHERE user_id='$family'");
								$upy =  mysql_query ("UPDATE notification SET user_from='$name' WHERE user_from='$family'");
								$upf =  mysql_query ("UPDATE notification SET user_owner='$name' WHERE user_owner='$family'");
								$upd =  mysql_query ("UPDATE wall SET user_from='$name' WHERE user_from='$family'");
								$ups =  mysql_query ("UPDATE wall SET user_owner='$name' WHERE user_owner='$family'");
								$_SESSION['family'] = $name;
							}

						}
					}
				}

				function add_new_family($dog_name, $avatar) {
					$uid = $_SESSION['user_id'];
					$result = mysql_query("UPDATE users SET family='$dog_name'  WHERE user_id='$uid'");

					$fresult = mysql_query("INSERT INTO family SET f_name='$dog_name', f_photo='$avatar'");
					$this->serch_family();
				}

				function get_all_family(){
					$result = mysql_query("SELECT * FROM family");
					if (mysql_num_rows($result) != 0) {
						$row = mysql_fetch_assoc($result); 
						return $row;
					}
				}


			}
			?>
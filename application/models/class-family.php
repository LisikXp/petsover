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

	function my_account(){
		$familyy = $_SESSION['family_id'];
		$fresult = mysql_query("SELECT * FROM user WHERE user_id='$familyy'");
		$frow = mysql_fetch_assoc($fresult);
		$_SESSION['family'] = $arr['name']; 
		
	}

	function get_owner($family){
		$fresult = mysql_query("SELECT * FROM user WHERE user_id='$family'");
		if (mysql_num_rows($fresult) != 0 ) {
			$arr = mysql_fetch_assoc($fresult);
			return $arr['owner_id'];
		}
	}

	function get_family($uid){
		$fresult = mysql_query("SELECT * FROM user WHERE user_id='$uid'");
		if (mysql_num_rows($fresult) != 0 ) {
			$arr = mysql_fetch_assoc($fresult);
			return $arr['family_id'];
		}
	}

	function get_family_list($family){
		$main_url = new Main_url;
		$uid = $_SESSION['get_id'];
		$owner = $this->get_owner($family);
		$fid = $this->get_family($family);
		$fresult = mysql_query("SELECT * FROM user WHERE owner_id='$owner' AND user_id<>'$owner' AND user_id<>'$uid' AND user_id<>'$fid' ORDER BY user_id DESC ");
		if (mysql_num_rows($fresult) != 0 ) {

			for ($i=0; $i < mysql_num_rows($fresult); $i++) {
				$arr = mysql_fetch_assoc($fresult); ?>
				<li class="list-item follow-dog">
					<div class="flex-wrapper">
						<div class="follow-dog-image">
							<a href="<?= $main_url->get_url($arr['user_id']); ?>">
								<?php 
								if ($arr['photo'] == null) {
									$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png";
								} else {
									$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $arr['photo'];
								}
								?>
								<img class="image" src="<?php echo $photo;?>" alt="dog picture">
							</a>
						</div>
						<div class="follow-dog-description">
							<a href="<?= $main_url->get_url($arr['user_id']); ?>">
								<p class="follow-dog-name">
									<?php echo $arr['name'];?>
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
	
					$fresult = mysql_query("SELECT * FROM user WHERE user_id='$owner'");
					$arr = mysql_fetch_assoc($fresult); ?>
					<li class="list-item follow-dog">
						<div class="flex-wrapper">
							<div class="follow-dog-image">
								
									<?php 
									if ($arr['photo'] == null) {
										$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png";
									} else {
										$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $arr['photo'];
									}
									?>
									<img class="image" src="<?php echo $photo;?>" alt="dog picture">
								
							</div>
							<div class="follow-dog-description">
								
									<p class="follow-dog-name">
										<?php echo $arr['name'];?>
									</p>
								
								<p class="follow-dog-breed">
									Owner
								</p>

							</div>
						</div>
					</li> 
					<?php 
						if ($arr['family_id'] != 0) {
							$fresult = mysql_query("SELECT * FROM user WHERE user_id='$fid'");
							$arr = mysql_fetch_assoc($fresult); 
							$user = new Users;?>
							<li class="list-item follow-dog">
								<div class="flex-wrapper">
									<div class="follow-dog-image">
										<a href="<?= $main_url->get_url($arr['user_id']); ?>">
											<?php 
											if ($arr['photo'] == null) {
												$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png";
											} else {
												$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $arr['photo'];
											}
											?>
											<img class="image" src="<?php echo $photo;?>" alt="dog picture">
										</a>
									</div>
									<div class="follow-dog-description">
										<a href="<?= $main_url->get_url($arr['user_id']); ?>">
											<p class="follow-dog-name">
												<?php echo $arr['name'];?>
											</p>
										</a>
										<p class="follow-dog-breed">
											<?= $user->get_count_family_members($fid)  . " Pets";?> <br>
											Family
										</p>

									</div>
								</div>
							</li> 
							<?php
						}
		
				} else { 
					$fresult = mysql_query("SELECT * FROM user WHERE user_id='$owner'");
					$arr = mysql_fetch_assoc($fresult); ?>
					<li class="list-item follow-dog">
						<div class="flex-wrapper">
							<div class="follow-dog-image">
								
									<?php 
									if ($arr['photo'] == null) {
										$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png";
									} else {
										$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $arr['photo'];
									}
									?>
									<img class="image" src="<?php echo $photo;?>" alt="dog picture">
								
							</div>
							<div class="follow-dog-description">
							
									<p class="follow-dog-name">
										<?php echo $arr['name'];?>
									</p>
								
								<p class="follow-dog-breed">
									Owner
								</p>

							</div>
						</div>
					</li>
					<?php
				}
			}

			function serch_family(){
				$main_url = new Main_url;
				if ($_SESSION['family_id']) {
					//header('location: '. $main_url->get_url($_SESSION['family_id'])); ; exit;
					$url = $main_url->get_url($_SESSION['family_id']);
					echo '<script>location.replace("'.$url.'");</script>'; exit;
				} else {
					//header('location: '.$main_url->get_url($_SESSION['user_id'])); ; exit;
					$url = $main_url->get_url($_SESSION['user_id']);
					echo '<script>location.replace("'.$url.'");</script>'; exit;
				}
			}

			function get_my_family_members(){
				$family = $_SESSION['owner_id'];
				$fmresult = mysql_query("SELECT * FROM user WHERE owner_id='$family'");
				if(mysql_num_rows($fmresult) != 0 ){
					for ($i=0; $i < mysql_num_rows($fmresult); $i++) { 
						$arr = mysql_fetch_assoc($fmresult);
						$uid[] = $arr['user_id'];
						
					}
					return $uid;
				}
			}

			function get_user_family_members($id){

				$fmresult = mysql_query("SELECT * FROM user WHERE owner_id='$id'");
				if(mysql_num_rows($fmresult) != 0 ){
					for ($i=0; $i < mysql_num_rows($fmresult); $i++) { 
						$arr = mysql_fetch_assoc($fmresult);
						$uid[] = $arr['user_id'];
						
					}
					return $uid;
				}
			}

			function edit_family($name, $photo){
				if ($name == null) {
					$name = $_SESSION['family'];
				}
				$family = $_SESSION['family_id'];
				$result =  mysql_query ("UPDATE user SET name='$name', photo='$photo' WHERE user_id='$family'");
				if ($result == "true") {
					$wall = new Wall;
					$wall->set_main_photo_post($family, $family, $photo);
					$_SESSION['family'] = $name;
				}
			}

			function add_new_family($dog_name, $avatar) {
				$uid = $_SESSION['owner_id'];
				$user = new Users;
				$location = $user->get_location();
				$presult = mysql_query("UPDATE user SET profile='0'  WHERE owner_id='$uid'");
				$fresult = mysql_query("INSERT INTO user SET name='$dog_name', photo='$avatar', location='$location', owner_id='$uid', profile='1'");
				$id = mysql_insert_id();
				$_SESSION['family_id'] = $id;
				$_SESSION['user_id'] = $id; 
				$_SESSION['family'] = $dog_name; 
				$result = mysql_query("UPDATE user SET family_id='$id' WHERE owner_id='$uid'");
				$wall = new Wall;
				$wall->set_main_photo_post($id, $id, $avatar);
				//header('location: user?id='. $id);
			}

			function get_all_family(){
				$result = mysql_query("SELECT * FROM user WHERE family_id<>0");
				if (mysql_num_rows($result) != 0) {//
					$row = mysql_fetch_assoc($result); 
					return $row;
				}
			}


		}
		?>
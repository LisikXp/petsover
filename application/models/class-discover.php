<?php

if (isset($_POST['apply_filter'])) {
	if ($_POST['serch_breed']) {
		$serch_breed = strip_tags($_POST['serch_breed']);
		$serch_breed = htmlspecialchars($serch_breed);
		$serch_breed = mysql_escape_string($serch_breed);
		$serch .= "breed=" . $serch_breed . "&";
	}

	if ($_POST['serch_location']) {
		$serch_location = strip_tags($_POST['serch_location']);
		$serch_location = htmlspecialchars($serch_location);
		$serch_location = mysql_escape_string($serch_location);
		$serch .= "location=" . $serch_location . "&";
	}

	if ($_POST['serch_agefrom']) {
		$serch_agefrom = intval($_POST['serch_agefrom']);
		$serch .= "agefrom=" . $serch_agefrom . "&";
	}

	if ($_POST['serch_ageto']) {
		$serch_ageto = intval($_POST['serch_ageto']);
		$serch .= "ageto=" . $serch_ageto;
	}
	
	header('location:/Discover?'.$serch);
	
}

class Users_Discover{
	
	public $limit = 10;
	public $start = 0;
	public $max;

	function get_all_users_no_family($start, $limit){
		
		$uid = $_SESSION['user_id'];
		$result = mysql_query("SELECT * FROM users WHERE family=''");
		if(mysql_num_rows($result) != 0 ){ 
			for ($i=0; $i < mysql_num_rows($result); $i++) {
				$row[] =  mysql_fetch_assoc($result);
				//print_r(mysql_fetch_assoc($result));
			}
			return $row;
		}
		
	}


	function get_all_family($start, $limit){

		$result = mysql_query("SELECT * FROM family");
		if(mysql_num_rows($result) != 0 ){ 

			for ($i=0; $i < mysql_num_rows($result); $i++) { 
				$row[] = mysql_fetch_assoc($result);

			}
			return $row;

		}
	}

	function get_wall_discover(){
		$limit = $this->limit;
		$start = $this->start;
		
		if (isset($_GET['breed']) && isset($_GET['location'])) {
			$breed = $_GET['breed'];
			$location = $_GET['location'];
			$breed_loc = "breed='$breed' AND location='$location'";
			$this->all_serch_account($breed_loc, $start, $limit);

		}elseif (isset($_GET['location'])) {
			$str_location = str_replace('+', ' ', $_GET['location']);
				//echo 'Location';
			$this->discover_serch_by_location($str_location, $start, $limit);
			echo "<hr>";
		}elseif(isset($_GET['breed'])) {
			$breed = $_GET['breed'];
			
			$breed_loc = "breed='$breed'";
			$this->all_serch_account($breed_loc, $start, $limit);
			
		}elseif (isset($_GET['breed']) && isset($_GET['location']) && isset($_GET['agefrom']) && isset($_GET['ageto'])) {
			
			$datefrom = date("d-m-Y", mktime(0, 0, 0, date('m'), date('d'), date('Y') - $_GET['agefrom']));
			$stragefrom = strtotime($datefrom);

			$dateto = date("d-m-Y", mktime(0, 0, 0, date('m'), date('d'), date('Y') - $_GET['ageto']));
			$strageto = strtotime($dateto);
			$breed = $_GET['breed'];
			$location = $_GET['location'];
			$breed_loc = "breed='$breed' AND location='$location' AND birthday<='$stragefrom' AND birthday>='$strageto'";
			$this->all_serch_account($breed_loc, $start, $limit);
			

		}elseif (isset($_GET['agefrom']) || isset($_GET['ageto'])) {

			$datefrom = date("d-m-Y", mktime(0, 0, 0, date('m'), date('d'), date('Y') - $_GET['agefrom']));
			$stragefrom = strtotime($datefrom);

			$dateto = date("d-m-Y", mktime(0, 0, 0, date('m'), date('d'), date('Y') - $_GET['ageto']));
			$strageto = strtotime($dateto);

			$breed_loc = "birthday<='$stragefrom' AND birthday>='$strageto'";
			$this->all_serch_account($breed_loc, $start, $limit);
		

		} else{
			$this->get_all_account($start, $limit);
			$this-> get_count_account();

		}
	}

/*	function get_count_serchlist($breed_loc){
		$result = mysql_query("SELECT * FROM users WHERE birthday<='1491944400' AND birthday>='1376254800'");
		if(mysql_num_rows($result) != 0 ){ 
			for ($i=0; $i < mysql_num_rows($result); $i++) { 
				$row = mysql_fetch_assoc($result);
				echo $row['birthday'] . "<br>";
			}
			
		}
	}*/

	/*function get_count_serchlist($breed_loc){
		echo $breed_loc;
	}
*/
	function all_serch_account($breed_loc, $start, $limit){
		$result = mysql_query("SELECT * FROM users WHERE $breed_loc");
		if(mysql_num_rows($result) != 0 ){ 
			$this->max = mysql_num_rows($result);
			$followers = new Followers;
			if ($limit > mysql_num_rows($result)) {
				$limit = mysql_num_rows($result);
			}
			for ($r=0; $r < mysql_num_rows($result); $r++) { 
				$rows[] = mysql_fetch_assoc($result);
			}
			//echo mysql_num_rows($result);
			
			$row = array_merge($rows);
			//asort($row);
			for ($i=$start; $i < $limit; $i++) { 
				
				if ($row[$i]['dog_name']) {
					$uid = $row[$i]['user_id'];
					$name = $row[$i]['dog_name'];
					$foto = $row[$i]['user_photo'];
					$breed = $row[$i]['breed'];
					$location = $row[$i]['location'];
					$timestamp = $row[$i]['birthday'];
				} else{
					$uid = $row[$i]['user_id'];
					$name = $row[$i]['user_name'];
					$foto = $row[$i]['maine_photo'];
					$location = $row[$i]['location'];
					$breed = "";
					$timestamp = "0";
				}	
				if ($foto == null) {
					$foto = "paw-avatar.png";
				}?>
				<li class="list-element followers followers_<?= $uid; ?>" id="<?= $uid; ?>" data-count="<?= $i;?>">
					<div class="flex-wrapper follow-list-item">

						<div class="flex-wrapper user_follower_photo">
							<div class="follow-dog-image follow-dog-image-centered">
								<a href="user?id=<?= $uid; ?>">
									<img src="http://<?= $_SERVER['HTTP_HOST']. '/img/avatar/' . $foto;?>" alt="dog picture">
								</a>
							</div>
							<div class="follow-dog-description">
								<a href="user?id=<?= $uid; ?>">
									<p class="follow-dog-name follow-dog-name-centered">
										<?= $name;?>
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
						<?php $followers->serch_follow($uid); ?>
					</div>
				</li>
				<?php 

			}
			
		}
	}

	function get_count_account(){
		$no_family = $this->get_all_users_no_family();
		$all_family = $this->get_all_family();
		$allarray = array_merge($no_family, $all_family);
		$this->max = count($allarray);
		return count($allarray);
	}

	function get_all_account($start, $limit){
		$users = new Users;
		$followers = new Followers;

		$no_family = $this->get_all_users_no_family();
		$all_family = $this->get_all_family();
		$allarray = array_merge($no_family, $all_family);
		asort($allarray);
		//print_r($allarray);

		for ($i=$start; $i < $limit; $i++) { 
			if ($allarray[$i]['family_id']) {
				$uid = $allarray[$i]['f_name'];
				$name = $allarray[$i]['f_name'];
				$foto = $allarray[$i]['f_photo'];
				$count_mem = $users->get_count_family_members($uid);
				$location = "";
				$breed = $count_mem ." Pets";
				$result = mysql_query("SELECT * FROM users WHERE family='$name'");
				if(mysql_num_rows($result) != 0 ){ 
					$row = mysql_fetch_assoc($result);
					$timestamp= $row['birthday'];

				}
			} elseif ($allarray[$i]['dog_name']) {
				$uid = $allarray[$i]['user_id'];
				$name = $allarray[$i]['dog_name'];
				$foto = $allarray[$i]['user_photo'];
				$breed = $allarray[$i]['breed'];
				$location = $allarray[$i]['location'];
				$timestamp = $allarray[$i]['birthday'];
			} else{
				$uid = $allarray[$i]['user_id'];
				$name = $allarray[$i]['user_name'];
				$foto = $allarray[$i]['maine_photo'];
				$location = $allarray[$i]['location'];
				$breed = "";
				$timestamp = "0";
			}	
			if ($foto == null) {
				$foto = "paw-avatar.png";
			}

			?>
			<li class="list-element followers followers_<?= $uid; ?>" id="<?= $uid; ?>">
				<div class="flex-wrapper follow-list-item">

					<div class="flex-wrapper user_follower_photo">
						<div class="follow-dog-image follow-dog-image-centered">
							<a href="user?id=<?= $uid; ?>">
								<img src="http://<?= $_SERVER['HTTP_HOST']. '/img/avatar/' . $foto;?>" alt="dog picture">
							</a>
						</div>
						<div class="follow-dog-description">
							<a href="user?id=<?= $uid; ?>">
								<p class="follow-dog-name follow-dog-name-centered">
									<?= $name;?>
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
					<?php $followers->serch_follow($uid); ?>
				</div>
			</li>
			<?php 
		}
	}

	function discover_serch_by_location($location, $start, $limit){
		$followers = new Followers;
		$users = new Users;
		
		$no_family = $this->get_all_users_no_family($start, $limit);
		$all_family = $this->get_all_family($start, $limit);
		

		for ($ii=0; $ii < count($all_family); $ii++) { 
			$fam[$ii] = $all_family[$ii]['f_name'];
			$result = mysql_query("SELECT * FROM users WHERE family='$fam[$ii]'");
			if(mysql_num_rows($result) != 0 ){ 
				$row = mysql_fetch_assoc($result);
				$all_family[$ii]['location'] = $row['location'];

			}
		}

		$allarray = array_merge($no_family, $all_family);
		for ($i=0; $i < count($allarray); $i++) { 
			if ($allarray[$i]['location'] == $location) {
				if ($allarray[$i]['family_id']) {
					$uid = $allarray[$i]['f_name'];
					$name = $allarray[$i]['f_name'];
					$foto = $allarray[$i]['f_photo'];
					$count_mem = $users->get_count_family_members($uid);
					$location = "";
					$breed = $count_mem ." Pets";

				} elseif ($allarray[$i]['dog_name']) {
					$uid = $allarray[$i]['user_id'];
					$name = $allarray[$i]['dog_name'];
					$foto = $allarray[$i]['user_photo'];
					$breed = $allarray[$i]['breed'];
					$location = $allarray[$i]['location'];
				} else{
					$uid = $allarray[$i]['user_id'];
					$name = $allarray[$i]['user_name'];
					$foto = $allarray[$i]['maine_photo'];
					$location = $allarray[$i]['location'];
					$breed = "";
				}	
				if ($foto == null) {
					$foto = "paw-avatar.png";
				}
				?>
				<li class="list-element followers followers_<?= $uid; ?>" id="<?= $uid; ?>">
					<div class="flex-wrapper follow-list-item">

						<div class="flex-wrapper user_follower_photo">
							<div class="follow-dog-image follow-dog-image-centered">
								<a href="user?id=<?= $uid; ?>">
									<img src="http://<?= $_SERVER['HTTP_HOST']. '/img/avatar/' . $foto;?>" alt="dog picture">
								</a>
							</div>
							<div class="follow-dog-description">
								<a href="user?id=<?= $uid; ?>">
									<p class="follow-dog-name follow-dog-name-centered">
										<?= $name;?>
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
						<?php $followers->serch_follow($uid); ?>
					</div>
				</li>
				<?php 
			}
		}

	}


}
?>


<?php
class Users{

	
	public $name;
	public $breed;
	public $location;
	public $user_photo;
	public $sex;
	public $birthday;
	public $family_id;
	public $user_id;
	public $count_pets;
	public $owner;
	public $owner_photo;
	public $network_link;

	function __construct(){

		switch ($_SERVER["REQUEST_URI"]) {
			case '/feed':
			$uid = $_SESSION['user_id'];
			break;

			default:
			$uid = $_SESSION['get_id'];
			break;
		}
		$owid = $_SESSION['owner_id'];
		if ($_SESSION['user_id'] == $_SESSION['get_id']) {
			$result = mysql_query("SELECT * FROM user WHERE user_id='$uid' AND profile='1' OR owner_id='$owid' AND profile='1'");
		} else {
			$result = mysql_query("SELECT * FROM user WHERE user_id='$uid'");
		}
		while ($row = mysql_fetch_assoc($result)) { 
			
			$this->user_id = $row['user_id'];
			$this->name = $row['name'];
			$this->get_owner($uid);
			$this->breed = $row['breed'];
			if ($row['owner'] == 1) {
				$this->location = $row['location'];
			}
			$this->get_network_link($row['owner_id']);

			if ($row['photo'] != null) {
				$this->user_photo = "<img src='http://".$_SERVER['HTTP_HOST'] . "/img/avatar/" .$row['photo'] . "' alt='' class='image my-profile-image-change'>";//"http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $row['photo'];
			} else{
				$this->user_photo = "<img src='http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png' alt='' class='image my-profile-image-change nonephoto'>";//"http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png";
			}
			
			
			$this->sex = $row['sex'];
			$this->family_id = $row['family_id'];
			$timestamp=$row['birthday'];
			
			$this->birthday = (date('Y') - gmdate("Y", $timestamp));
			
			if ($row['family_id'] != 0 && $row['profile'] == 1) {
				$this->breed = $this->get_count_family_members($uid)  . " Pets";
			}

		}
		mysql_free_result($result);
	}

	function my_account(){
		$uid = $_SESSION['user_id'];
		$result = mysql_query("SELECT * FROM user WHERE user_id='$uid'");
		$row = mysql_fetch_assoc($result);
		return $row;
	}

	function my_owner(){
		$uid = $_SESSION['owner_id'];
		$result = mysql_query("SELECT * FROM user WHERE user_id='$uid'");
		$row = mysql_fetch_assoc($result);
		return $row;
	}

	function get_network_link($id){
		$result = mysql_query("SELECT * FROM user WHERE owner_id='$id'");
		$row = mysql_fetch_assoc($result);
		$this->network_link = $row['network_link'];
	}

	function get_owner($id){
		$result = mysql_query("SELECT * FROM user WHERE owner_id='$id'");
		if (mysql_num_rows($result) != 0) {
			$row = mysql_fetch_assoc($result);
			$name = $row['name'];
			$photo = $row['photo'];
		} else {
			$uid = $_SESSION['user_id'];
			$result = mysql_query("SELECT * FROM user WHERE user_id='$uid'");
			$row = mysql_fetch_assoc($result);
			$name = $row['name'];
			$photo = $row['photo'];
		}
		
		$this->owner = $name;
		if ($photo != null) {
			$this->owner_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $photo;
		} else{
			$this->owner_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png";
		}
	}

	function get_uid_by_ownerid(){
		$uid = $_SESSION['owner_id'];
		$result = mysql_query("SELECT * FROM user WHERE owner_id='$uid'");
		if (mysql_num_rows($result) != 0) {
			while ($row = mysql_fetch_assoc($result)) {
				$arr[] = $row['user_id'];
			}
			return $arr;
		}
	}

	function get_count_account(){
		$result = mysql_query("SELECT * FROM user");
		if(mysql_num_rows($result) != 0 ){ 
			return mysql_num_rows($result);
		}
	}

	function get_all_users_id(){
		$uid = $_SESSION['user_id'];
		$result = mysql_query("SELECT * FROM user");
		if(mysql_num_rows($result) != 0 ){ 
			return mysql_fetch_assoc($result);
		}
	}
	
	function users($uid){

		$result = mysql_query("SELECT * FROM user WHERE user_id='$uid'");
		if(mysql_num_rows($result) != 0 ){ 
			return mysql_fetch_assoc($result);
		}
	}

	function my_breed(){
		$uid = $_SESSION['owner_id'];
		$result = mysql_query("SELECT * FROM user WHERE owner_id='$uid'");
		if(mysql_num_rows($result) != 0 ){ 
			$arr = mysql_fetch_assoc($result);
			return $arr['breed'];
		}

	}

	function get_count_family_members($family){
		$result = mysql_query("SELECT * FROM user WHERE family_id='$family' AND user_id<>$family AND owner<>'1'");
		if(mysql_num_rows($result) != 0 ){ 
			return mysql_num_rows($result);
		}
	}

	function get_id_user($uid){

		//$_SESSION['get_id'] = $uid;
		
	}

	function get_user(){
		$uid = $_SESSION['get_id'];
		$result = mysql_query("SELECT * FROM user WHERE user_id='$uid'");

		while ($row = mysql_fetch_assoc($result)) { 
			if ($row["owner_id"] != 0) { 
				include_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include/Profile-Family.php";
			} else{ 
				include_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include/Profile-Guest.php";

			} 
		}

		mysql_free_result($result);
	}

	function update_profile($uid, $name, $breed, $bdate, $sex, $avatar){
		$result = mysql_query("UPDATE user SET name='$name', photo='$avatar', breed='$breed', birthday='$bdate', sex='$sex'  WHERE user_id='$uid'");
		if ($result == "true") {
			$wall = new Wall;
			$wall->set_main_photo_post($uid, $uid, $avatar);
			return "true";
		} else{
			return "false";
		}

	}

	function set_owner(){
		$uid = $_SESSION['owner_id'];
		$result = mysql_query("UPDATE user SET owner_id='$uid', profile='0' WHERE user_id='$uid'");
	}

	function check_count_account(){
		$uid = $_SESSION['owner_id'];
		$result = mysql_query("SELECT * FROM user WHERE owner_id='$uid'");
		return mysql_num_rows($result);
	}

	function get_location(){
		$uid = $_SESSION['owner_id'];
		$result = mysql_query("SELECT * FROM user WHERE user_id='$uid'");
		$arr = mysql_fetch_assoc($result);
		return $arr['location'];
	}

	/*----add profile family-----*/
	function add_another_dog_profile($dog_name, $avatar, $breed, $birthday, $sex){
		$uid = $_SESSION['owner_id'];
		$count_account = $this->check_count_account();
		$location = $this->get_location();
		if ($count_account == 0 ) {
			$this->set_owner();
			$profile = 1;
		} else {
			$profile = 0;
		}
		if ($_SESSION['family_id']) {
			$family_id = $_SESSION['family_id'];
		} else{
			$family_id = 0;
		}
		$result = mysql_query("INSERT INTO user SET name='$dog_name', photo='$avatar', breed='$breed', family_id='$family_id', location='$location', birthday='$birthday', sex='$sex', owner_id='$uid', profile='$profile'");
		$pid = mysql_insert_id();
		$result = mysql_query("SELECT * FROM user WHERE owner_id='$uid' AND profile='1'") or die(mysql_error()); 
		$arruser = mysql_fetch_assoc($result);
		$_SESSION['user_id'] = $arruser['user_id'];
		$wall = new Wall;
		$wall->set_main_photo_post($pid, $pid, $avatar);

		
	}
	/*-----end family-----*/

	function get_user_account($uid, $foto, $name, $breed, $location, $numb){ 
		$followers = new Followers;
		$main_url = new Main_url;?>
		<li class="list-element followers followers_<?= $uid; ?>" id="<?= $uid; ?>">
			<div class="flex-wrapper follow-list-item">

				<div class="flex-wrapper user_follower_photo">
					<div class="follow-dog-image follow-dog-image-centered">
						<a href="<?= $main_url->get_url($uid); ?>">
							<img src="http://<?= $_SERVER['HTTP_HOST']. '/img/avatar/' . $foto;?>" alt="dog picture">
						</a>
					</div>
					<div class="follow-dog-description">
						<a href="<?= $main_url->get_url($uid); ?>">
							<p class="follow-dog-name follow-dog-name-centered">
								<?= $name;?>
							</p>
						</a>
						<p class="follow-dog-breed ">
							<?= $breed;?>
						</p>
						<p class="follow-dog-age">
							<a href="/Discover?location=<?php echo str_replace(' ', '+', $location); ?>" class="link link-blue">
								<?= $location;?>
							</a>
						</p>
					</div>
				</div>
				<?php if ($numb == 1) {
					$followers->serch_follow($uid);
				} ?>
			</div>
		</li>
		<?php }

	}
	?>
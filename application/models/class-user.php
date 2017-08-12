<?php
class Users{

	
	public $dog_name;
	public $breed;
	public $location;
	public $user_photo;
	public $sex;
	public $birthday;
	public $family;
	public $user_id;
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
		
		if (is_numeric($uid)) {
			$result = mysql_query("SELECT * FROM users WHERE user_id='$uid'");
		} else{
			$result = mysql_query("SELECT * FROM users WHERE user_name='$uid'");
		}
		
		while ($row = mysql_fetch_assoc($result)) { 
			
			$this->user_id = $row['user_id'];
			$this->dog_name = $row['dog_name'];
			$this->owner = $row['user_name'];

			if ($row['maine_photo'] != null) {
				$this->owner_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $row['maine_photo'];
			} else{
				$this->owner_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png";
			}
			
			if ($row['user_name'] == null) {
				$fam = $row['family'];
				$fresult = mysql_query("SELECT * FROM users WHERE family='$fam'");
				$frow = mysql_fetch_assoc($fresult);
				$this->owner = $frow['user_name'];
				if ($frow['maine_photo'] != null) {
					$this->owner_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $frow['maine_photo'];
				} else{
					$this->owner_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/paw-avatar.png";
				}
			}


			
			$this->breed = $row['breed'];
			$this->location = $row['location'];

			if ($row['user_photo'] !=null) {
				$this->user_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $row['user_photo'];
			} else{
				$this->user_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png";
			}
			
			
			$this->sex = $row['sex'];
			$this->family = $row['family'];
			$timestamp=$row['birthday'];
			
			$this->birthday = (date('Y') - gmdate("Y", $timestamp));
			$this->network_link = $row['network_link'];

		}
		mysql_free_result($result);
	}

	function my_account(){
		$uid = $_SESSION['user_id'];
		$result = mysql_query("SELECT * FROM users WHERE user_id='$uid'");
		$row = mysql_fetch_assoc($result);
		return $row;
		/*$this->user_name = $row['user_name'];
		$this->maine_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $row['maine_photo'];
*/
	}

	function get_account_choice(){
		$family = new Family;
		$uid = $_SESSION['user_id'];
		$uresult = mysql_query("SELECT * FROM users WHERE user_id='$uid'");
		$urow = mysql_fetch_assoc($uresult);?>
		<li class="list-item follow-dog follow-dog-option current" id="<?php echo $urow['user_id']; ?>">
			<div class="flex-wrapper">
				<div class="follow-dog-image">
					<img src="<?php echo "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $urow['user_photo']; ?>" alt="dog picture" id="follow-dog-image_<?php echo $urow['user_id']; ?>">
				</div>
				<div class="follow-dog-description" id="<?php echo $urow['user_id']; ?>">
					<p class="follow-dog-breed">
						<?php echo $urow['dog_name']; ?>
					</p>
					<p class="follow-dog-breed">
						<?php echo $urow['breed']; ?>
					</p>
				</div>
			</div>
		</li>
		<li class="list-item follow-dog follow-dog-option" id="<?php echo $urow['user_name']; ?>">
			<div class="flex-wrapper">
				<div class="follow-dog-image">
					<img src="<?php echo "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" .$urow['maine_photo']; ?>" alt="dog picture" id="follow-dog-image_<?php echo $urow['user_name']; ?>">
				</div>
				<div class="follow-dog-description" id="<?php echo $urow['user_name']; ?>">
					<p class="follow-dog-breed">
						<?php echo $urow['user_name']; ?>
					</p>
					<p class="follow-dog-breed">
						Owner
					</p>
				</div>
			</div>
		</li>
		<?php 
	}

	function get_all_users_id(){
		$uid = $_SESSION['user_id'];
		$result = mysql_query("SELECT * FROM users WHERE user_id<>'$uid'");
		if(mysql_num_rows($result) != 0 ){ 
			return mysql_fetch_assoc($result);
		}
	}
	
	function users($uid){
		if (!is_numeric($uid)) {
			$fresult = mysql_query("SELECT * FROM family WHERE f_name='$uid'");
			if(mysql_num_rows($fresult) != 0 ){ 
				return mysql_fetch_assoc($fresult);

			} else {

				$result = mysql_query("SELECT * FROM users WHERE user_name='$uid'");
				return mysql_fetch_assoc($result);
			}
			
		} else {
			$result = mysql_query("SELECT * FROM users WHERE user_id='$uid'");
			if(mysql_num_rows($result) != 0 ){ 
				return mysql_fetch_assoc($result);
			}
		}

	}

	function users_sidebar($uid){
		$result = mysql_query("SELECT * FROM users WHERE user_id='$uid'");
		if(mysql_num_rows($result) != 0 ){ 
			return mysql_fetch_assoc($result);
		}
	}

	function get_count_family_members($family){
		$result = mysql_query("SELECT * FROM users WHERE family='$family'");
		if(mysql_num_rows($result) != 0 ){ 
			return mysql_num_rows($result);
		}
	}

	function get_user(){
		$uid = $_SESSION['get_id'];
		$result = mysql_query("SELECT * FROM users WHERE user_id='$uid'");

		while ($row = mysql_fetch_assoc($result)) { 
			if ($row["dog_name"] != null) { 

				include_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include/Profile-Family.php";

			} else{ 
				include_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include/Profile-Guest.php";
				
				
			} 
		}

		mysql_free_result($result);
	}

	function update_profile($uid, $name, $breed, $bdate, $sex, $avatar){
		$result = mysql_query("UPDATE users SET dog_name='$name', user_photo='$avatar', breed='$breed', birthday='$bdate', sex='$sex'  WHERE user_id='$uid'");
		if ($result == "true") {
			return "true";
		} else{
			return "false";
		}

	}

	/*----add profile family-----*/
	function add_another_dog_profile($dog_name, $avatar, $breed, $birthday, $sex){
		$uid = $_SESSION['user_id'];
		$dogname = $this->users($uid);
		if ($dogname["dog_name"] != null) {
			# code...

			$dog_family = $_SESSION['family'];
			$result = mysql_query("INSERT INTO users SET dog_name='$dog_name', user_photo='$avatar', breed='$breed', birthday='$birthday', sex='$sex', family='$dog_family'");
		} else {
			$this->update_profile($uid, $dog_name, $breed, $birthday, $sex, $avatar);
		}
	}
	/*-----end family-----*/

}
?>
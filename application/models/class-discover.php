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

	function get_wall_discover(){
		$limit = $this->limit;
		$start = $this->start;
		
		if (isset($_GET['breed']) && isset($_GET['location'])) {
			$breed = $_GET['breed'];
			$location = $_GET['location'];
			$breed_loc = "breed='$breed' AND location='$location'";
			$this->all_serch_account($breed_loc, $start, $limit);

		}elseif (isset($_GET['search'])) {
			$search = $_GET['search'];

			$this->get_all_users($search, $start, $limit);
		}elseif (isset($_GET['location'])) {
			$str_location = str_replace('+', ' ', $_GET['location']);
				//echo 'Location';
			$this->discover_serch_by_location($str_location, $start, $limit);
			echo "<hr>";
		}elseif(isset($_GET['breed'])) {
			$breed = $_GET['breed'];
			if ($breed != 'All') {
				$breed_loc = "breed='$breed'";
			} else {
				$breed_loc = "breed<>''";
			}
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
			$this-> get_count_account();
			$this->get_all_account($start, $limit);
			

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
		$users = new Users;
		$result = mysql_query("SELECT * FROM user WHERE $breed_loc");
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
				

				$uid = $row[$i]['user_id'];
				$name = $row[$i]['name'];
				$foto = $row[$i]['photo'];
				$timestamp = $row[$i]['birthday'];
				if ($row[$i]['user_id'] == $row[$i]['family_id']) {
					$breed = $users->get_count_family_members($row[$i]['family_id']) . " pets ";
				} else {
					$breed = $row[$i]['breed'] ."<br>" . $row[$i]['sex'] . ", Age " . (date('Y') - gmdate("Y", $timestamp));
				}
				if ($row[$i]['owner'] == 1) {
					$location = $row[$i]['location'];
					$breed = "";
				} else {
					$location="";
				}

				if ($foto == null) {
					$foto = "paw-avatar.png";
				}
				if ($foto == null) {
					$foto = "paw-avatar.png";
				}
				$users->get_user_account($uid, $foto, $name, $breed, $location, 1);
			}
			
		}
	}

	function get_count_account(){
		$profile = 1;
		$result = mysql_query("SELECT * FROM user WHERE profile='$profile'");
		$this->max = mysql_num_rows($result);
		return mysql_num_rows($result);
	}

	function get_all_account($start, $limit){
		$users = new Users;
		$followers = new Followers;
		$profile = 1;
		$result = mysql_query("SELECT * FROM user WHERE profile='$profile' LIMIT $start, $limit");

		if(mysql_num_rows($result) != 0 ){ 
			for ($i=0; $i < mysql_num_rows($result); $i++) { 
				$allarray = mysql_fetch_assoc($result);

				$uid = $allarray['user_id'];
				$name = $allarray['name'];
				$foto = $allarray['photo'];
				$timestamp = $allarray['birthday'];
				if ($allarray['user_id'] == $allarray['family_id']) {
					$breed = $users->get_count_family_members($allarray['family_id']) . " pets ";
				} else {
					$breed = $allarray['breed'] ."<br>" . $allarray['sex'] . ", Age " . (date('Y') - gmdate("Y", $timestamp));
				}
				if ($allarray['owner'] == 1) {
					$location = $allarray['location'];
					$breed = "";
				} else {
					$location="";
				}

				if ($foto == null) {
					$foto = "paw-avatar.png";
				}
				$users->get_user_account($uid, $foto, $name, $breed, $location, 1);
			}
		}
	}

	function discover_serch_by_location($location, $start, $limit){
		$followers = new Followers;
		$users = new Users;
		$result = mysql_query("SELECT * FROM user WHERE location='$location' LIMIT $start, $limit");
		if(mysql_num_rows($result) != 0 ){ 

			for ($i=0; $i < mysql_num_rows($result); $i++) { 
				$allarray = mysql_fetch_assoc($result);
				$uid = $allarray['user_id'];
				$name = $allarray['name'];
				$foto = $allarray['photo'];
				$timestamp = $allarray['birthday'];
				if ($allarray['user_id'] == $allarray['family_id']) {
					$breed = $users->get_count_family_members($allarray['family_id']) . " pets ";
				} else {
					$breed = $allarray['breed'] ."<br>" . $allarray['sex'] . ", Age " . (date('Y') - gmdate("Y", $timestamp));
				}
				if ($allarray['owner'] == 1) {
					$location = $allarray['location'];
					$breed = "";
				} else {
					$location="";
				}

				if ($foto == null) {
					$foto = "paw-avatar.png";
				}

				if ($foto == null) {
					$foto = "paw-avatar.png";
				}
				$users->get_user_account($uid, $foto, $name, $breed, $location, 1);

			}
		}

	}

		function get_all_users($name, $start, $limit){
		$users = new Users;
		$user_array=array();
		$resultd = mysql_query("SELECT * FROM user WHERE name LIKE '$name%' ORDER BY name ASC LIMIT $limit");
		
		if (mysql_num_rows($resultd) != 0) {
			while ($row = mysql_fetch_array ($resultd)){
				array_push($user_array, $row);
			}
		}
		$lresult = mysql_query("SELECT * FROM user WHERE location LIKE '$name%' ORDER BY location ASC LIMIT $limit");
		if (mysql_num_rows($lresult) != 0) {
			while ($row = mysql_fetch_array ($lresult)){
				array_push($user_array, $row);
			}
		}
//rsort($user_array);
		for ($i=0; $i < count($user_array); $i++) { 
			$uid = $user_array[$i]['user_id'];
			$name = $user_array[$i]['name'];
			$foto = $user_array[$i]['photo'];
			
			$timestamp = $user_array[$i]['birthday'];
			if ($user_array[$i]['user_id'] == $user_array[$i]['family_id']) {
				$breed = $users->get_count_family_members($user_array[$i]['family_id']) . " pets ";
			} else {
				$breed = $user_array[$i]['breed'] ."<br>" . $user_array[$i]['sex'] . ", Age " . (date('Y') - gmdate("Y", $timestamp));
			}
			if ($user_array[$i]['owner'] == 1) {
				$location = $user_array[$i]['location'];
				$breed = "";
			} else {
				$location="";
			}

			if ($foto == null) {
				$foto = "no-photo.png";
			}

			$users->get_user_account($uid, $foto, $name, $breed, $location, 1);

		}

	}


}
?>


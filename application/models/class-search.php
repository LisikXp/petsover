<?php
class Search{

	public $all_users;


	function __construct(){
		
	}

	function get_all_users($name, $num, $lim){
		$this->all_users = $name;
		$users = new Users;
		$user_array=array();
		$resultd = mysql_query("SELECT * FROM user WHERE name LIKE '$name%' ORDER BY name ASC LIMIT $lim");
		
		if (mysql_num_rows($resultd) != 0) {
			while ($row = mysql_fetch_array ($resultd)){
				array_push($user_array, $row);
			}
		}
		$lresult = mysql_query("SELECT * FROM user WHERE location LIKE '$name%' ORDER BY location ASC LIMIT $lim");
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

			$users->get_user_account($uid, $foto, $name, $breed, $location, $num);

		}

	}

	function get_search_posts($name){
		$wall = new Wall;
		$sql_ress = mysql_query("SELECT * FROM wall WHERE message LIKE '$name%' ORDER BY message ASC");
		if(mysql_num_rows($sql_ress) != 0 ){
			for ($r=0; $r < mysql_num_rows($sql_ress); $r++) { 
				$arrar = mysql_fetch_assoc($sql_ress);?>
				<hr class="hr hr-full-width hr-full-width-exp  post-hr">
				<?php $wall->post($arrar['post_id'], $arrar['message'], $arrar['attachment'],$arrar['user_from'], $arrar['user_owner'], $arrar['publish_date'], $name);
			}

		}
	}

	function get_count_keyword($name){
		$user_array=array();
		$resultd = mysql_query("SELECT * FROM user WHERE name LIKE '$name%' ORDER BY name ASC");
		
		if (mysql_num_rows($resultd) != 0) {
			while ($row1 = mysql_fetch_array ($resultd)){
				array_push($user_array, $row1);
			}
		}
		$lresult = mysql_query("SELECT * FROM user WHERE location LIKE '$name%' ORDER BY location ASC");
		if (mysql_num_rows($lresult) != 0) {
			while ($row2 = mysql_fetch_array ($lresult)){
				array_push($user_array, $row2);
			}
		}

		$sql_ress = mysql_query("SELECT * FROM wall WHERE message LIKE '$name%' ORDER BY message ASC");
		if(mysql_num_rows($sql_ress) != 0 ){
			while ($row3 = mysql_fetch_array ($sql_ress)){
				array_push($user_array, $row3);
			}
		}

		return count($user_array);
	}

	function get_all_search_by_keyword($name){
		$this->get_count_keyword($name);
		$this->get_all_users($name, 1, 100);
		$this->get_search_posts($name);
	}
}
?>
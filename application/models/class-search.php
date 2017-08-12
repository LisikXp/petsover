<?php
class Search{

	private $all_users;
	private $all_family;

	function __construct(){
		$users = new Users;
		$family = new Family;
		$this->all_users = $users->get_all_users_id();
		$this->all_family = $family->get_all_family();
	}

	function get_all_users($name){
		$user_array=array();
		$resultd = mysql_query("SELECT * FROM users WHERE dog_name LIKE '%".$name."%'");
		if (mysql_num_rows($resultd) != 0) {
			while ($row = mysql_fetch_array ($resultd)){
				array_push($user_array, $row);
			}
		}
		$uresult = mysql_query("SELECT * FROM users WHERE user_name  LIKE '%".$name."%'");
		if (mysql_num_rows($uresult) != 0) {
			while ($row = mysql_fetch_array ($uresult)){
				array_push($user_array, $row);
			}
		}
		$fresult = mysql_query("SELECT * FROM family WHERE f_name LIKE '%".$name."%'");
		if (mysql_num_rows($fresult) != 0) {
			while ($row = mysql_fetch_array ($fresult)){
				array_push($user_array, $row);
			}
		}
		$lresult = mysql_query("SELECT * FROM users WHERE location LIKE '%".$name."%'");
		if (mysql_num_rows($lresult) != 0) {
			while ($row = mysql_fetch_array ($lresult)){
				array_push($user_array, $row);
			}
		}


		print_r($user_array);
	}
}
?>
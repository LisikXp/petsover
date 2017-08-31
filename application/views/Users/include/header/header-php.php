<?php 
require_once $_SERVER['DOCUMENT_ROOT']. "/application/models/functions.php";
//include "upload.php";

session_start(); // Запускаем сессию
if(!isset($_SESSION['user_id']) ){header('location:/SignIn'); exit;} //  Если НЕ Авторизирован - возвращаем назад

$id = $_SESSION['user_id']; //  id Пользователя
$fid = $_SESSION['family_id'];

$uid = $_SESSION['get_id'];

switch ($_SERVER["REQUEST_URI"]) {
	case '/feed':
	if (($_SESSION['family_id']) != null) {
		$get_id = $_SESSION['family_id'];
	} else {
		$get_id = $_SESSION['user_id'];
	}
	break;

	default:
	$get_id = $_SESSION['get_id'];
	break;
}

/*if ($_SERVER["REQUEST_URI"] == "/Settings") {
	$popaup = "button_resize_setting";
} else {
	$popaup = "button_resize";
}*/




if(isset($_POST['LogUot'])){
	loguot();
 } // > Кнопка - ВЫХОД
 $Wall = new Wall;
 $family = new Family;
 $user = new Users;
 $feed = new myFeed;
 $valuation = new Valuat;
 $follow = new Followers;
 $discover = new Users_Discover;
 $notifi = new Class_Notification;
 $setting = new Setting;
 $searh = new Search;
 $main_url = new Main_url;
 

 if (($_SESSION['family_id']) != null) {
 	$home = $main_url->get_url($_SESSION['family_id']);
 	$mypage = $_SESSION['family_id'];
 	
 } else {
 	$home = $main_url->get_url($_SESSION['user_id']);
 	$mypage = $_SESSION['user_id'];
 }

 $user_photo = $user->user_photo;
 $user_name = $user->name;
 $location = $user->location;
 $str_network_link = $user->network_link;
 $mbreed = $user->breed;

 $count_pets = $user->count_pets;

 $network_link = unserialize($str_network_link);

 $myaacountuser = $user->my_account();
 $myowner = $user->my_owner();

 $owner = $myowner['name'];
 $location_owner = $myowner['location'];
 if ($myowner['photo'] == null) {
 	$maine_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png";
 } else {
 	$maine_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" .$myowner['photo'];
 }

 $user_id = $myaacountuser['user_id'];
 $name = $myaacountuser['name'];

 if ($_SESSION['family_id']) {
 	$breed = $user->get_count_family_members($fid) . " Pets";
 } else {
 	$breed = $myaacountuser['breed'];
 }

 if ($myaacountuser['photo'] == null) {
 	$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png";
 } else {
 	$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" .$myaacountuser['photo'];
 }
 $email = $myaacountuser['email'];
 $mynetwork = unserialize($myowner['network_link']);

 ?>
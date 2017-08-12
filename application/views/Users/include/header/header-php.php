<?php 
require_once $_SERVER['DOCUMENT_ROOT']. "/application/models/functions.php";
//include "upload.php";

session_start(); // Запускаем сессию
if(!isset($_SESSION['user_id']) ){header('location:/SignIn'); exit;} //  Если НЕ Авторизирован - возвращаем назад

$id = $_SESSION['user_id']; //  id Пользователя
$fid = $_SESSION['family'];
//$get_id = $_SESSION['get_id'];
$uid = $_SESSION['get_id'];

switch ($_SERVER["REQUEST_URI"]) {
	case '/feed':
	if (($_SESSION['family']) != null) {
		$get_id = $_SESSION['family'];
	} else {
		$get_id = $_SESSION['user_id'];
	}
	break;
	
	default:
	$get_id = $_SESSION['get_id'];
	break;
}




if(isset($_POST['LogUot'])){
 loguot();} // > Кнопка - ВЫХОД
 $Wall = new Wall;
 $family = new Family;
 $user = new Users;
 $feed = new myFeed;
 $valuation = new Valuat;
 $follow = new Followers;
 $discover = new Users_Discover;
 $notifi = new Notification;
 $setting = new Setting;
 $searh = new Search;
 

 if (($_SESSION['family']) != null) {
 	$home = 'user?id='. $_SESSION['family'];
 	$mypage = $_SESSION['family'];
 	
 } else {
 	$home = 'user?id='.$_SESSION['user_id'];
 	$mypage = $_SESSION['user_id'];
 }

 if (!is_numeric($get_id)) {
 	$user_photo = $family->user_photo;
 	$user_name = $family->family;
 	$location = $family->location;
 	$str_network_link = $family->network_link;
 	$mbreed = $family->count_pets  . " Pets";
 	$maine_photo =  $family->maine_photo;
 	$owner = $family->owner;
 	$count_pets = $family->count_pets + 1;
 	if ($user_name == null) {
 		$user_name = $user->owner;
 		$user_photo = $user->owner_photo;
 		$str_network_link = $user->network_link;
 		$location = $user->location;
 		$mbreed = "";
 		$owner = $family->myfamily_name;
 		$maine_photo = $family->user_photo;
 		$count_pets = $user->owner;
 	}

 } else {
 	$owner = $user->owner;
 	$user_photo = $user->user_photo;
 	$user_name = $user->dog_name;
 	$location = $user->location;
 	$str_network_link = $user->network_link;
 	$mbreed = $user->breed;
 	$maine_photo = $user->owner_photo;
 	$count_pets = $user->dog_name;
 	if ($user_name == null) {
 		$user_name = $user->owner;
 		$user_photo = $user->owner_photo;
 		$str_network_link = $user->network_link;
 		$location = $user->location;
 		$mbreed = "";
 		$owner = $user->owner;
 		$maine_photo = $user->owner_photo;
 		$count_pets = $user->owner;
 	}
 }

 $network_link = unserialize($str_network_link);


 $myaacountuser = $user->my_account();
 if (($_SESSION['family']) != null) {
 	$myaacount = $family->my_account();
 	$user_id = $myaacount['f_name'];
 	$name = $myaacount['f_name'];
 	$breed = $myaacountuser['breed'];
 	$owner_name = $family->myowner;
 	$owner_photo = $family->myownerphoto;
 	$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" .$myaacount['f_photo'];
 } else {
 	$user_id = $myaacountuser['user_id'];
 	$owner_name = $myaacountuser['user_name']; 
 	$name = $myaacountuser['dog_name'];
 	$breed = $myaacountuser['breed'];
 	$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" .$myaacountuser['user_photo'];
 	$owner_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/" . $myaacountuser['maine_photo'];
 	if ($myaacountuser['user_photo'] == null) {
 		$photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png";
 	}
 	if ($myaacountuser['maine_photo'] == null) {
 		$owner_photo = "http://" .$_SERVER['HTTP_HOST']. "/img/avatar/no-photo.png";
 	}
 }
 $email = $myaacountuser['email'];
 $mynetwork = unserialize($myaacountuser['network_link']);
 
 ?>
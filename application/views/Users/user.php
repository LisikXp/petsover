
<?php
$user = new Users;
$family = new Family;
$_SESSION['get_id'] = $_GET['id'];
if (!is_numeric($_GET['id'])) {

	$family-> get_family($_GET['id']);
	
} else {
	
	$user->get_user(); 
}

?>

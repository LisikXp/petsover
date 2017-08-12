<?php 
if (!is_numeric($_SESSION['get_id'])) {

	require_once "sidebar.php";

} else{

	$row = $user->users_sidebar($_SESSION['get_id']);
	if ($row["dog_name"] == null) {

		require_once "guest-sidebar.php";

	} else {

		require_once "sidebar.php";

	}

}

?>
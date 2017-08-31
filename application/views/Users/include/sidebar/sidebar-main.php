<?php 


	if ($_SESSION['Guest']) {

		require_once "guest-sidebar.php";

	} else {

		require_once "sidebar.php";

	}



?>
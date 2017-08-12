<?php 
if ($_SESSION['Guest']) {

	require_once "header-guest.php";

} else {

	require_once "header-singl.php";

}?>
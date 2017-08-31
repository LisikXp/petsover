<?php

Class Main_url{

	function __construct(){
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = explode('/', $url);
		$findme   = 'id';
		$pos = strpos($url[0], $findme);


		if ($pos === false) {

		} else {
			$uidd = str_replace('id', '', $url[0]);
			$_SESSION['get_id'] = $uidd;
		}
		
	}

	function get_url($id){
		return urldecode("/id".$id);
	}
}
?>
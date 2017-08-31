<?php
require_once $_SERVER['DOCUMENT_ROOT']. "/application/models/functions.php"; 
class Bootstrap {
	public function __construct() {

		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = explode('/', $url);
		//print_r($url);

		$findme   = 'id';
		$pos = strpos($url[0], $findme);


		if ($pos === false) {
			$url_0 = $url[0];
		} else {
			$url_0 = 'id';
		}

		if(empty($url_0)) {
			require 'controllers/index.php';
			$controller = new Index();

			$controller->index();
			return false;
		}

		$file = $_SERVER['DOCUMENT_ROOT'].'/application/controllers/'.$url_0.'.php';
		if(file_exists($file)) {
			require $file;
		} else {
			require 'controllers/error.php';
			$controller = new Error();
			return false;
		}
		$controller = new $url_0;
/*
		if(isset($url[2])) {
			if(method_exists($controller, $url[1])) {
				$controller->{$url[1]}($url[2]);
			} else {
				echo 'Error!';
			}
		} else {
			if(isset($url[1])) {
                //$file = $_SERVER['DOCUMENT_ROOT'].'/application/controllers/'.$url[0].'.php';
				$controller->{$url[1]}();
			} else {
				//$controller->index();
				
			}
		}*/

	}
}

?>

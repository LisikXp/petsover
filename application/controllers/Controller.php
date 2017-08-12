<?php
class Controller {
	public function __construct() {
		//echo 'Это главный контроллер';
		$this->view = new View();
	}
}
?>
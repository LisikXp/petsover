<?php
class add_pets extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->render('Users/add_pets');
	}
	public function index() {
		//echo 'INSIDE INDEX INDEX';
	}
}
?>
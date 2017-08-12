<?php
class Events extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->render('Users/include/Events');
	}
	public function index() {
		//echo 'INSIDE INDEX INDEX';
	}
}
?>
<?php
class Notification extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->render('Users/include/Notification');
	}
	public function index() {
		//echo 'INSIDE INDEX INDEX';
	}
}
?>
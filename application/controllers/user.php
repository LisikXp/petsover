<?php
class User extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->render('Users/user');
	}
	public function index() {
		//echo 'INSIDE INDEX INDEX';
	}
}
?>
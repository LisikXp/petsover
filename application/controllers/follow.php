<?php
class Follow extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->render('Users/include/tofollow/who-to-follow');
	}
	public function index() {
		//echo 'INSIDE INDEX INDEX';
	}
}
?>
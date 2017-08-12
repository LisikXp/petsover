<?php
class Follower extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->render('Users/include/Followers');
	}
	public function index() {
		//echo 'INSIDE INDEX INDEX';
	}
}
?>
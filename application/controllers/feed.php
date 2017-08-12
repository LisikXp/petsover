<?php
class Feed extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->render('Users/include/Feed');
	}
	public function index() {
		//echo 'INSIDE INDEX INDEX';
	}
}
?>
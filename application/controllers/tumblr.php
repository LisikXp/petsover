<?php
class Tumblr extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->render('Users/tumblr');
	}
	public function index() {
		//echo 'INSIDE INDEX INDEX';
	}
}
?>
<?php
class Upload extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->render('Users/upload');
	}
	public function index() {
		//echo 'INSIDE INDEX INDEX';
	}
}
?>
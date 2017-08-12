<?php
class Following extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->render('Users/include/Following');
	}
	public function index() {
		//echo 'INSIDE INDEX INDEX';
	}
}
?>
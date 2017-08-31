<?php
class Id extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->render('Users/id');
	}
	public function index() {
		//echo 'INSIDE INDEX INDEX';
	}
}
?>
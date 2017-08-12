<?php
class Gcontact extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->render('Users/gcontact');
	}
	public function index() {
		//echo 'INSIDE INDEX INDEX';
	}
}
?>
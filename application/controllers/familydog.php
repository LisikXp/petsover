<?php
class familydog extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->render('Users/family');
	}
	public function index() {
		//echo 'INSIDE INDEX INDEX';
	}
}
?>
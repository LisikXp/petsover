<?php
class full_prof extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->render('Users/full_prof');
	}
	public function index() {
		//echo 'INSIDE INDEX INDEX';
	}
}
?>
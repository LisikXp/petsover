<?php
class Invite extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->render('Users/invite');
	}
	public function index() {
		//echo 'INSIDE INDEX INDEX';
	}
}
?>
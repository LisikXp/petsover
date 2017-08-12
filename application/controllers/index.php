<?php
class Index extends Controller{

	public function __construct() {
		//echo "Мы в контроллере INDEX";
		parent::__construct();
		$this->view->render('index/SignIn');




	}
	public function index() {
		//echo 'INSIDE INDEX INDEX';

	}

	public function details() {
		$this->view->render('/index/index');

	}
}
?>
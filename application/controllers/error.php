<?php
class Error extends Controller{

	public function __construct() {
		
		parent::__construct();
		$this->view->msg = 'Страницы не существует или у Вас нет доступа к ней!';
		$this->view->msg_not_rule ='У Вас нет прав для доступа в палнель администрирования';
		$this->view->render('error/index');

	}
}
?>
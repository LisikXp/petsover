<?php
  class SignUp extends Controller {
   public function __construct() {
    parent::__construct();
    $this->view->render('index/SignUp');
   }
  }
?>
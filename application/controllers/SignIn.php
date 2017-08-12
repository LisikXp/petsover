<?php
  class SignIn extends Controller {
   public function __construct() {
    parent::__construct();
    $this->view->render('index/SignIn');
   }
  }
?>
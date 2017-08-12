<?php
  class Registration_google extends Controller {
   public function __construct() {
    parent::__construct();
    $this->view->render('index/registration_google');
   }
  }
?>
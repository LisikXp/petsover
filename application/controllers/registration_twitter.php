<?php
  class Registration_twitter extends Controller {
   public function __construct() {
    parent::__construct();
    $this->view->render('index/registration_twitter');
   }
  }
?>
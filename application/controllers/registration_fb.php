<?php
  class Registration_fb extends Controller {
   public function __construct() {
    parent::__construct();
    $this->view->render('index/registration_fb');
   }
  }
?>
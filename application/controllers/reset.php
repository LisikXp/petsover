<?php
  class Reset extends Controller {
   public function __construct() {
    parent::__construct();
    $this->view->render('index/reset-password');
   }
  }
?>
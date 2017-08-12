<?php
  class Settings extends Controller {
   public function __construct() {
    parent::__construct();
    $this->view->render('Users/include/setting/All_Settings');
   }
  }
?>
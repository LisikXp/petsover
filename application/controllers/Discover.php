<?php
  class Discover extends Controller {
   public function __construct() {
    parent::__construct();
    $this->view->render('Users/include/Discover');
   }
  }
?>
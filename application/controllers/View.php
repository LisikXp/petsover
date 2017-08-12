<?php
  class View {

   public function render($name) {
    require $_SERVER['DOCUMENT_ROOT']. '/application/views/'.$name.'.php';
   }
  }


 /* public function render($name, $noInclude = false) {
   if($noInclude == true) {
   require $_SERVER['DOCUMENT_ROOT']. '/application/views/'.$name.'.php';
   } else {
    require $_SERVER['DOCUMENT_ROOT']. '/application/views/header.php';
    require $_SERVER['DOCUMENT_ROOT']. '/application/views/'.$name.'.php';
     require $_SERVER['DOCUMENT_ROOT']. '/application/views/footer.php';
   }
  }*/
?>
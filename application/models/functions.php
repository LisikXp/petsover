<?php 


include_once "db.php"; // => Подключаемся к бае-данных
include_once "comment.php";
include_once "followers.php";
include_once "myfeed.php";
include_once "valuation.php";
include_once "Share.php";
include_once "class-user.php";
include_once "class-family.php";
include_once "class-wall.php";
include_once "class-setting.php";
include_once "class-discover.php";
include_once "class-notification.php";
include_once "class-search.php";

$setting = new Setting;
$notification = new Notification;

define("include", $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include");

session_start(); // ======> Запускаем сессию

// ========> Регистрация
if(isset($_POST['signup-reg'])){ // ========> Если нажато - Зарегистрироваться
	registration();
} 
function registration(){
	if($_POST['signup-name'] == '' || 
		$_POST['signup-email'] == '' || 
		$_POST['signup-location'] == '' || 
               $_POST['signup-password'] == ''){ // > Проверяем на заполнение [ * ] необходимых полей
    $_SESSION['msg'] = "Fields are required!";
                } else{ // ====> Иначе идём дальше
                $mail = trim($_POST['signup-email']); // ======> Значение формы [ mail ]
                $sql_res = mysql_query("SELECT user_id FROM users WHERE email='$mail'") or die(mysql_error());
                if(mysql_num_rows($sql_res) != 0 ){ // ==> Если пользователь с такими данными существует
                    $_SESSION['msg'] = "User with such login and / or mail already exists!";} // =====> Выдаем ошибку
                else{ // =====> Если нет - идём дальше
                    $name = trim($_POST['signup-name']); // ==> Значение формы [ name ]
                    $email = trim($_POST['signup-email']); // ==> Значение формы [ mail ]
                    $password = md5(trim($_POST['signup-password'])); // > Значение формы [ password ]
                    $location = trim($_POST['signup-location']); // ===> Значение формы [ telefon ]
                    $timereg = strtotime(date('d-m-Y'));
                    mysql_query("INSERT INTO users SET user_name='$name', 
                    	email='$mail', 
                    	password='$password', 
                    	location='$location',
                        time_registration='$timereg'"); // => Делаем запись в таблицу
                    // > Определяем новый id;
                    $id = mysql_insert_id();
                    $sql_res = mysql_query("SELECT * FROM users WHERE user_id=$id");
                    $arr = mysql_fetch_assoc($sql_res);         
                                  $_SESSION['user_id'] = $arr['user_id']; // =======> Сохраняем его в сессию
                    $id = $_SESSION['user_id']; // =====> Присваеваем id в переменную $id
                    $usr = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE user_id=$id")); 
                    header('location: user?id='.$_SESSION['user_id']);
                  }
                }
              }

        /*      if (isset($_POST['regfb'])) {
               $email = $_POST['email'];
               $name = $_POST['name'];
               $password = md5($_POST['password']);
               registration_network($email, $name, $link_prof, $password);
             }*/

             function registration_network($email, $name, $link_prof){
              $comma_separated = str_word_count($name, 1);
              $uname = implode("_", $comma_separated);

              $timereg = strtotime(date('d-m-Y'));
              $sql_res = mysql_query("SELECT * FROM users WHERE email='$email'") or die(mysql_error());
              if(mysql_num_rows($sql_res) != 0 ){ // ==> Если пользователь с такими данными существует

                $arr = mysql_fetch_assoc($sql_res);
                
                $_SESSION['user_id'] = $arr['user_id'];
                $user = new Family;
                $user->serch_family(); 

                    }else{ // =====> Если нет - идём дальше
                     mysql_query("INSERT INTO users SET user_name='$uname', 
                      email='$email', 
                      time_registration='$timereg',
                         network_link='$link_prof'"); // => Делаем запись в таблицу
                    // > Определяем новый id;
                     $id = mysql_insert_id();
                     $sql_res = mysql_query("SELECT * FROM users WHERE user_id=$id");
                     $arr = mysql_fetch_assoc($sql_res);         
                                  $_SESSION['user_id'] = $arr['user_id']; // =======> Сохраняем его в сессию
                    $id = $_SESSION['user_id']; // =====> Присваеваем id в переменную $id

                    header('location: user?id='.$_SESSION['user_id']);
                  }
                }

                if(isset($_POST['authorize'])) {
                  authorization();
                }
//  Авторизация
                function authorization() {

                 $error = '';
                 $email = trim($_POST['login-email']); 
                 $_SESSION['login-email'] = $email;
                 $password = trim($_POST['login-password']); 

                 if(!$email) {
                  $_SESSION['error'] = 'No username';
                  return $error;
                } 
                elseif(!$password) {
                 $error = 'Password is not specified';
                 return $error;
               }

               $sql_res = mysql_query("SELECT * FROM users WHERE email='$email'") or die(mysql_error()); 

               if(mysql_num_rows($sql_res) != 0 ){ 
                 $arr = mysql_fetch_assoc($sql_res);
                 if($arr['password'] === md5($password)){ 
                   $_SESSION['user_id'] = $arr['user_id'];
                   if ($arr["dog_name"] == null) {
                    $_SESSION['Guest'] = true;
                  }
                  $user = new Family;
                  $user->serch_family(); 
                }else{ 
                 $error = "Password incorrect!"; 
                 return $error;
               }
             } else{
               $error = "User is not found!";
               return $error;
             }

    // Не забываем закрывать соединение с базой данных
             mysql_close();

    // Возвращаем true для сообщения об успешной авторизации пользователя
             return true;
           }

           /*-------------Функция выхода-------------------*/
           function loguot(){
            session_destroy();
            unset($_GET['stop']);
            unset($_SESSION['user_id']);
            unset($_SESSION['family']);
            unset($_SESSION['Guest']);
            header('location:/SignIn'); 
            exit;
          }



          if(isset($_POST['save_setting'])){

            $email = $_POST['email'];
            $curr_password = $_POST['curr_password'];
            $password = $_POST['new_password'];
            $Re_Type_password = $_POST['Re_Type_password'];


            if (isset($_POST['facebook'])) {
             $network['facebook'] = $_POST['facebook'];
           }

           if (isset($_POST['twitter'])) {
             $network['twitter'] = $_POST['twitter'];
           }

           if (isset($_POST['instagram'])) {
            $network['instagram'] = $_POST['instagram'];
          }

          if (isset($_POST['tumblr'])) {
            $network['tumblr'] = $_POST['tumblr'];
          }    

          if ($_POST['google']) {
            $network['google'] = $_POST['google'];
          }       
//echo $curr_password .  $password;

          $network_link = serialize($network);

          $setting->set_account_setting($email, $curr_password, $password, $network_link);
        }

     
      if (isset($_POST['reset_pwd'])) {
        $new_pwd = $_POST['new_password'];
        $code = $_GET['action'];
        $result = mysql_query("SELECT * FROM resetpass WHERE code='$code'") or die(mysql_error());
        if(mysql_num_rows($result) != 0 ){ 
          $arr = mysql_fetch_assoc($result);
          if ($arr['active'] == 1) {
            $uid = $arr['user_id'];
            $setting->reset_password($new_pwd, $uid);
            $notification->user_owner = $uid;
            $notification->event = "password";
            $notification->post = 0;
            $notification->active = 1;
            $notification->set_event();
          } else{
            echo "This link is invalid!";
          }
        }

      }
      function valid_pwd_code($code){

       $result = mysql_query("SELECT * FROM resetpass WHERE code='$code'") or die(mysql_error());
       if(mysql_num_rows($result) != 0 ){ 
        $arr = mysql_fetch_assoc($result);
        if ($arr['active'] == 1) {

        } else{
          header('location:/SignIn');
        }
      } else {
        header('location:/error');
      }
    }

    class Likes{


      function get_post_likes($post_id){
       $sql_res = mysql_query("SELECT * FROM likes WHERE post_id='$post_id'") or die(mysql_error());
       if(mysql_num_rows($sql_res) != 0 ){ 
        $arr = mysql_fetch_assoc($sql_res);

        return mysql_num_rows($sql_res);
      }
    }
    function set_post_likes($post_id, $user_id, $post_user_owner){
      $notification = new Notification;
      $sql_res = mysql_query("SELECT * FROM likes WHERE post_id='$post_id' AND user_id='$user_id'") or die(mysql_error());
      if(mysql_num_rows($sql_res) != 0 ){

      } else{
       $result = mysql_query ("INSERT INTO likes SET post_id='$post_id', user_id='$user_id'");
       $owner_id = $_SESSION['get_id'];
       $notification->user_from = $user_id;
       $notification->user_owner = $post_user_owner;
       $notification->event = "Likes";
       $notification->post = $post_id;
       $notification->set_event();
     }

   }

   function serch_user_like($post_id, $uid){
/*  if (($_SESSION['family']) != null) {

    $uid = $_SESSION['family'];

  } else {

    $uid = $_SESSION['user_id'];
  }*/
  $sql_res = mysql_query("SELECT * FROM likes WHERE post_id='$post_id' AND user_id='$uid'") or die(mysql_error());
  if(mysql_num_rows($sql_res) != 0 ){
    return 1;
  } else {
    return 0;
  }

}

function remove_like($post_id, $user_id){
  $rem_comm = mysql_query ("DELETE FROM likes WHERE post_id='$post_id' AND user_id='$user_id'");
}

}


?>
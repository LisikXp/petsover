<?php
include_once "functions.php";
class Comments{
	

	function comment($user_from, $message, $comment_id, $time, $owner_id){ 
		$user_f = new Users;
		$famili = new Family;
		$wall = new Wall;
              $main_url = new Main_url;
              $fam = $famili->get_my_family_members();
              $ufrom = $user_f->users($user_from);

              $fotos = $ufrom['photo'];
              $dname = $ufrom['name'];
              if (($_SESSION['family']) != null ) {

                  $user_id = $_SESSION['family_id'];
           } else {
                  $user_id = $_SESSION['user_id'];
           }
           $far = false;
           for ($i=0; $i < count($fam); $i++) { 
                  if ($fam[$i] == $user_from || $user_id == $user_from || $user_id == $owner_id) {
                        $far = true;
                 }
          }
          ?>
          <li class="flex-wrapper comment comment_<?= $comment_id;?>" id="<?= $comment_id;?>">
           <div class="comment-image">
                 <a href="<?= $main_url->get_url($user_from); ?>">
                       <img src="http://<?=  $_SERVER['HTTP_HOST']. '/img/avatar/' . $fotos;?>" alt="" class="image">
                </a>
         </div>
         <div class="comment-text" id="<?= $comment_id;?>">
          <h3 class="heading-h5 comment-text-name"><a href="<?= $main_url->get_url($user_from); ?>"><?= $dname;?></a> 
              <span class="comment-text-time utime_<?= $comment_id;?>">
                <?php
                echo $wall->data_form($time);?> </span></h3>
                <div class="comment_block comment_block_<?= $comment_id;?>">
                      <p class="comment-text-content" id="comment_text_<?= $comment_id;?>">
                            <?= $message; ?>
                     </p>
              </div>
              <?php

              if ($far) {?>
              <button class=" button-delete comment-delete remove_comment_<?= $comment_id;?> hidden" id="remove_comment">
               <img src="/img/cross.svg" alt="close">
        </button>
        <?php }	?>
 </div>
</li>
<?php }


function get_comment($post_id, $start, $limit){ 
   $comments = new Comments;
   $user_f = new Users;
   $sql_res = mysql_query("SELECT * FROM comments WHERE post_id='$post_id' ORDER BY comment_time ASC LIMIT $start, $limit") ;

       	   if(mysql_num_rows($sql_res) != 0 ){ // ===> Если запись есть
       	   	while ($arr = mysql_fetch_assoc($sql_res)) {
       	   		$comment_user = $user_f->users($arr['user_from']);
       	   		$comments->comment($arr['user_from'], $arr['message'], $arr['comment_id'], $arr['comment_time'], $arr['owner_id']);
       	   	}
       	   }
       	}

       	function set_comment($post_id, $user_from, $message, $owner_id){
       		$comment_time = strtotime("now");
       		$result = mysql_query ("INSERT INTO comments SET owner_id='$owner_id', post_id='$post_id', user_from='$user_from', message='$message', comment_time='$comment_time'");
       		$comment_id = mysql_insert_id();
       		
       		$this->comment($user_from, $message, $comment_id, $comment_time, $owner_id);
       	}

       	function get_count_comment($post_id){
       		$sql_res = mysql_query("SELECT * FROM comments WHERE post_id='$post_id'") or die(mysql_error());
       		if(mysql_num_rows($sql_res) != 0 ){
       			$arr = mysql_fetch_assoc($sql_res);

       			return mysql_num_rows($sql_res);
       		}
       	}

       	function delete_comment($comment_id){
       		$sql_res = mysql_query("SELECT * FROM comments WHERE comment_id='$comment_id'");
       		if(mysql_num_rows($sql_res) != 0 ){
       			$arr = mysql_fetch_assoc($sql_res);

       			echo $arr['comment_id'] . "| " . $arr['owner_id'] . "| " . $arr['post_id'] . "| " . $arr['user_from'] . "| " . $arr['message'] . "| " . $arr['comment_time'];
       			$result = mysql_query ("DELETE FROM comments WHERE comment_id='$comment_id'");
       		}
       	}
       	function update_comment($comment_id, $message){
       		$comment_time = strtotime("now");
       		$result = mysql_query ("UPDATE comments SET message='$message', comment_time='$comment_time' WHERE comment_id='$comment_id'");
       		if ($result == 'true')
       		{
       			echo $message;

       		}

       	}

       	function undo_removing_comment($comment_id){
       		$myarr = explode("|", $comment_id);
       		$comment_id = trim($myarr[0]);
       		$owner_id = trim($myarr[1]);
       		$post_id = trim($myarr[2]);
       		$user_from = trim($myarr[3]);
       		$message = trim($myarr[4]);
       		$comment_time = trim($myarr[5]);
       		

       		$result = mysql_query ("INSERT INTO comments SET  comment_id ='$comment_id', owner_id='$owner_id', post_id='$post_id', user_from='$user_from', message='$message', comment_time='$comment_time'");

       	}

       }
       ?>
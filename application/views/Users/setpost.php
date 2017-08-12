<?php
require_once  $_SERVER['DOCUMENT_ROOT']. "/application/models/functions.php";
require_once  $_SERVER['DOCUMENT_ROOT']. "/application/models/comment.php";
include_once $_SERVER['DOCUMENT_ROOT']. "/application/models/followers.php";
include_once $_SERVER['DOCUMENT_ROOT']. "/application/models/myfeed.php";
require_once $_SERVER['DOCUMENT_ROOT']. "/application/views/social_networks/codebird-php-develop/src/codebird.php";
/* set post in db*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$wall = new wall;
	$notification = new Notification;
	if (isset($_POST['message'])) {
		if (($_SESSION['family']) != null ) {

			$user_id = $_SESSION['family'];
		} else {
			$user_id = $_SESSION['user_id'];
		}
		$message = strip_tags($_POST['message']);
		$attachment = $_POST['attachment'];
		$count_attach = $_POST['count'];
		$post_id = $_POST['post_id'];
		$user_from = $_POST['user_from'];
	//echo $attachment;
	//echo $message;
		
		$wall->set_post($user_from, $message, $attachment, $count_attach);
		
		//$publish_date = strtotime("now");
		//echo $wall->post($post_id, $message, $attachment, $user_from, $publish_date);
	}
	if (isset($_POST['user_likes_id'])) {
		if ($_POST['user_likes_id'] != undefined) {

			$user_id = $_POST['user_likes_id'];
		} else {
			if (($_SESSION['family']) != null ) {

				$user_id = $_SESSION['family'];
			} else {
				$user_id = $_SESSION['user_id'];
			}
		}
		
		$post_id = $_POST['post_likes_id'];
		$post_user_owner = $_POST['post_user_owner'];
		$likes = new Likes;
		$likes->set_post_likes($post_id, $user_id, $post_user_owner);
		$count_like = $likes->get_post_likes($post_id);
		echo $count_like;
	}

	if (isset($_POST['rem_user_likes_id'])) {
		if ($_POST['rem_user_likes_id'] != undefined) {

			$user_id = $_POST['rem_user_likes_id'];
		} else {
			if (($_SESSION['family']) != null ) {

				$user_id = $_SESSION['family'];
			} else {
				$user_id = $_SESSION['user_id'];
			}
		}
		$post_id = $_POST['rem_post_likes_id'];
		$likes = new Likes;
		$likes->remove_like($post_id, $user_id);
		$count_like = $likes->get_post_likes($post_id);
		echo $count_like;
	}

	if (isset($_POST['chek_user_likes_id'])) {
		if ($_POST['chek_user_likes_id'] != undefined) {

			$user_id = $_POST['chek_user_likes_id'];
		} else {
			if (($_SESSION['family']) != null ) {

				$user_id = $_SESSION['family'];
			} else {
				$user_id = $_SESSION['user_id'];
			}
		}
		$post_id = $_POST['chek_post_likes_id'];
		$likes = new Likes;
		echo $likes->serch_user_like($post_id, $user_id);
	/*	$count_like = $likes->get_post_likes($post_id);
		if ($serch_like == 1) { ?>
		<div class="link link-green highpawes post_likes_<?= $post_id;?>"><?php echo $count_like;?> <span class="hidden-sm hidden-xs">High Pawes!</span>
		</div>
		<?php } else {?>
		<div class="link link-gray highpawes post_likes_<?= $post_id;?>"><?php echo $count_like;?> <span class="hidden-sm hidden-xs">High Pawes!</span>
		</div>
		<?php }*/
	}

	if (isset($_POST['remove_post'])) {
		$remove_post_id = $_POST['remove_post_id'];
		$wall->remove_post($remove_post_id);
	}

	if (isset($_POST['undo_removing_post'])) {
		$undo_remove_post_id = $_POST['undo_remove_post_id'];
		$wall->undo_removing_post($undo_remove_post_id);
	}

	if (isset($_POST['edit_post'])) {
		$edit_post_message = strip_tags($_POST['edit_post_message']);
		$edit_post_attachment = $_POST['edit_post_attachment'];
		$edit_post_count_attach = $_POST['edit_post_count_attach'];
		$edit_post_id = $_POST['edit_post_id'];
		$wall->edit_post($edit_post_message, $edit_post_attachment, $edit_post_count_attach, $edit_post_id);
	}
	if (isset($_POST['comment_text'])) {
		$comment_text = strip_tags($_POST['comment_text']);
		$user_comment_id = $_POST['user_comment_id'];
		$post_comment_id = $_POST['post_comment_id'];
		$owner_id =  $_POST['coment_user_owner'];
		/*switch ($_SERVER["REQUEST_URI"]) {
			case '/feed':
			if (($_SESSION['family']) != null) {
				$owner_id = $_SESSION['family'];
			} else {
				$owner_id = $_SESSION['user_id'];
			}
			break;

			default:
			$owner_id = $_SESSION['get_id'];
			break;
		}*/

		$comment = new Comments;
		$comment->set_comment($post_comment_id, $user_comment_id, $comment_text, $owner_id);
		/*$comment_time = strtotime("now");
		$comment_data = $comment->comment($user_comment_id, $comment_text, $comment_id, $comment_time);*/
		//echo $comment_data;// $comment_text . " - " .$user_comment_id." - ". $post_comment_id;
		$notification->user_from = $user_comment_id;
		$notification->user_owner = $owner_id;
		$notification->event = "comment";
		$notification->post = $post_comment_id;
		$notification->set_event();

	}
	if (isset($_POST['count_comment'])) {
		$comment = new Comments;
		$count_post_id = $_POST['count_post_id'];
		$count_comment_data = $comment->get_count_comment($count_post_id);
		echo $count_comment_data;

	}
	if (isset($_POST['remove_comment'])) {
		$comment = new Comments;
		$remove_comment_id = $_POST['remove_comment_id'];
		$comment->delete_comment($remove_comment_id);
	}

	if (isset($_POST['undo_removing_comment'])) {
		$comment = new Comments;
		$undo_remove_comment_id = $_POST['undo_remove_comment_id'];
		$comment->undo_removing_comment($undo_remove_comment_id);
	}

	if (isset($_POST['edit_comment_txt'])) {
		$comment = new Comments;
		$edit_comment_txt = $_POST['edit_comment_txt'];
		$edit_comment_id = $_POST['edit_comment_id'];
		$comment->update_comment($edit_comment_id,$edit_comment_txt);
	}
	if (isset($_POST['follow'])) {
		$followers = new Followers;
		if (($_SESSION['family']) != null ) {

			$user_id = $_SESSION['family'];
		} else {
			$user_id = $_SESSION['user_id'];
		}

		$my_following = $_POST['parentNode_id'];
		$followers->set_follow($user_id, $my_following);
		
		$notification->user_from = $user_id;
		$notification->user_owner = $my_following;
		$notification->event = "following";
		$notification->post = 0;
		$notification->set_event();

	}
	if (isset($_POST['remove_follow'])) {
		$followerss = new Followers;
		if (($_SESSION['family']) != null ) {

			$user_id = $_SESSION['family'];
		} else {
			$user_id = $_SESSION['user_id'];
		}

		$my_following =$_POST['parentNode_id'];
		$followerss->remove_following($user_id, $my_following);
	}
	if (isset($_POST['countfeed'])) {
		$feed = new myFeed;
		$feed->get_count_feedpost();
	} 
	if (isset($_POST['autofeed'])) {
		$feed = new myFeed;
		$feed->get_follow_id();
	} 
	if (isset($_POST['send_email_true'])) {
		$e_address = $_POST['send_email_adress'];
		$adress_arr = explode(",", $e_address);
		
		$message = '
		<html>
		<head>
			<title>Приглашения на регистрациюю</title>
		</head>
		<body>
			<p>registration</p>
			<a href="http://petsoverload.yaskravo.net/SignUp#email">Sign Up</a>
		</body>
		</html>
		';
		echo $e_address;
		$pagetitle = "Приглашения на регистрациюю";
		mail($e_address, $pagetitle, $message, "Content-type: text/html; charset=\"utf-8\"\n From: $e_address");

	}
	if (isset($_POST['set_twitter'])) {
		
		$set_twitter_text = $_POST['set_twitter_text'];
		$set_twitter_media = $_POST['set_twitter_media'];
		\Codebird\Codebird::setConsumerKey("GRxKKEDDrv1oB7Jrh70gB7bh9", "XONhRS7gN6ozWSej21q1Hecj64F7fz3FNEjeTAwMaTB5t1y3Hr");
		$cb = \Codebird\Codebird::getInstance();
		$cb->setToken("1656943208-Astme1MWlXaBLBZhK01dXSOrfKOCzZbBbfhpVUn", "cvHroDEfIeQ5VA8yoIiAC5gTucXSn1rEK3QoHYqkCEopC");

		$params = array(
			'status' => $set_twitter_text,
			'media[]' => $set_twitter_media
			);
		$reply = $cb->statuses_updateWithMedia($params);
	} 

	if (isset($_POST['sett_username'])) {
		$setting = new Setting;
		$uname = $_POST['sett_username'];
		$location = $_POST['sett_location'];
		if ($_FILES['img']) { 
			$name = $_FILES['img']['name'];
			switch ($_FILES['img']['type']) {
				case 'image/jpeg':
				$ext = 'jpg';
				break;
				case 'image/jpg':
				$ext = 'jpg';
				break;
				case 'image/gif':
				$ext = 'gif';
				break;
				case 'image/png':
				$ext = 'png';
				break;

				default:
				$ext = '';
				break;
			}
			if ($ext) {
            $path =$_SERVER['DOCUMENT_ROOT']. '/img/avatar/'; //путь в папку с изображениями
        $new_name = time().'.'.$ext; // новое имя с расширением
        $full_path = $path.$new_name; // полный путь с новым именем и расширением
        $ava_path = $_SERVER['HTTP_HOST']. '/img/avatar/' . $new_name;
        if (move_uploaded_file($_FILES['img']['tmp_name'], $full_path)) {
            $avatar = $new_name; //записываем имя картинки в переменную

        } else {
        	echo "Possible file upload attack!";
        }
    }

    $set = $setting->set_guest_setting($uname, $location, $avatar);
    echo $set;
} else{
	$avatar = trim($_POST['oldimg']);
	$set = $setting->set_guest_setting($uname, $location, $avatar);
	echo $set;
}

}
if (isset($_POST['discover_pagin'])) {
	$discover = new Users_Discover;
	$start = $_POST['discover_start'];
	$limit = $_POST['discover_limit'];
	$breed = $_POST['breed'];
	$location = $_POST['location'];
	$serch_agefrom = $_POST['serch_agefrom'];
	$serch_ageto = $_POST['serch_ageto'];
	$discover->start = $start;
	$discover->limit = $limit;
		//echo $start . $limit . $breed . $location . $serch_agefrom . $serch_ageto;
	if ($breed != undefined && $location != undefined) {

		$breed_loc = "breed='$breed' AND location='$location'";
		echo $discover->all_serch_account($breed_loc, $start, $limit);

	}elseif ($breed != undefined) {

		$breed_loc = "breed='$breed'";
		echo $discover->all_serch_account($breed_loc, $start, $limit);

	}elseif ($location != undefined) {
		$str_location = str_replace('+', ' ', $location);
				//echo 'Location';
		echo $discover->discover_serch_by_location($str_location, $start, $limit);

	}elseif ($breed != undefined && $location != undefined && $serch_agefrom != undefined && $serch_ageto != undefined) {

		$datefrom = date("d-m-Y", mktime(0, 0, 0, date('m'), date('d'), date('Y') - $serch_agefrom));
		$stragefrom = strtotime($datefrom);

		$dateto = date("d-m-Y", mktime(0, 0, 0, date('m'), date('d'), date('Y') - $serch_ageto));
		$strageto = strtotime($dateto);

		$breed_loc = "breed='$breed' AND location='$location' AND birthday<='$stragefrom' AND birthday>='$strageto'";
		echo $discover->all_serch_account($breed_loc, $start, $limit);

	}elseif ($serch_agefrom != undefined  || $serch_ageto != undefined) {
		$datefrom = date("d-m-Y", mktime(0, 0, 0, date('m'), date('d'), date('Y') - $serch_agefrom));
		$stragefrom = strtotime($datefrom);

		$dateto = date("d-m-Y", mktime(0, 0, 0, date('m'), date('d'), date('Y') - $serch_ageto));
		$strageto = strtotime($dateto);

		$breed_loc = "birthday<='$stragefrom' AND birthday>='$strageto'";
		$discover->all_serch_account($breed_loc, $start, $limit);

	}else{
		echo $discover->get_all_account($start, $limit);
	}


}

if (isset($_POST['count_discover'])) {
	$discover = new Users_Discover;
	echo $discover->get_count_account();
}

if (isset($_POST['get_event'])) {
	$get_event = $notification->get_event();
	echo $get_event;
}

if (isset($_POST['get_all_event'])) {
	$get_all_event = $notification->get_all_event();
	echo $get_all_event;
}

if (isset($_POST['rem_event_active'])) {
	$notification->remove_active();
}

if (isset($_POST['ajax_popup'])) {
	$setting = new Setting;
	$uid = $_POST['ajax_popup_uid'];
	$sett = $setting->get_poup($uid);
	echo $sett;
}

if (isset($_POST['ajax_update'])) {
	$users = new Users;
	$uid = $_POST['ajax_uid'];
	$username = $_POST['ajax_username'];
	$breed = $_POST['ajax_breed'];
	$bdate = strtotime($_POST['ajax_datepi']);
	$sex = $_POST['ajax_sex'];
	
	if ($_FILES['img']) { 
		$name = $_FILES['img']['name'];
		switch ($_FILES['img']['type']) {
			case 'image/jpeg':
			$ext = 'jpg';
			break;
			case 'image/jpg':
			$ext = 'jpg';
			break;
			case 'image/gif':
			$ext = 'gif';
			break;
			case 'image/png':
			$ext = 'png';
			break;

			default:
			$ext = '';
			break;
		}
		if ($ext) {
            $path =$_SERVER['DOCUMENT_ROOT']. '/img/avatar/'; //путь в папку с изображениями
        $new_name = time().'.'.$ext; // новое имя с расширением
        $full_path = $path.$new_name; // полный путь с новым именем и расширением
        $ava_path = $_SERVER['HTTP_HOST']. '/img/avatar/' . $new_name;
        if (move_uploaded_file($_FILES['img']['tmp_name'], $full_path)) {
            $avatar = $new_name; //записываем имя картинки в переменную

        } else {
        	echo "Possible file upload attack!";
        }
    }

    $profile = $users->update_profile($uid, $username, $breed, $bdate, $sex, $avatar);
    echo $profile;
} else{
	$avatar = trim($_POST['oldimg']);
	$profile = $users->update_profile($uid, $username, $breed, $bdate, $sex, $avatar);
	echo $profile;
}


}

if (isset($_POST['edit_family_update'])) {
	$family = new Family;

	$username = $_POST['edit_family_username'];

	if ($_FILES['img']) { 
		$name = $_FILES['img']['name'];
		switch ($_FILES['img']['type']) {
			case 'image/jpeg':
			$ext = 'jpg';
			break;
			case 'image/jpg':
			$ext = 'jpg';
			break;
			case 'image/gif':
			$ext = 'gif';
			break;
			case 'image/png':
			$ext = 'png';
			break;

			default:
			$ext = '';
			break;
		}
		if ($ext) {
            $path =$_SERVER['DOCUMENT_ROOT']. '/img/avatar/'; //путь в папку с изображениями
        $new_name = time().'.'.$ext; // новое имя с расширением
        $full_path = $path.$new_name; // полный путь с новым именем и расширением
        $ava_path = $_SERVER['HTTP_HOST']. '/img/avatar/' . $new_name;
        if (move_uploaded_file($_FILES['img']['tmp_name'], $full_path)) {
            $avatar = $new_name; //записываем имя картинки в переменную

        } else {
        	echo "Possible file upload attack!";
        }
    }

    $family->edit_family($username, $avatar);
   // echo $profile;
} else{
	$avatar = trim($_POST['oldimg']);
	$family->edit_family($username, $avatar);

}


}

if (isset($_POST['ajax_add'])) {
	$users = new Users;
	
	$username = $_POST['ajax_add_username'];
	$breed = $_POST['ajax_add_breed'];
	$bdate = strtotime($_POST['ajax_add_datepi']);
	$sex = $_POST['ajax_add_sex'];
	
	if ($_FILES['img']) { 
		$name = $_FILES['img']['name'];
		switch ($_FILES['img']['type']) {
			case 'image/jpeg':
			$ext = 'jpg';
			break;
			case 'image/jpg':
			$ext = 'jpg';
			break;
			case 'image/gif':
			$ext = 'gif';
			break;
			case 'image/png':
			$ext = 'png';
			break;

			default:
			$ext = '';
			break;
		}
		if ($ext) {
            $path =$_SERVER['DOCUMENT_ROOT']. '/img/avatar/'; //путь в папку с изображениями
        $new_name = time().'.'.$ext; // новое имя с расширением
        $full_path = $path.$new_name; // полный путь с новым именем и расширением
        $ava_path = $_SERVER['HTTP_HOST']. '/img/avatar/' . $new_name;
        if (move_uploaded_file($_FILES['img']['tmp_name'], $full_path)) {
            $avatar = $new_name; //записываем имя картинки в переменную

        } else {
        	echo "Possible file upload attack!";
        }
    }

    $profile = $users->add_another_dog_profile($username, $avatar, $breed, $bdate, $sex);

} else{
	$avatar = trim($_POST['oldimg']);
	$profile = $users->add_another_dog_profile($username, $avatar, $breed, $bdate, $sex);
}


}

if (isset($_POST['ajax_new_family'])) {
	$users = new Users;
	$family = new Family;

	$newfamily = $_POST['ajax_new_newfamily'];
	$username = $_POST['ajax_new_username'];
	$breed = $_POST['ajax_new_breed'];
	$bdate = strtotime($_POST['ajax_new_datepi']);
	$sex = $_POST['ajax_new_sex'];
	$_SESSION['family'] = $newfamily;
	if ($_FILES['img']) { 
		$name = $_FILES['img']['name'];
		switch ($_FILES['img']['type']) {
			case 'image/jpeg':
			$ext = 'jpg';
			break;
			case 'image/jpg':
			$ext = 'jpg';
			break;
			case 'image/gif':
			$ext = 'gif';
			break;
			case 'image/png':
			$ext = 'png';
			break;

			default:
			$ext = '';
			break;
		}
		if ($ext) {
            $path =$_SERVER['DOCUMENT_ROOT']. '/img/avatar/'; //путь в папку с изображениями
        $new_name = time().'.'.$ext; // новое имя с расширением
        $full_path = $path.$new_name; // полный путь с новым именем и расширением
        $ava_path = $_SERVER['HTTP_HOST']. '/img/avatar/' . $new_name;
        if (move_uploaded_file($_FILES['img']['tmp_name'], $full_path)) {
            $avatar = $new_name; //записываем имя картинки в переменную

        } else {
        	echo "Possible file upload attack!";
        }
    }

    $profile = $users->add_another_dog_profile($username, $avatar, $breed, $bdate, $sex);

} else{
	$avatar = "";
	$profile = $users->add_another_dog_profile($username, $avatar, $breed, $bdate, $sex);
}

if ($_FILES['imgfamily']) { 
	$name = $_FILES['imgfamily']['name'];
	switch ($_FILES['imgfamily']['type']) {
		case 'image/jpeg':
		$ext = 'jpg';
		break;
		case 'image/jpg':
		$ext = 'jpg';
		break;
		case 'image/gif':
		$ext = 'gif';
		break;
		case 'image/png':
		$ext = 'png';
		break;

		default:
		$ext = '';
		break;
	}
	if ($ext) {
            $pathfam =$_SERVER['DOCUMENT_ROOT']. '/img/avatar/'; //путь в папку с изображениями
        $new_name_fam = time().'.'.$ext; // новое имя с расширением
        $full_pathfam = $pathfam.$new_name_fam; // полный путь с новым именем и расширением
        $ava_pathfam = $_SERVER['HTTP_HOST']. '/img/avatar/' . $new_name_fam;
        if (move_uploaded_file($_FILES['imgfamily']['tmp_name'], $full_pathfam)) {
            $avatarfamily = $new_name_fam; //записываем имя картинки в переменную

        } else {
        	echo "Possible file upload attack!";
        }
    }

    $family->add_new_family($newfamily, $avatarfamily);


} else{
	$avatarfamily = "";
	$family->add_new_family($newfamily, $avatarfamily);

	
}


}

if (isset($_POST['count_whotofollow'])) {
	$valuation = new Valuat;
	$lim = $valuation->get_count_whotofollow();
	echo count($lim);
}

if (isset($_POST['whotofollow'])) {
	$valuation = new Valuat;
	$follow_start = $_POST['follow_start'];
	$follow_limit = $_POST['follow_limit'];
	$followlimit = $valuation->get_all_list_users($follow_start, $follow_limit);
	echo $followlimit;
}

if (isset($_POST['more_follow'])) {
	$followers = new Followers;
	$follow_starts = $_POST['follow_starts'];
	$follow_limits = $_POST['follow_limits'];
	$followers->get_follow($follow_starts, $follow_limits);
}

if (isset($_POST['more_following'])) {
	$followers = new Followers;
	$following_starts = $_POST['following_starts'];
	$following_limits = $_POST['following_limits'];
	$followers->get_following($following_starts, $following_limits);
}

if (isset($_POST['comment_view'])) {
	$comment = new Comments;
	$comment_start = $_POST['comment_start'];
	$comment_limit = $_POST['comment_limit'];
	$comment_postid = $_POST['comment_postid'];
	$comment->get_comment($comment_postid, $comment_start, $comment_limit);
}

if (isset($_POST['save_setting_user'])) {
	$setting = new Setting;
	
	$email = $_POST['email'];
	$curr_password = $_POST['currpass'];
	$newpassword = $_POST['newpass'];
	$Re_Type_password = $_POST['newrepass'];
	if ($newpassword === $Re_Type_password) {
		$password = $newpassword;
	}

	if ($_POST['settings_fb'] !=  undefined) {
		$network['facebook'] = $_POST['settings_fb'];
	}

	if ($_POST['settings_tw'] !=  undefined) {
		$network['twitter'] = $_POST['settings_tw'];
	}

	if ($_POST['settings_inst'] !=  undefined) {
		$network['instagram'] = $_POST['settings_inst'];
	}

	if ($_POST['settings_tumblr'] !=  undefined) {
		$network['tumblr'] = $_POST['settings_tumblr'];
	}    

	if ($_POST['settings_goo'] !=  undefined) {
		$network['google'] = $_POST['settings_goo'];
	}       
//echo $curr_password .  $password;

	$network_link = serialize($network);

	$setting->set_account_setting($email, $curr_password, $password, $network_link);
}

if (isset($_POST['ajax_post_photo_popup_id'])) {
	$wall = new wall;
	$ajax_post_photo_popup_id = $_POST['ajax_post_photo_popup_id'];
	$ajax_post_photo_popup_url = $_POST['ajax_post_photo_popup_url'];
	$wall->get_post_photo_popup($ajax_post_photo_popup_id, $ajax_post_photo_popup_url);
}

if (isset($_POST['more_scroll'])) {
	$wall = new wall;
	$scroll_start = $_POST['scroll_start'];
	$scroll_limit = $_POST['scroll_limit'];
	$scroll_uid = $_POST['scroll_uid'];
	$wall->get_posts($scroll_uid, $scroll_start, $scroll_limit);
}

if (isset($_POST['restore_password'])) {
	$setting = new Setting;
	$restore_email = $_POST['restore_email'];
	$setting->get_restor($restore_email);
}

if (isset($_POST['check_follow'])) {
	$followers = new Followers;
	if (($_SESSION['family']) != null ) {

		$user_id = $_SESSION['family'];
	} else {
		$user_id = $_SESSION['user_id'];
	}
	$followers->count_follow_me($user_id);
	$followers->count_followers_me($user_id);
}

if (isset($_POST['search_main'])) {
	$search = new Search;
	$search_val = $_POST['search_val'];
	$search->get_all_users($search_val);
}

}
?>
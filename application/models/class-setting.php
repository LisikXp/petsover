<?php

class Setting
{
    /*https://maps.googleapis.com/maps/api/geocode/json?latlng=48.508,35.074&key= AIzaSyAQwjhkihN__RSF1f5KCGAMgOzaY8aCaHw */


    function set_account_setting($email, $curr_password, $new_password, $network_link)
    {

        $uid = $_SESSION['owner_id'];
        $user = new Users;
        $myaacountuser = $user->my_owner();


        if ($email != null) {
            $result = mysql_query("UPDATE user SET email='$email' WHERE user_id='$uid'");
            if ($result == "true") {
                echo "Email saved" . "<br>";
            } else {
                echo "Email not saved" . "<br>";
            }
        }
        if ($new_password != null) {
            if ($curr_password === $myaacountuser['password']) {
                $password = $new_password;
                $result = mysql_query("UPDATE user SET password='$password' WHERE user_id='$uid'");
                if ($result == "true") {
                    echo "New password saved" . "<br>";
                } else {
                    echo "New password not saved" . "<br>";
                }
            } else {
                echo $curr_password . " -- " .$myaacountuser['password']. "<br>";
            }

        }
        if ($network_link != null) {
            $result = mysql_query("UPDATE user SET network_link='$network_link' WHERE user_id='$uid'");
            if ($result == "true") {
                echo "Social networks saved" . "<br>";
            } else {
                echo "Social networks not saved" . "<br>";
            }
        }


    }

    function set_account_photo($uri)
    {
        $wall = new Wall;
        $avatar = str_replace('img/avatar/', '/', $uri);
/*        if (($_SESSION['family_id']) != null) {
            $uid = $_SESSION['family_id'];
        } else {
            $uid = $_SESSION['user_id'];
        }*/
        $uid = $_SESSION['get_id'];
        $result = mysql_query("UPDATE user SET photo='$avatar' WHERE user_id='$uid'");
        $wall->set_main_photo_post($uid, $uid, $avatar);

    }

    function reset_password($password, $uid)
    {
        $new_password = md5($password);
        $result = mysql_query("UPDATE user SET password='$new_password' WHERE user_id='$uid'");
        if ($result == 'true') {
            $active = 0;
            $resultt = mysql_query("UPDATE resetpass SET active='$active' WHERE user_id='$uid'");
            header('location:/SignIn');
        }
    }

    function set_guest_setting($uname, $location, $avatar)
    {
        $wall = new Wall;
        $uid = $_SESSION['owner_id'];
        $user = new Users;
        $count = $user->check_count_account();
        if ($uname != null) {
            $result = mysql_query("UPDATE user SET name='$uname' WHERE user_id='$uid'");
        }
        if ($location != null) {

            if ($count != 0) {
               $result = mysql_query("UPDATE user SET location='$location' WHERE owner_id='$uid'");
           } else {
            $result = mysql_query("UPDATE user SET location='$location' WHERE user_id='$uid'");
        }
    }
    if ($avatar != null) {
        $result = mysql_query("UPDATE user SET photo='$avatar' WHERE user_id='$uid'");
        $wall->set_main_photo_post($uid, $uid, $avatar);
    }
    if ($result == "true") {
        return "true";
    } else {
        return "false";
    }

}

function get_all_users_accounts()
{

    $uid = $_SESSION['owner_id'];
    $sql_res = mysql_query("SELECT * FROM user WHERE owner_id='$uid'") or die(mysql_error());
    $arr = mysql_fetch_assoc($sql_res);
    if (mysql_num_rows($sql_res) > 1 || $arr['owner_id'] != 0) {
        return (mysql_num_rows($sql_res));
    }

}

function get_family_account()
{

    $uid = $_SESSION['family_id'];
    $sql_res = mysql_query("SELECT * FROM user WHERE user_id='$uid'") or die(mysql_error());
    $arr = mysql_fetch_assoc($sql_res);
    $mphoto = "http://" . $_SERVER['HTTP_HOST'] . "/img/avatar/" . $arr['photo'];
    if ($arr['photo'] == null) {
        $mphoto = "http://" . $_SERVER['HTTP_HOST'] . "/img/avatar/no-photo.png";
    } ?>
    <li class="list-element edit-profile-list-element">
        <div class="flex-wrapper follow-list-item">

            <div class="flex-wrapper">
                <div class="follow-dog-image follow-dog-image-centered  edit-profile-image family-edit-profile-image">
                    <img src="<?= $mphoto; ?>" alt="dog picture">
                </div>
                <div class="follow-dog-description family-edit-profile-info">
                    <p class="follow-dog-name follow-dog-name-centered">
                        <?= $arr['name']; ?>
                    </p>
                    <p class="follow-dog-breed ">
                    </p>
                </div>
            </div>
            <div class="follow-list-item-state state-edit">
                <button class="link button  follow-cta edit-cta  popup-trigger" data-popup-id="edit-family-popup">
                    Edit
                </button>
            </div>
        </div>
    </li>
    <hr class="hr-full-width">
    <?php
}

function get_owner_accoount(){

    $uid = $_SESSION['owner_id'];
    $sql_res = mysql_query("SELECT * FROM user WHERE user_id='$uid'") or die(mysql_error());

    $arr = mysql_fetch_assoc($sql_res);
    $mphoto = "http://" . $_SERVER['HTTP_HOST'] . "/img/avatar/" . $arr['photo'];
    if ($arr['photo'] == null) {
        $mphoto = "http://" . $_SERVER['HTTP_HOST'] . "/img/avatar/no-photo.png";
    }
    ?>

    <li class="list-element edit-profile-list-element">
        <div class="flex-wrapper follow-list-item">

            <div class="flex-wrapper">
                <div class="follow-dog-image follow-dog-image-centered  edit-profile-image owner-edit-profile-image">
                    <img src="<?= $mphoto; ?>" alt="dog picture">
                </div>
                <div class="follow-dog-description owner-edit-profile-info">
                    <p class="follow-dog-name follow-dog-name-centered">
                        <?= $arr['name']; ?>
                    </p>
                    <p class="follow-dog-breed ">
                    </p>
                    <p class="follow-dog-location">
                        <?= $arr['location']; ?>
                    </p>
                </div>
            </div>
            <div class="follow-list-item-state state-edit">
                <button class="link button  follow-cta edit-cta  popup-trigger" data-popup-id="edit-owner-popup">
                    Edit
                </button>
            </div>
        </div>
    </li>

    <?php
}

function get_list_account()
{
    if (($_SESSION['family_id']) != null) {
        $fid = $_SESSION['family_id'];
        $uid = $_SESSION['owner_id'];
        $where = "family_id='$fid' AND user_id<>'$fid' AND user_id<>'$uid'";
        $this->get_family_account();
    } else {
        $uid = $_SESSION['owner_id'];
        $where = "owner_id='$uid' AND user_id<>'$uid'";
    }
    $sql_res = mysql_query("SELECT * FROM user WHERE $where") or die(mysql_error());
    $this->get_owner_accoount();
    if (mysql_num_rows($sql_res) != 0) {
      for ($i = 0; $i < mysql_num_rows($sql_res); $i++) {
        $user_arr = mysql_fetch_assoc($sql_res);
        $mphoto = "http://" . $_SERVER['HTTP_HOST'] . "/img/avatar/" . $user_arr['photo'];
        if ($user_arr['photo'] == null) {
            $mphoto = "http://" . $_SERVER['HTTP_HOST'] . "/img/avatar/no-photo.png";
        } ?>
        <hr class="hr-full-width">
        <li class="list-element edit-profile-list-element">
            <div class="flex-wrapper follow-list-item">

                <div class="flex-wrapper edit-profile_<?= $user_arr['user_id']; ?>">
                    <div class="follow-dog-image follow-dog-image-centered  edit-profile-image">
                        <img src="<?php echo $mphoto; ?>" alt="dog picture">
                    </div>
                    <div class="follow-dog-description">
                        <p class="follow-dog-name follow-dog-name-centered">
                            <?= $user_arr['name']; ?>
                        </p>
                        <p class="follow-dog-breed ">
                            <?= $user_arr['breed']; ?>
                        </p>
                        <p class="follow-dog-age">
                            <?php
                            $timestamp = $user_arr['birthday'];
                            echo $user_arr['sex'] . ", Age " . (date('Y') - gmdate("Y", $timestamp)); ?>
                        </p>
                    </div>
                </div>
                <div class="follow-list-item-state state-edit">
                    <button class="link button  follow-cta edit-cta  popup-trigger"
                    data-popup-id="edit-single-dog-popup" data-popup-uid="<?= $user_arr['user_id']; ?>">
                    Edit
                </button>
            </div>
        </div>
    </li>

    <?php }
}
}

function get_poup($uid)
{
    $sql_res = mysql_query("SELECT * FROM user WHERE user_id='$uid'") or die(mysql_error());
    $user_arr = mysql_fetch_assoc($sql_res);
    $timestamp = $user_arr['birthday'];
    $photo = "http://" . $_SERVER['HTTP_HOST'] . "/img/avatar/" . $user_arr['photo'];
    if ($user_arr['photo'] == null) {
        $photo = "http://" . $_SERVER['HTTP_HOST'] . "/img/avatar/no-photo.png";
    } ?>

    <script>
        var myid = <?= $_SESSION['user_id']; ?>;
        $(function () {
            $('.my-profile-image').on('click', function(){
                var url = $('#image').attr('src');
                $('#profile-photo-popup').find('.image-profile-current>img').attr('src', url);
                $('#profile-photo-popup').addClass('flex-wrapper');
                $('body').css('overflow-y','hidden');
            });

            $('button, a').on('click', function () {
                if ($(this).data('action') == "close-popup") {
                    if ($('#profile-photo-popup').hasClass('family')) {
                        $('#profile-photo-popup').removeClass('family');
                        $('#profile-photo-popup').removeClass('flex-wrapper');
                    }else if ($('#profile-photo-popup').hasClass('pet')) {
                        $('#profile-photo-popup').removeClass('pet');
                        $('#profile-photo-popup').removeClass('flex-wrapper');
                    } else {
                        $('.popups-wrapper').removeClass('flex-wrapper');
                        $('body').css('overflow-y', 'auto');
                        $('#edit-single-dog-popup').empty();
                    }
                }
                if ($(this).data('edit-profile') == "edit-profile") {
                    this.disabled = false;
                    ajax_set_post();
                }
            });

            function ajax_set_post() {

               // var $input = $("#userfile");
               var oldimg = document.getElementById("image").src;
               var texty = oldimg.replace('http://petsoverload.yaskravo.net/img/avatar/', '/');
               var username = document.getElementById("settings-username-edit").value;
               var breed = document.getElementById("breed").value;
               var datepi = document.getElementById("editdatepicker").value;
               var sex = document.getElementById("sex").value;
               var uid = $('.edit_popup').attr('id');
                    //alert(username + breed + datepi +sex +uid);
                    var data = new FormData();
                    data.append("ajax_update", 'true');
                    data.append("ajax_uid", uid);
                    data.append("ajax_username", username);
                    data.append("ajax_breed", breed);
                    data.append("ajax_datepi", datepi);
                    data.append("ajax_sex", sex);
                   // data.append('img', $input.prop('files')[0]);
                   data.append('oldimg', texty);
                   $.ajax({
                    url: "/application/Request/setpost.php",
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('.popup .heading-h3').append('<img src="img/preloader.gif" class="task-img chekdone" alt="done photo">');
                    },
                    complete: function () {

                    },
                    success: function (data) {

                        $('.edit-profile_' + uid + ' .edit-profile-image img').attr('src', oldimg);        
                        $('.edit-profile_' + uid + ' .follow-dog-description .follow-dog-name-centered').text(username);
                        $('.edit-profile_' + uid + ' .follow-dog-description .follow-dog-breed').text(breed);
                        if (myid == uid) {
                            $('.account-info .account-text-name').text(username);
                            $('.account-info .account-text-breed').text(breed);
                            $('.account-info .account-image img').attr('src', oldimg);
                        }

                        var now = new Date();

                        var dbp = datepi.split(/-/);
                        var strnewd = (now.getFullYear() - dbp[2]);
                        $('.edit-profile_' + uid + ' .follow-dog-description .follow-dog-age').text(sex + ', Age ' + strnewd);
                        $('.popups-wrapper').removeClass('flex-wrapper');
                        $('body').css('overflow-y', 'auto');
                        $('#edit-single-dog-popup').empty();
                        $('.task-img').remove();

                    }

                });
               }

               $("#editdatepicker").datepicker({
                   utoclose: true, 
                   todayHighlight: true,
                   startDate: new Date('1980-01-01')
               }).datepicker('update', new Date());

               function readURL(input) { /* превью картинки*/

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#image').attr('src', e.target.result);

                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $("#userfile").change(function () {
                readURL(this);
            });
        });
    </script>
    <div class="popup edit_popup" id="<?= $user_arr['user_id']; ?>">
        <div class="tile">
            <div class="settings">
                <form id="add_dog" method="post" enctype="multipart/form-data">
                    <h3 class="heading-h3  no-margin tal">
                        Edit profile info
                    </h3>
                    <hr class="hr-full-width hr-body">
                    <div class="profile-edit-image-container">
                        <img id="image" class="image image-photo-bg" src="<?php echo $photo; ?>"/>
                        <div class="image-container-default-bg">
                                <!-- <label class="btn btn-default btn-sm center-block btn-file">
                                  
                                    <i class="fa fa-upload fa-2x" aria-hidden="true"></i>
                                    <input id="userfile" type="file" name="filename" size="5000" style="display: none;">
                                </label> -->
                                <img class="image my-profile-image" src="/img/photo-camera.svg" />
                            </div>
                        </div>
                        <fieldset>
                            <div class="settings-row settings-row-half">
                                <input type="text" class="input" id="settings-username-edit" placeholder="Username"
                                value="<?= $user_arr['name']; ?>">
                            </div>
                            <div class="settings-row settings-row-half">
                                <select type="text" class="input" id="breed">
                                    <option selected
                                    value="<?= $user_arr['breed']; ?>"><?= $user_arr['breed']; ?></option>
                                    <option value="Airedale Terrier">Airedale Terrier</option>
                                    <option value="Airedale">Airedale</option>
                                    <option value="Basset Hound">Basset Hound</option>
                                    <option value="Basenji">Basenji</option>
                                    <option value="Border Collie">Border Collie</option>
                                    <option value="Beagle">Beagle</option>
                                    <option value="Bloodhound">Bloodhound</option>
                                    <option value="Chow Chow">Chow Chow</option>
                                    <option value="Boxer">Boxer</option>
                                    <option value="Bulldog">Bulldog</option>
                                    <option value="Chihuahua">Chihuahua</option>
                                    <option value="Cocker Spaniel">Cocker Spaniel</option>
                                    <option value="Fox Terrier">Fox Terrier</option>
                                    <option value="Corgi">Corgi</option>
                                    <option value="Dachshund">Dachshund</option>
                                    <option value="Dalmatian">Dalmatian</option>
                                    <option value="Doberman">Doberman</option>
                                    <option value="German Shepherd">German Shepherd</option>
                                    <option value="Golden Retriever">Golden Retriever</option>
                                    <option value="Great Dane">Great Dane</option>
                                    <option value="Irish Setter">Irish Setter</option>
                                    <option value="Greyhound">Greyhound</option>
                                    <option value="Newfoundland">Newfoundland</option>
                                    <option value="Saint Bernard">Saint Bernard</option>
                                </select>
                            </div>
                            <div class="settings-row settings-row-half">

                                <input type="text" class="input input-group date" id="editdatepicker"
                                placeholder="Date of birth" value="<?= gmdate("d-m-Y", $timestamp); ?>"
                                data-date-format="dd-mm-yyyy">
                            </div>

                            <div class="settings-row settings-row-half">
                                <select type="text" class="input" id="sex">
                                    <option selected value="<?= $user_arr['sex']; ?>"><?= $user_arr['sex']; ?></option>
                                    <option value="Sex">Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                        </fieldset>
                    </form>
                    <hr class="hr-full-width hr-body">
                    <div class="settings-action-button">
                        <a href="#" class="link link-gray" id="close-popup" data-action="close-popup">
                            Cancel
                        </a>
                        <a href="#" class="link button button-cta-green contest-button"
                        data-edit-profile="edit-profile">
                        Save changes
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php }

    /*----------forgotten password----------*/
    function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    //echo $this->generateRandomString();

    function restore_password($email, $name, $uid)
    {
        $new_password = $this->generateRandomString();
        //$my_pass = md5($new_password);
        $active = 1;
        mysql_query("INSERT INTO resetpass SET user_id='$uid', 
         email='$email', 
         code='$new_password',
         active='$active'");
        $id = mysql_insert_id();

        $message = '
        <html>
        <head>
         <title>Password retrieval</title>
     </head>
     <body>
         <h1>Hi ' . $name . '</h1>
         <a href="http://petsoverload.yaskravo.net/reset?action=' . $new_password . '">Your link</a>

     </body>
     </html>
     ';

     $pagetitle = "Petsfame logo";
     mail($email, $pagetitle, $message, "Content-type: text/html; charset=\"utf-8\"\n From: $email");

 }

 function get_restor($restor_email)
 {


    $sql_res = mysql_query("SELECT * FROM user WHERE email='$restor_email'") or die(mysql_error());
    if (mysql_num_rows($sql_res) != 0) {
        $arr = mysql_fetch_assoc($sql_res);
        $name = $arr['name'];
        $uid = $arr['user_id'];
        $this->restore_password($restor_email, $name, $uid);

        echo "<p class='paragraph paragraph-no-margin paragraph-underheader link-green'>Password recovery link sent to your email address</p>
        <a href='SignIn' class='link link-green'>SignIn</a>";

    } else {

        echo "<p class='paragraph paragraph-no-margin paragraph-underheader red'>A user with this address does not exist</p>
        <a href='SignUp' class='link link-green'>SignUp</a>";
    }


}

function cheking_a_family($name)
{
    $uid = $_SESSION['owner_id'];
    $sql_res = mysql_query("SELECT * FROM user WHERE owner_id='$uid'") or die(mysql_error());
    if (mysql_num_rows($sql_res) != 2) {
        return "add-single-dog-popup";
    } else {
        return "add-a-family-popup";
    }
}

function check_family_by_setting($get_id)
{
    $family = new Family;
    $follow = new Followers;
    $myfamily = $family->get_my_family_members();


    for ($r = 0; $r < count($myfamily); $r++) {
        if ($get_id == $myfamily[$r]) {
            $yes = true;
        } else {
            $no = false;
        }
    }
    if ($yes) { ?>
    <a href="/Settings" class="link button button-full-width userprofile-edit-button  button-cta-gray ">Edit
        profile</a>
        <?php } else {
            $follow->serch_follow_sidebar($get_id);
        }


    }

    function check_change_main_photo($get_id){
        $family = new Family;
        $myfamily = $family->get_my_family_members();


        for ($r = 0; $r < count($myfamily); $r++) {
            if ($get_id == $myfamily[$r]) {
                $yes = true;
            } else {
                $no = false;
            }
        }
        if ($yes) { ?>
        <img src="/img/photo.svg" alt="" class="my-profile-image nonactive">
        <?php } 
    }

}

?>
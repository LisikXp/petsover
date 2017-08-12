<?php require_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include/header/header-singl.php";?>
<main class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-3  col-md-3-custom-left">
                <a href="<?= $home;?>" class="link link-gray back-to-section-link"> Back to profile</a>
                <p class="category-subname settings-tabs-header">Account Settings</p>
                <ul class="list category-list tabs settings-tabs-list">
                    <li class="list-item tab-link current" data-tab="tab-1">
                        <a href="#" class="link link-with-avatar">Account Settings</a>
                    </li>
                    <li class="list-item tab-link" data-tab="tab-2">
                        <a href="#" class="link link-with-avatar">Notifications</a>
                    </li>
                </ul>
                <p class="category-subname">
                    Profile Settings
                </p>
                <ul class="list category-list tabs">
                    <li class="list-item list-item-with-image tab-link " data-tab="tab-3">
                       <a href="#" class="link link-with-avatar "><?= $setting->get_all_users_accounts()?> Profiles</a>
                   </li>
               </ul>
               <a href="#" class="link link-green popup-trigger" data-popup-id="<?= $setting->cheking_a_family($name);?>">+ Add a pet</a>
           </div>
           <div class="col-md-6 col-md-6-custom">
            <div id="tab-1" class="tab-content current">
                <div class="tile msg_settings">
                    <div class="settings">
                     <form action="" method="post">
                        <h3 class="heading-h3 category-name no-margin">
                            Login Email
                        </h3>
                        <hr class="hr-full-width hr-body">
                        <fieldset>
                            <div class="settings-row">
                                <label for="settings-username"> Email Address </label>
                                <input type="text" class="input" id="settings-email" placeholder="Username" value="<?= $myaacountuser['email'];?>" name="email">
                            </div>
                        </fieldset>
                        <h3 class="heading-h3 category-name no-margin category-name-mt">
                            Change Password
                        </h3>
                        <hr class="hr-full-width hr-body">
                        <fieldset>
                            <div class="settings-row">
                                <label for="settings-username"> Current Password </label>
                                <input type="password" class="input" id="settings-currpass" placeholder="Enter your current password" name="curr_password" >
                            </div>
                            <div class="settings-row">
                                <label for="settings-username">New Password</label>
                                <input title="Password must contain at least 8 characters, including UPPER/lowercase and numbers" type="password" class="input" id="settings-newpass" placeholder="Enter your new password" name="new_password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');if(this.checkValidity()) form.Re_Type_password.pattern = this.value;">
                            </div>
                            <div class="settings-row">
                                <label for="settings-username">Re-Type New Password</label>
                                <input title="Please enter the same Password as above" type="password" class="input" id="settings-newrepass" placeholder="Enter your new password once again" name="Re_Type_password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');">
                            </div>

                        </fieldset>
                        <h3 class="heading-h3 category-name no-margin  category-name-mt">
                            Social Networks
                        </h3>
                        <hr class="hr-full-width hr-body">
                        <fieldset>
                            <div class="settings-row">
                                <label for="settings-username">Facebook</label>
                                <input type="text" class="input" id="settings-fb" placeholder="Enter a link to your facebook account" name="facebook" value="<?= $mynetwork['facebook'];?>">
                            </div>
                            <div class="settings-row">
                                <label for="settings-username">Twitter</label>
                                <input type="text" class="input" id="settings-tw" placeholder="Enter a link to your twitter account" name="twitter" value="<?= $mynetwork['twitter'];?>">
                            </div>
                            <div class="settings-row">
                                <label for="settings-username">Instagram</label>
                                <input type="text" class="input" id="settings-inst" placeholder="Enter a link to your instagram account" name="instagram" value="<?= $mynetwork['instagram'];?>">
                            </div>
                            <div class="settings-row">
                                <label for="settings-username">Tumblr</label>
                                <input type="text" class="input" id="settings-tumblr" placeholder="Enter a link to your tumblr account" name="tumblr" value="<?= $mynetwork['tumblr'];?>">
                            </div>
                            <div class="settings-row">
                                <label for="settings-username">Google+</label>
                                <input type="text" class="input" id="settings-goo" placeholder="Enter a link to your google plus account" name="google" value="<?= $mynetwork['google'];?>">
                            </div>

                        </fieldset>
                        <h3 class="heading-h3 category-name no-margin category-name-mt">
                            Delete Account
                        </h3>
                        <hr class="hr-full-width hr-body">
                        <fieldset>
                            <div class="delete-account-message">
                                <p>Lorem ipsum porta, nec molestie risus justo, eu vulputate, sagittis eget ultricies eros sagittis nibh, elementum, justo eu urna proin lectus, porttitor.</p>
                                <p>
                                    Eu malesuada arcu quisque sapien sodales quam nibh eget congue cursus enim a nam lorem curabitur orci at, nec. Vivamus rutrum bibendum molestie — morbi risus a magna nec ligula enim. Rutrum donec eu rutrum ut justo lorem proin eu sodales rutrum commodo
                                    enim fusce orci donec integer, in — at.
                                    <a href="#" class="delete-link">Request Deleting Account</a>
                                </p>
                            </div>
                        </fieldset>
                    </form>
                    <hr class="hr-full-width hr-body">
                    <div class="settings-action-button">
                        <a href="#" class="link link-gray">
                            Cancel
                        </a>
                        <input type="submit" class="link button button-cta-green contest-button" name="save_setting" value="Save changes" id="save_setting">
                    </div>
                    
                </div>
            </div>
        </div>
        <div id="tab-2" class="tab-content">
            <div class="tile">
                <div class="settings">
                    <h3 class="heading-h3 category-name no-margin">
                        Notifications
                    </h3>
                    <hr class="hr-full-width hr-body">
                    <form action="change-settings">
                        <fieldset>
                            <div class="settings-row">
                                <label for="notification-chbx-1">
                                   Lorem ipsum dolor sit amet, consectetur.
                               </label>
                               <input type="checkbox" class="checkbox" id="notification-chbx-1" checked="checked">
                           </div>
                           <div class="settings-row">
                            <label for="notification-chbx-2">
                               Lorem ipsum dolor sit amet notification
                           </label>
                           <input type="checkbox" class="checkbox" id="notification-chbx-2">
                       </div>
                       <div class="settings-row">
                        <label for="notification-chbx-3">
                           Lorem ipsum dolor sit amet, consectetur adipisicing.
                       </label>
                       <input type="checkbox" class="checkbox" id="notification-chbx-3">
                   </div>
                   <div class="settings-row">
                    <label for="notification-chbx-4">
                       Lorem ipsum dolor sit.
                   </label>
                   <input type="checkbox" class="checkbox" id="notification-chbx-4" checked="checked">
               </div>
               <div class="settings-row">
                <label for="notification-chbx-5">
                  Lorem ipsum dolor sit amet notification
              </label>
              <input type="checkbox" class="checkbox" id="notification-chbx-5" checked="false">
          </div>
      </fieldset>
  </form>
  <hr class="hr-full-width hr-body">
  <div class="settings-action-button">
    <a href="#" class="link link-gray">
     Cancel
 </a>
 <a href="#" class="link button button-cta-green contest-button">
     Save changes
 </a>
</div>
</div>
</div>
</div>
<div id="tab-3" class="tab-content">
    <div class="tile">
        <h3 class="heading heading-h3 heading-no-margin">Profiles settings</h3>
        <hr class="hr-full-width">
        <ul class="list followers">
            <?php $setting->get_list_account();?>
        </ul>
        <hr class="hr-full-width">
        <a href="#" class="link link-green  block link-custom-add-pet popup-trigger" data-popup-id="<?= $setting->cheking_a_family($name);?>">+ Add another pet</a>
    </div>
</div>
</div>
<div class="col-md-3  col-md-3-custom-right">

    <div class="banner">
        <!--<img src="http://via.placeholder.com/270x240" alt="" class="banner-content">-->
        <div style="background-color: #000; width: 270px; height: 240px; position: relative;">
            <h3 style="color: #fff; text-align: center; margin: auto;position: absolute; top: 50%; margin-top:  -10px; height: 20px; width: 100%;">270x240</h3>
        </div>
    </div>
    <div class="follow">
        <?php require_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include/tofollow/follow-dogs.php"; ?>
    </div>

    <?php require_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include/footer.php"; ?>
    
    <div id="edit-single-dog-popup" class="popups-wrapper"></div>

    <script>
        $( function() {
            $("#datepicker").datepicker({
             autoclose: true, 
             todayHighlight: true
         }).datepicker('update', new Date());

            function owner_readURL(input) { /* превью картинки*/

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#owner_image').attr('src', e.target.result);

                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            function edit_famiy_readURL(input) { /* превью картинки*/

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#edit_famiy_image').attr('src', e.target.result);

                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $("#edit_famiy_userfile").change(function(){
                edit_famiy_readURL(this);
            });
            $("#owner_userfile").change(function(){
                owner_readURL(this);
            });
        } );
    </script>
    <div id="edit-owner-popup" class="popups-wrapper">
        <div class="popup">
            <div class="tile">
                <div class="settings">
                    <form action="">
                        <h3 class="heading-h3  no-margin tal">
                            Edit profile info
                        </h3>
                        <hr class="hr-full-width hr-body">
                        <div class="profile-edit-image-container">
                         <img id="owner_image" class="image image-photo-bg" src="<?= $maine_photo;?>" />
                         <div class="image-container-default-bg">

                             <label class="btn btn-default btn-sm center-block btn-file">
                                 <img class="image" src="/img/photo-camera.svg" />   
                                 <i class="fa fa-upload fa-2x" aria-hidden="true"></i>
                                 <input id="owner_userfile" type="file" name="filename" size="5000" style="display: none;">
                             </label>
                         </div>
                     </div>
                     <fieldset>
                        <div class="settings-row settings-row-half">
                         <!--  <input type="text" class="input" id="name" placeholder="Name"> -->
                         <input type="text" class="input" id="owner-settings-username" placeholder="Name" value="<?= $owner;?>">
                     </div>
                     <div class="settings-row settings-row-half">
                         <input type="text" class="input" id="signup-location" placeholder="Location" value="<?= $location;?>">
                     </div>
                     <div class="settings-row settings-row-with-link">
                         <p class="link link-green" onclick="getLocation()">Define my location</p>
                     </div>

                 </fieldset>
             </form>
             <hr class="hr-full-width hr-body">
             <div class="settings-action-button">
                <a href="#" class="link link-gray" data-action="close-popup">
                    Cancel
                </a>
                <input type="submit" class="link button button-cta-green contest-button" name="save_setting_guest" id="save_setting_guest" value="Save changes">
            </div>
        </div>
    </div>
</div>
</div>
<div id="edit-family-popup" class="popups-wrapper">
    <div class="popup">
        <div class="tile">
            <div class="settings">
                <form action="change-settings">
                    <h3 class="heading-h3  no-margin tal">
                        Edit family info
                    </h3>
                    <hr class="hr-full-width hr-body">
                    <div class="profile-edit-image-container">
                        <img id="edit_famiy_image" class="image image-photo-bg" src="<?= $photo;?>"/>
                        <div class="image-container-default-bg">
                           <label class="btn btn-default btn-sm center-block btn-file">
                             <img class="image" src="/img/photo-camera.svg" />   
                             <i class="fa fa-upload fa-2x" aria-hidden="true"></i>
                             <input id="edit_famiy_userfile" type="file" name="filename" size="5000" style="display: none;">
                         </label>
                     </div>
                 </div>
                 <fieldset>
                    <div class="settings-row i">
                        <input type="text" class="input input-full-width" id="new_family_name" placeholder="Family name" value="<?= $name;?>">
                    </div>

                </fieldset>
            </form>
            <hr class="hr-full-width hr-body">
            <div class="settings-action-button">
                <a href="#" class="link link-gray" data-action="close-popup">
                    Cancel
                </a>
                <input type="submit" class="link button button-cta-green contest-button" name="save_setting_guest" id="edit_family" value="Save changes">
              <!--   <a href="#" class="link button button-cta-green contest-button" id="edit_family">
                  Save changes
              </a> -->
          </div>
      </div>
  </div>
</div>
</div>




<!-- Optimized loading JS Start -->

       <!--  <script>
           var scr = {
               "scripts": [{
                   "src": "js/libs.min.js",
                   "async": false
               }, {
                   "src": "js/common.js",
                   "async": false
               }]
           };
           ! function(t, n, r) {
               "use strict";
               var c = function(t) {
                   if ("[object Array]" !== Object.prototype.toString.call(t)) return !1;
                   for (var r = 0; r < t.length; r++) {
                       var c = n.createElement("script"),
                       e = t[r];
                       c.src = e.src, c.async = e.async, n.body.appendChild(c)
                   }
                   return !0
               };
               t.addEventListener ? t.addEventListener("load", function() {
                   c(r.scripts);
               }, !1) : t.attachEvent ? t.attachEvent("onload", function() {
                   c(r.scripts)
               }) : t.onload = function() {
                   c(r.scripts)
               }
           }(window, document, scr);
       </script> -->


       <!-- Optimized loading JS End -->

   </body>

   </html>
<?php require_once $_SERVER['DOCUMENT_ROOT']. "/application/views/Users/include/header/header-singl.php"; ?>
    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3  col-md-3-custom-left">
                    <a href="Profile-Guest.html" class="link link-gray back-to-section-link"> Back to profile</a>
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
                           <a href="#" class="link link-with-avatar ">2 Profiles</a>
                        </li>
                    </ul>
                    <a href="#" class="link link-green popup-trigger" data-popup-id="edit-single-dog-popup" >+ Add a pet</a>
                </div>
                <div class="col-md-6 col-md-6-custom">
                    <div id="tab-1" class="tab-content current">
                        <div class="tile">
                            <div class="settings">
                                <form action="change-settings">
                                    <h3 class="heading-h3 category-name no-margin">
                                        Login Email
                                    </h3>
                                    <hr class="hr-full-width hr-body">
                                    <fieldset>
                                        <div class="settings-row">
                                            <label for="settings-username"> Email Address </label>
                                            <input type="text" class="input" id="settings-username" placeholder="Username">
                                        </div>
                                    </fieldset>
                                    <h3 class="heading-h3 category-name no-margin category-name-mt">
                                        Change Password
                                    </h3>
                                    <hr class="hr-full-width hr-body">
                                    <fieldset>
                                        <div class="settings-row">
                                            <label for="settings-username"> Current Password </label>
                                            <input type="text" class="input" id="settings-username" placeholder="Enter your current password">
                                        </div>
                                        <div class="settings-row">
                                            <label for="settings-username">New Password</label>
                                            <input type="text" class="input" id="settings-location" placeholder="Enter your new password">
                                        </div>
                                        <div class="settings-row">
                                            <label for="settings-username">Re-Type New Password</label>
                                            <input type="text" class="input" id="settings-location" placeholder="Enter your new password once again">
                                        </div>

                                    </fieldset>
                                    <h3 class="heading-h3 category-name no-margin  category-name-mt">
                                        Social Networks
                                    </h3>
                                    <hr class="hr-full-width hr-body">
                                    <fieldset>
                                        <div class="settings-row">
                                            <label for="settings-username">Facebook</label>
                                            <input type="text" class="input" id="settings-username" placeholder="Enter a link to your facebook account">
                                        </div>
                                        <div class="settings-row">
                                            <label for="settings-username">Twitter</label>
                                            <input type="text" class="input" id="settings-location" placeholder="Enter a link to your twitter account">
                                        </div>
                                        <div class="settings-row">
                                            <label for="settings-username">Instagram</label>
                                            <input type="text" class="input" id="settings-location" placeholder="Enter a link to your instagram account">
                                        </div>
                                        <div class="settings-row">
                                            <label for="settings-username">Tumblr</label>
                                            <input type="text" class="input" id="settings-location" placeholder="Enter a link to your tumblr account">
                                        </div>
                                        <div class="settings-row">
                                            <label for="settings-username">Google+</label>
                                            <input type="text" class="input" id="settings-location" placeholder="Enter a link to your google plus account">
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
                                    <a href="#" class="link button button-cta-green contest-button">
									Save changes
								</a>
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
                        <li class="list-element edit-profile-list-element">
                            <div class="flex-wrapper follow-list-item">

                                <div class="flex-wrapper">
                                    <div class="follow-dog-image follow-dog-image-centered  edit-profile-image">
                                        <img src="img/Jenny Doe.png" alt="dog picture">
                                    </div>
                                    <div class="follow-dog-description">
                                        <p class="follow-dog-name follow-dog-name-centered">
                                            Maggie
                                        </p>
                                        <p class="follow-dog-breed ">
                                        </p>
                                        <p class="follow-dog-age">
                                                Florence Ave, Los Angeles, CA
                                        </p>
                                    </div>
                                </div>
                                <div class="follow-list-item-state state-edit">
                                    <button class="link button  follow-cta edit-cta  popup-trigger"  data-popup-id="edit-owner-popup">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </li>
                        <hr class="hr-full-width">
                        <li class="list-element edit-profile-list-element">
                            <div class="flex-wrapper follow-list-item">

                                <div class="flex-wrapper">
                                    <div class="follow-dog-image follow-dog-image-centered  edit-profile-image">
                                        <img src="img/Charley.png" alt="dog picture">
                                    </div>
                                    <div class="follow-dog-description">
                                        <p class="follow-dog-name follow-dog-name-centered">
                                            Charlie
                                        </p>
                                        <p class="follow-dog-breed ">
                                            Labrador Retriever
                                        </p>
                                        <p class="follow-dog-age">
                                            1 year old
                                        </p>
                                    </div>
                                </div>
                                <div class="follow-list-item-state state-edit">
                                    <button  class="link button  follow-cta edit-cta  popup-trigger"  data-popup-id="edit-single-dog-popup">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <hr class="hr-full-width">
                    <a href="#" class="link link-green  block link-custom-add-pet popup-trigger" data-popup-id="edit-single-dog-popup">+ Add another pet</a>
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
                        <div class="flex-wrapper flex-wrapper-jc-space-between">
                            <h3 class="heading heading-h3 follow-heading">Whom to follow</h3>
                            <a href="#" class="link link-green follow-view-all-link">View All</a></div>
                        <hr class="hr  hr-full-width hr-body">
                        <ul class="list follow-dogs">
                            <li class="list-item follow-dog">
                                <div class="flex-wrapper">
                                    <div class="follow-dog-image">
                                        <img src="img/Bailey.png" alt="dog picture">
                                    </div>
                                    <div class="follow-dog-description">
                                        <p class="follow-dog-name">
                                            Bailey
                                        </p>
                                        <p class="follow-dog-breed">
                                            German Shepherd
                                        </p>
                                        <a href="#" class="link link-green follow-dog-follow-link">
										+ Follow
									</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-item follow-dog">
                                <div class="flex-wrapper">
                                    <div class="follow-dog-image">
                                        <img src="img/Maggie.png" alt="dog picture">
                                    </div>
                                    <div class="follow-dog-description">
                                        <p class="follow-dog-name">
                                            Maggie
                                        </p>
                                        <p class="follow-dog-breed">
                                            Siberian Husky
                                        </p>
                                        <a href="#" class="link link-green follow-dog-follow-link">
										+ Follow
									</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-item follow-dog">
                                <div class="flex-wrapper">
                                    <div class="follow-dog-image">
                                        <img src="img/Sophie.svg" alt="dog picture">
                                    </div>
                                    <div class="follow-dog-description">
                                        <p class="follow-dog-name">
                                            Sophie
                                        </p>
                                        <p class="follow-dog-breed">
                                            Poodle
                                        </p>
                                        <a href="#" class="link link-green follow-dog-follow-link">
										+ Follow
									</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-item follow-dog">
                                <div class="flex-wrapper">
                                    <div class="follow-dog-image">
                                        <img src="img/Daisy.png" alt="dog picture">
                                    </div>
                                    <div class="follow-dog-description">
                                        <p class="follow-dog-name">
                                            Daisy
                                        </p>
                                        <p class="follow-dog-breed">
                                            German Shepherd
                                        </p>
                                        <a href="#" class="link link-green follow-dog-follow-link">
										+ Follow
									</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-item follow-dog">
                                <div class="flex-wrapper">
                                    <div class="follow-dog-image">
                                        <img src="img/Molie.png" alt="dog picture">
                                    </div>
                                    <div class="follow-dog-description">
                                        <p class="follow-dog-name">
                                            Molly
                                        </p>
                                        <p class="follow-dog-breed">
                                            Siberian Husky
                                        </p>
                                        <a href="#" class="link link-green follow-dog-follow-link">
										+ Follow
									</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-links">
                        <hr class="hr  hr-full-width hr-body">
                        <div class="flex-wrapper flex-wrapper-jc-space-between">
                            <a href="#" class="link footer-links-link">Privacy</a> <span>-</span>
                            <a href="#" class="link footer-links-link">Terms &amp Conditions </a> <span>-</span>
                            <a href="#" class="link footer-links-link">More</a>
                        </div>
                        <div class="footer-links-copyright">
                            Petsfame &copy 2017
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div id="edit-single-dog-popup" class="popups-wrapper">
        <div class="popup">
            <div class="tile">
                <div class="settings">
                    <form action="change-settings">
                        <h3 class="heading-h3  no-margin tal">
                            Edit profile info
                        </h3>
                        <hr class="hr-full-width hr-body">
                        <div class="profile-edit-image-container">

                            <div class="image-container-default-bg">
                                <img src="./img/photo-camera.svg" alt="" class="image">
                            </div>
                        </div>
                        <fieldset>
                            <div class="settings-row settings-row-half">
                                <input type="text" class="input" id="settings-username" placeholder="Username">
                            </div>
                            <div class="settings-row settings-row-half">
                                <select type="text" class="input" id="breed" >
                                    <option value="Breed">Breed</option>
                                    <option value="Breed">Breed</option>
                                    <option value="Breed">Breed</option>
                                    <option value="Breed">Breed</option>
                                </select>
                            </div>
                            <div class="settings-row settings-row-half">
                                <input type="text" class="input" id="date-of-birth" placeholder="Date of birth">
                            </div>

                            <div class="settings-row settings-row-half">
                                <select type="text" class="input" id="sex" >
                                    <option value="Sex">Sex</option>
                                    <option value="Sex">Male</option>
                                    <option value="Breed">Female</option>
                                </select>
                            </div>

                        </fieldset>
                    </form>
                    <hr class="hr-full-width hr-body">
                    <div class="settings-action-button">
                        <a href="#" class="link link-gray" data-action="close-popup">
                            Cancel
                        </a>
                        <a href="#" class="link button button-cta-green contest-button">
                            Save changes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="edit-owner-popup" class="popups-wrapper">
        <div class="popup">
            <div class="tile">
                <div class="settings">
                    <form action="change-settings">
                        <h3 class="heading-h3  no-margin tal">
                            Edit profile info
                        </h3>
                        <hr class="hr-full-width hr-body">
                        <div class="profile-edit-image-container">
                            <img src="./img/Jenny%20Doe.png" alt="" class="image image-photo-bg">
                            <div class="image-container-default-bg ">
                                <img src="./img/photo-camera.svg" alt="" class="image">
                            </div>
                        </div>
                        <fieldset>
                            <div class="settings-row settings-row-half">
                                <input type="text" class="input" id="name" placeholder="Name">
                            </div>
                            <div class="settings-row settings-row-half">
                                <input type="text" class="input" id="location" placeholder="Location">
                            </div>
                            <div class="settings-row settings-row-with-link">
                                <button class="link link-green tar">Define my location</button>
                            </div>

                        </fieldset>
                    </form>
                    <hr class="hr-full-width hr-body">
                    <div class="settings-action-button">
                        <a href="#" class="link link-gray" data-action="close-popup">
                            Cancel
                        </a>
                        <a href="#" class="link button button-cta-green contest-button">
                            Save changes
                        </a>
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

                            <div class="image-container-default-bg">
                                <img src="./img/photo-camera.svg" alt="" class="image">
                            </div>
                        </div>
                        <fieldset>
                            <div class="settings-row i">
                                <input type="text" class="input input-full-width" id="family-name" placeholder="Family name">
                            </div>

                        </fieldset>
                    </form>
                    <hr class="hr-full-width hr-body">
                    <div class="settings-action-button">
                        <a href="#" class="link link-gray" data-action="close-popup">
                            Cancel
                        </a>
                        <a href="#" class="link button button-cta-green contest-button">
                            Save changes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="add-a-family-popup" class="popups-wrapper">
        <div class="popup" >
            <div class="tile">
                <div class="settings">
                    <form action="change-settings">
                        <h3 class="heading-h3  no-margin tal">
                            New Family
                        </h3>
                        <hr class="hr-full-width hr-body">
                        <h3 class="heading-h3 tac">It looks like you have a family there!</h3>
                        <p class="tac">It looks like you have a family there!

                            Add information about your family.</p>
                        <div class="profile-edit-image-container">

                            <div class="image-container-default-bg">
                                <img src="./img/photo-camera.svg" alt="" class="image">
                            </div>
                        </div>
                        <fieldset>
                            <div class="settings-row">
                                <input type="text" class="input input-full-width" id="family-name" placeholder="Family name">
                            </div>

                            <h3 class="heading-h3  no-margin tal heading-m-t">
                                New Dog
                            </h3>
                            <hr class="hr-full-width hr-body">
                        </fieldset>
                        <div class="profile-edit-image-container">

                            <div class="image-container-default-bg">
                                <img src="./img/photo-camera.svg" alt="" class="image">
                            </div>
                        </div>
                        <fieldset>
                            <div class="settings-row settings-row-half">
                                <input type="text" class="input" id="settings-username" placeholder="Username">
                            </div>
                            <div class="settings-row settings-row-half">
                                <select type="text" class="input" id="breed" >
                                    <option value="Breed">Breed</option>
                                    <option value="Breed">Breed</option>
                                    <option value="Breed">Breed</option>
                                    <option value="Breed">Breed</option>
                                </select>
                            </div>
                            <div class="settings-row settings-row-half">
                                <input type="text" class="input" id="date-of-birth" placeholder="Date of birth">
                            </div>

                            <div class="settings-row settings-row-half">
                                <select type="text" class="input" id="sex" >
                                    <option value="Sex">Sex</option>
                                    <option value="Sex">Male</option>
                                    <option value="Breed">Female</option>
                                </select>
                            </div>

                        </fieldset>
                    </form>
                    <hr class="hr-full-width hr-body">
                    <div class="settings-action-button">
                        <a href="#" class="link link-gray" data-action="close-popup">
                            Cancel
                        </a>
                        <a href="#" class="link button button-cta-green contest-button">
                            Save changes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Optimized loading JS Start -->

    <script>
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
    </script>


    <!-- Optimized loading JS End -->

</body>

</html>
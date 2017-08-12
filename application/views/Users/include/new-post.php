					<div class="newpost">
						<!-- <img src="<?php //echo $photo;?>" alt="" class="newpost-avatar" id="newpost-avatar"> -->
						<form action="comment" class="newpost-form">
							<textarea maxlength="400" rows="1" onkeyup="auto_grow(this)" id="newpost-text" class="newpost-text" placeholder="Share something with your followers"></textarea>
						</form>
						<div class="newpost-active-part hidden">

							<div class="attach hidden">
								<hr class="hr  hr-full-width hr-full-width hr-full-width-exp family-hr">
								<div id="result"></div>
								 <!-- <div class="attach-image">
								 									<img src="img/attach2.png" alt="" class="image ">
								 									<button class="attach-image-close">
								 										<img src="img/red-cross.svg" alt="" class="image">
								 									</button>
								 								</div>
								 								<div class="attach-image">
								 									<img src="img/attach2.png" alt="" class="image ">
								 									<button class="attach-image-close">
								 										<img src="img/red-cross.svg" alt="" class="image">
								 									</button>
								 								</div>  -->
								<div class="attach-image attach-image-placeholder" id="container_image"></div> 
								<script>
								$("#container_image").PictureCut({
									InputOfImageDirectory       : "image",
									PluginFolderOnServer        : "/libs/jQuery-Picture-Cut-master/",
									FolderOnServer              : "/cache/",
									EnableCrop                  : true,
									CropWindowStyle             : "Bootstrap",
									MaximumSize                 : 1024,
									MinimumHeightToResize       : 630
								});
							</script> 
							</div>
							<hr class="hr  hr-full-width hr-full-width hr-full-width-exp family-hr">
							<div class="flex-wrapper flex-wrapper-jc-space-between">
								<div class="flext-wrapper-left-side">
									<button class="link button   button-cta-gray post-button post-button-upload-photos userprofile-edit-button">
										<img src="img/photo.svg" alt="" class="image sub">
										<span>Upload photos</span>
									</button>
									<button class="link button button-cta-gray post-button userprofile-edit-button">
										<img src="img/video.svg" alt="" class="image sub">
										<span>Upload videos</span>
									</button>
								</div>
								<div class="flex-wrapper-right-side flex-wrapper">
									<div class="post-account-menu flex-wrapper">
										<div class="account-image">
											<img src="<?php echo $photo;?>" alt="pet-image" class="image" id="account-image">
										</div>
										<div class="account-dropdown-arrow"></div>
										<div class="tile account-choice-dropdown hidden">
											<p class=" account-choice-dropdown-title">Liking and commenting as:</p>
											<ul class="list follow-dogs">
												<?php require_once "menu/account-choice.php"; ?>
											</ul>
										</div>
									</div>
									<input type="submit" id="send" class="link button button-cta-green contest-button post-button" value="Send" data-user="<?php echo $user_id;?>">
								</div>
							</div>
						</div>
					</div>
					<div class="footer-links">
						<hr class="hr  hr-full-width hr-body">
						<div class="flex-wrapper flex-wrapper-jc-space-between">
							<a href="#" class="link footer-links-link">Privacy</a>   <span>-</span>
							<a href="#" class="link footer-links-link">Terms &amp Conditions </a>     <span>-</span>
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

	<script>
		$( function() {
			$("#datepicker").datepicker({
				autoclose: true, 
				todayHighlight: true
			}).datepicker('update', new Date());
			$("#newdatepicker").datepicker({
				autoclose: true, 
				todayHighlight: true
			}).datepicker('update', new Date());
			
			function mainereadURL(input) { /* превью картинки*/

				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#maine_photo_image').attr('src', e.target.result);
					};

					reader.readAsDataURL(input.files[0]);
				}
			}

			function readURL(input) { /* превью картинки*/

				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#add_image').attr('src', e.target.result);

					};

					reader.readAsDataURL(input.files[0]);
				}
			}

			function familyreadURL(input) { /* превью картинки*/

				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#family_add_image').attr('src', e.target.result);

					};

					reader.readAsDataURL(input.files[0]);
				}
			}

			function petreadURL(input) { /* превью картинки*/

				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#pet_add_image').attr('src', e.target.result);

					};

					reader.readAsDataURL(input.files[0]);
				}
			}

			$("#maine_userfile").change(function(){
				mainereadURL(this);
				$('.imgareaselect-outer').css('display', 'none');
				$('.imgareaselect-selection').parent().css('display', 'none');
				
			});
			$("#family_userfile").change(function(){
				familyreadURL(this);
			});
			$("#pet_userfile").change(function(){
				petreadURL(this);
			});


			$("#add_userfile").change(function(){
				readURL(this);
			});
		} );
		
	</script>
	<div id="add-single-dog-popup" class="popups-wrapper">
		<div class="popup">
			<div class="tile">
				<div class="settings">
					<form id="add_dog" method="post" enctype="multipart/form-data">
						<h3 class="heading-h3  no-margin tal">
							Add profile info
						</h3>
						<hr class="hr-full-width hr-body">
						<div class="profile-edit-image-container">
							<img id="add_image" class="image image-photo-bg" />
							<div class="image-container-default-bg">
								<label class="btn btn-default btn-sm center-block btn-file">
									<img class="image" src="/img/photo-camera.svg" />   
									<i class="fa fa-upload fa-2x" aria-hidden="true"></i>
									<input id="add_userfile" type="file" name="filename" size="5000" style="display: none;">
								</label>
							</div>
						</div>
						<fieldset>
							<div class="settings-row settings-row-half">
								<input type="text" class="input" id="add-username" placeholder="Username">
							</div>
							<div class="settings-row settings-row-half">
								<select type="text" class="input" id="add-breed" >
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
							<div class="settings-row settings-row-half input-group date">
								<input type="text" class="input input-group date" placeholder="Date of birth" id="datepicker" data-date-format="dd-mm-yyyy">
							</div>

							<div class="settings-row settings-row-half">
								<select type="text" class="input" id="add-sex" >
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
						<a href="#" class="link button button-cta-green contest-button" id="add-new-dog">
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
								<img id="family_add_image" class="image image-photo-bg" />
								<div class="image-container-default-bg">
									<label class="btn btn-default btn-sm center-block btn-file">
										<img class="image" src="/img/photo-camera.svg" />   
										<i class="fa fa-upload fa-2x" aria-hidden="true"></i>
										<input id="family_userfile" type="file" name="filename" size="5000" style="display: none;">
									</label>
								</div>
							</div>
							<fieldset>
								<div class="settings-row">
									<input type="text" class="input input-full-width" id="new-family-name" placeholder="Family name">
								</div>

								<h3 class="heading-h3  no-margin tal heading-m-t">
									New Dog
								</h3>
								<hr class="hr-full-width hr-body">
							</fieldset>
							<div class="profile-edit-image-container">
								<img id="pet_add_image" class="image image-photo-bg" />
								<div class="image-container-default-bg">
									<label class="btn btn-default btn-sm center-block btn-file">
										<img class="image" src="/img/photo-camera.svg" />   
										<i class="fa fa-upload fa-2x" aria-hidden="true"></i>
										<input id="pet_userfile" type="file" name="filename" size="5000" style="display: none;">
									</label>
								</div>
							</div>
							<fieldset>
								<div class="settings-row settings-row-half">
									<input type="text" class="input" id="new-username" placeholder="Username">
								</div>
								<div class="settings-row settings-row-half">
									<select type="text" class="input" id="new-breed" >
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
									<input type="text" class="input input-group date" placeholder="Date of birth" id="newdatepicker" data-date-format="dd-mm-yyyy">
								</div>

								<div class="settings-row settings-row-half">
									<select type="text" class="input" id="new-sex" >
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
							<a href="#" class="link button button-cta-green contest-button" id="new_family">
								Save changes
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="post-photo-popup" class="popups-wrapper"></div>
		<div id="maine-photo-popup" class="popups-wrapper">
			<div class="popup popup-photo" >
				<div class="tile">
					<div class="maine-popup-image">
						<img src="img/test-post-image.jpg" alt="" class="image">
					</div>
					<div class="post-popup-details">
						<div class="flex-wrapper">
							<div class="post-dog-image">
								<img src="<?= $user_photo;?>" alt="dog picture">
							</div>
							<div class="post-dog-description">
								<p class="post-dog-name">
									<?= $user_name;?>
								</p>
								<p class="post-dog-time">

								</p>
							</div>
						</div>
						<hr class="hr-full-width hr-body">
						<div class="post-action flex-wrapper flex-wrapper-jc-space-between">
						</div>
					</div>
					<div class="flex-wrapper comment">
					</div>
					<div class="newpost newcomment">

					</div>
				</div>
			</div>
		</div>


		<div id="profile-photo-popup" class="popups-wrapper">
			<div class="popup" >
				<div class="tile">
					<div class="settings">
						<form action="change-settings">
							<div class="settngs-heading col-2">
								<h3 class="heading-h3  no-margin tal">
									Change your profile image
									<!-- <a href="#" class="link button button-cta-green contest-button">Upload image</a> -->
									<label class="link button button-cta-green contest-button info">
										Upload image
										<input class="link button button-cta-green contest-button" value="Upload image" id="maine_userfile" type="file" name="filename" size="5000" style="display: none;" onchange="fileSelectHandler();">

										<input type="hidden" id="x1" name="x1" style="display: none;">
										<input type="hidden" id="y1" name="y1" style="display: none;">
										<input type="hidden" id="x2" name="x2" style="display: none;">
										<input type="hidden" id="y2" name="y2" style="display: none;">
										<input type="hidden" id="w" name="w" style="display: none;">
										<input type="hidden" id="h" name="h" style="display: none;">
									</label>
								</h3>

							</div>
							<hr class="hr-full-width hr-body">
							<p class="tac">Crop the image as you want this to appear on your profile page</p>

							<div class="profile-edit-image-container">

								<div class="image-profile-current">
									<img src="img/photo-camera.svg" alt="" class="image" id="maine_photo_image">
								</div>
							</div>

						</form>
						<hr class="hr-full-width hr-body">
						<div class="settings-action-button">
							<a href="#" class="link link-gray" data-action="close-popup">
								Cancel
							</a>
							<a href="#" class="link button button-cta-green contest-button" id="button_resize">
								Save changes
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>


	</body>
	</html>
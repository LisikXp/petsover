<?php
if (($_SESSION['family']) != null) { ?>
<li class="list-item follow-dog follow-dog-option" id="<?php echo $name;?>">
	<div class="flex-wrapper">
		<div class="follow-dog-image">
			<img src="<?php echo $photo;?>" alt="dog picture" id="follow-dog-image_<?= $name; ?>">
		</div>
		<div class="follow-dog-description">
			<p class="follow-dog-breed">
				<?php echo $name; ?>
			</p>
			<p class="follow-dog-breed">

			</p>
		</div>
	</div>
</li>
<?php $family->get_family_choice(); ?>
<li class="list-item follow-dog follow-dog-option" id="<?php echo $owner_name; ?>">
	<div class="flex-wrapper">
		<div class="follow-dog-image">
			<img src="<?php echo $owner_photo; ?>" alt="dog picture" id="follow-dog-image_<?php echo $owner_name; ?>">
		</div>
		<div class="follow-dog-description">
			<p class="follow-dog-breed">
				<?php echo $owner_name; ?>
			</p>
			<p class="follow-dog-breed">
				Owner
			</p>
		</div>
	</div>
</li>

<?php } else { ?>

<li class="list-item follow-dog follow-dog-option" id="<?php echo $name;?>">
	<div class="flex-wrapper">
		<div class="follow-dog-image">
			<img src="<?php echo $photo;?>" alt="dog picture" id="follow-dog-image_<?= $name; ?>">
		</div>
		<div class="follow-dog-description">
			<p class="follow-dog-breed">
				<?php echo $name; ?>
			</p>
			<p class="follow-dog-breed">

			</p>
		</div>
	</div>
</li>
<li class="list-item follow-dog follow-dog-option" id="<?php echo $owner_name; ?>">
	<div class="flex-wrapper">
		<div class="follow-dog-image">
			<img src="<?php echo $owner_photo; ?>" alt="dog picture" id="follow-dog-image_<?php echo $owner_name; ?>">
		</div>
		<div class="follow-dog-description">
			<p class="follow-dog-breed">
				<?php echo $owner_name; ?>
			</p>
			<p class="follow-dog-breed">
				Owner
			</p>
		</div>
	</div>
</li>

<?php } ?>
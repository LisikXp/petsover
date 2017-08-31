<?php

if ($network_link['facebook']) {?>

<a href="<?= $network_link['facebook'];?>" class="link link-black">
	<div class="pic"><img src="/img/facebook_icon.svg"></div>
	Facebook
</a>

<?php } 
if ($network_link['twitter']) { ?>

<a href="<?= $network_link['twitter'];?>" class="link link-black">
	<div class="pic"><img src="/img/twitter_icon.svg"></div>
	Twitter
</a>

<?php } 
if ($network_link['google']) { ?>
<a href="<?= $network_link['google'];?>" class="link link-black">
	<div class="pic"><img src="/img/google_plus_icon.png"></div>
	Google Plus
</a>


<?php } ?>

<!-- <div class="owner-contacts-fb">
	<a href="<?= $network_link['facebook'];?>" class="link link-black">/jennydoe</a>
</div>
<div class="owner-contacts-tw">
	<a href="<?= $network_link['twitter'];?>" class="link link-black">/j.doe</a>
</div>
<div class="owner-contacts-gp">
	<a href="<?= $network_link['google'];?>" class="link link-black">/jenny</a>
</div> -->
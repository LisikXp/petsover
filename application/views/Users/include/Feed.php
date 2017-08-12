<?php require_once "header/header-singl.php";?>
<main class="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-3  col-sm-3-custom-left">
				
				<?php require_once "sidebar/sidebar.php"; ?>
				
			</div>
			<div class="col-sm-6 col-sm-6-custom">
				<?php if ($get_id == $mypage) {?>
				<div class=" tile"><?php
					require_once "new-post.php";?>
				</div> 
				<?php	} ?>

				<ul class="my_feed_list" id="user_wall" data-user="<?= $get_id;?>">
					<?php
					$feed->get_follow_id();
					?>
				</ul>
				<?php if ($feed->get_count_feedpost() <= 20 ) {?>

				<?php } else { ?>

				<button class="link link-green tac block view_more_post" id="view_more_post" data-count="<?php echo $feed->get_count_feedpost();?>">View more</button>
				<hr class="hr-full-width">
				<?php } ?>
			</div>
			<div class="col-sm-3 col-sm-3-custom-right">
				<?php require_once "contest/contest-main.php"; ?>
				<div class="banner">
					<img src="http://via.placeholder.com/270x240" alt="" class="banner-content">
				</div>
				<div class="follow">
					<?php require_once "tofollow/follow-dogs.php"; ?>
				</div>

				<?php require_once "footer.php"; ?>
				
				<script>
					$(document).ready(function() {
						function dhtmlLoadScript(url)
						{
							var e = document.createElement("script");
							e.src = url;
							e.type="text/javascript";
							document.getElementsByTagName("head")[0].appendChild(e); 
						}
						get_feedcount();
						function get_feedcount(){
							var data =  new FormData();
							data.append("autofeed", 'true');

							$.ajax({
								url: "setpost",
								type: "POST",
								data: data,
								async: true, 
								cache: false,
								processData: false,
								contentType: false,
								success: function (data) {
									$('.my_feed_list').empty();
									$('.my_feed_list').append(data);
									
									pool_event();
									dhtmlLoadScript("https://cdn.jsdelivr.net/sharer.js/latest/sharer.min.js");
									setTimeout(
										get_feedcount, 
										10000 
										);
								}
							});

						}
						var imageKey,
						picturesArray,
						picturesArrayCount;
						function rollImages(imagesClass) {
							$(imagesClass).each(function(key, item) {
								if ($(this).hasClass('current')) {
									imageKey = key + 1;
									return false;
								}
							});
						}

						$(document).on('click', '.post-images-container.multiple-images > img', function(){
							var self = $(this);
							var url = self.attr('src');
							self.addClass('current');
							picturesArray = self.parent().find('img');
							rollImages(picturesArray);
							picturesArrayCount = picturesArray.length;
        //console.log(picturesArray.length);
        $('#post-photo-popup').addClass('flex-wrapper img-gallery').find('.post-popup-image>img').attr('src', url);
        $('#post-photo-popup').find('.post-popup-image').removeClass('last first');
        if (picturesArrayCount == imageKey){
        	$('#post-photo-popup').find('.post-popup-image').addClass('last');
        }
        else if(imageKey == 1){
        	$('#post-photo-popup').find('.post-popup-image').addClass('first');
        }
        $('body').css('overflow-y','hidden');

    });

						$('#post-photo-popup').on('click', '.post-popup-image', function(e){
							if($('.img-gallery').length){
            //Determining if mouse click happened in left or right half of image
            var pWidth = $(this).innerWidth();
            var pOffset = $(this).offset();
            var x = e.pageX - pOffset.left;
            if(pWidth/2 > x){
            	if(imageKey != 1){
            		$('img').removeClass('current');
            		imageKey = imageKey - 1;
            		$(picturesArray[imageKey]).addClass('current');
            		$(this).find('img').attr('src', $(picturesArray[imageKey-1]).attr('src'));
            		$('#post-photo-popup').find('.post-popup-image').removeClass('last first');

            	}
            	else{
            		$('#post-photo-popup').find('.post-popup-image').addClass('first');

            	}
            }
            else{
            	if (picturesArrayCount > imageKey){
            		$('img').removeClass('current');
            		imageKey = imageKey + 1;
            		$(picturesArray[imageKey]).addClass('current');
            		$(this).find('img').attr('src', $(picturesArray[imageKey-1]).attr('src'));
            		$('#post-photo-popup').find('.post-popup-image').removeClass('last first');
            	}
            	else{
            		$('#post-photo-popup').find('.post-popup-image').addClass('last');
            	}
            }
        }
    });


					});
				</script>

/*-----remove post-----*/

var remove_post = {};
$(document).on('click','#remove_post', function() {
	var parid = this.parentNode.parentNode.parentNode.id;
	//alert(parid);
	var data =  new FormData();
	data.append("remove_post", "true");
	data.append("remove_post_id", parid);
	$.ajax({
		url: "setpost",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			console.log(data);
			remove_post[parid] = data;
		}
	});
	//$(".wall_posts_" + parid).remove();
	$(".wall_posts_" + parid).children().css('display', 'none');
	$(".wall_posts_" + parid).append('<a href="#" class="link-blue no-margin undo_remove">Undo removing</a>');
});
/*-----end post-----*/

/*-----undo_remove post-----*/
$(document).on('click','.undo_remove', function() {
	var parid = this.parentNode.id;
	var data =  new FormData();
	data.append("undo_removing_post", "true");
	data.append("undo_remove_post_id", remove_post[parid]);
	$.ajax({
		url: "setpost",
		type: "POST",
		data: data,
		processData: false,
		contentType: false,
		success: function (data) {
			delete remove_post[parid];
			$(".wall_posts_" + parid).children().css('display', 'block');

		}

	});
	this.remove();
});
/*-----end post-----*/
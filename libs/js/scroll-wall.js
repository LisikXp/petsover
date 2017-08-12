
$(window).scroll(function(){
	var scroll_start = 0;
	var scroll_limit = 20;
	var scroll_max = $('#user_wall').data('count');
	if (scroll_max > 20 && scroll_limit <= scroll_max) {
		if((($(window).scrollTop()+$(window).height())+200)>=$(document).height()){
			var scroll_uid = $('#user_wall').data('user');
			scroll_start = scroll_start + 20;
			scroll_limit = scroll_limit + 20;
			alert(scroll_max + ', ' + scroll_start + ', ' + scroll_limit);
/*			var data =  new FormData();
			data.append("more_scroll", "true");
			data.append("scroll_start", scroll_start);
			data.append("scroll_limit", scroll_limit);
			data.append("scroll_uid", scroll_uid);

			$.ajax({
				url: "setpost",
				type: "POST",
				data: data,
				processData: false,
				contentType: false,
				success: function (data) {
					$('#user_wall').append(data);
				}

			});*/
		}
	}
});
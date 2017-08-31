function clear_show(thiss){

	if (thiss.value == 0) {
		$("#search-list").empty();
		$('.search-block').css('display', 'none');
	} else {
		//console.log(thiss.value)/Discover?search=<?php echo $namesearch; ?>
		var data =  new FormData();
		data.append("search_main", "true");
		data.append("search_val", thiss.value);
		
		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			success: function (data) {
				//console.log(data.length);
				if (data.length <= 2) {
					$('.search-block').css('display', 'block');
					$('#wiev_all_search').css('display', 'none');
					$('#search-list').html('<span class="no-result-sserch">no results</span>');
				} else {
					$('#wiev_all_search').css('display', 'block');
					$('.search-block').css('display', 'block');
					$('#search-list').html(data);
				}
			}

		});

	}
}

$(document).on('click', '#btn-serch-header', function(e){
	var txt = $('#search').val();
	var url = "/Discover?search="+txt;
	$(location).attr('href',url);
});

$(document).on('keyup', '#search', function(event){
	var blah = $(this).val();
	
	if(event.keyCode == 13 && !event.shiftKey && this.value.trim().length != 0){
		var url = "/Discover?search="+blah;
		$(location).attr('href',url);
	}
});

function search_by_keyword(thiss){
	if (thiss.value == 0) {

		var data =  new FormData();
		data.append("search_keyword_clear", "true");

		
		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			success: function (data) {
				//console.log(data);
				$('#discover_list').html(data);
				$('#discover_view').show();
				$('.category-list > li').removeClass('filter-category');
			}

		});

	} else {
		
		var data =  new FormData();
		data.append("search_keyword", "true");
		data.append("search_key_val", thiss.value);
		
		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			success: function (data) {
				//console.log(data);
				$('#discover_list').html(data);
				$('#discover_view').hide();
			}

		});
/*
		var data =  new FormData();
		data.append("search_keyword_count", "true");
		data.append("search_key_valu", thiss.value);
		$.ajax({
			url: "/application/Request/setpost.php",
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			success: function (data) {
				console.log(data);
				$('#discover_view').attr('data-count', data);
			}

		});*/

	}
}
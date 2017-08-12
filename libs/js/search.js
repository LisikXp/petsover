function clear_show(thiss){

	if (thiss.value == 0) {
		//$("#show_auto_select_table").empty();
	} else {
		//console.log(thiss.value)
		var data =  new FormData();
		data.append("search_main", "true");
		data.append("search_val", thiss.value);
		
		$.ajax({
			url: "setpost",
			type: "POST",
			data: data,
			processData: false,
			contentType: false,
			success: function (data) {
				console.log(data);
				
			}

		});
	}
}
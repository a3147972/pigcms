function list_location(obj){
	close_dropdown();
	
	if(obj.attr('data-category-id')){
		now_cat_url = obj.attr('data-category-id');
	}else if(obj.attr('data-area-id')){
		now_area_url = obj.attr('data-area-id');
	}else if(obj.attr('data-sort-id')){
		now_sort_id = obj.attr('data-sort-id');
	}
	var go_url = location_url;
	if(now_cat_url != '-1'){
		go_url += "&cat_url="+now_cat_url;
	}
	if(now_area_url != '-1'){
		go_url += "&area_url="+now_area_url;
	}
	if(now_sort_id != 'defaults'){
		go_url += "&sort_id="+now_sort_id;
	}
	
	$('.deal-container .loading').removeClass('hide');
	
	window.location.href = go_url;
}
jQuery(function( $ ) {
	'use strict';

	$(".reveal_image_btn").on("click", function(){
		let wrapp = $(this).parents(".image_reveal");
		let ln = wrapp.find('.reveal_images').children().length;
		let current = wrapp.find('.reveal_images').find(".rev_img.active");
		current.removeClass('active');
		current.next().addClass("active");
		
		$(this).attr("data-reveald", parseInt($(this).attr("data-reveald"))+1);
		
		if(parseInt($(this).attr("data-reveald")) === ln){
			$(this).hide();
		}
	});
	
});

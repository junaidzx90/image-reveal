jQuery(function( $ ) {
	'use strict';

	function loadImages() {
		let imges, selectedFile;
		// If the frame already exists, re-open it.
		if ( imges ) {
			imges.open();
			return;
		}
		//Extend the wp.media object
		imges = wp.media.frames.file_frame = wp.media({
			title: 'Choose Images',
			button: {
				text: 'Upload'
			},
			multiple: true
		});

		//When a file is selected, grab the URL and set it as the text field's value
		imges.on('select', function() {
			if($('.reveal_images').find(".imagebox").length === 0){
				$('.reveal_images').html("");
			}
			selectedFile = imges.state().get('selection');
			selectedFile.forEach(element => {
				let image = element.toJSON();
				$('.reveal_images').append(`<div class="imagebox">
					<span class="removeImg">+</span>
					<img src="${image.url}">
					<input type="hidden" name="reveal_images[]" value="${image.url}">
				</div>`);
			});
		});

		//Open the uploader dialog
		imges.open();
	}

	$('.add_image').on("click", (e)=>{
		e.preventDefault();
		loadImages();
	});

	$(document).on("click", ".removeImg", function(){
		$(this).parent(".imagebox").remove();
	})

});

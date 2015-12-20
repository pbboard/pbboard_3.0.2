/* *
 * @Project NUKEVIET JWPLAYER6 HTML5
 * @Author PHAN TAN DUNG (phantandung92@gmail.com)
 * @Copyright (C) 2014 PHAN TAN DUNG. All rights reserved
 * @Createdate 30/11/2014, 00:00:00 GMT
 */

$(document).ready(function(){
	var countVideo = 0;
	
	$.each( $('.jwplayer-html5-item'), function(){
		countVideo ++;
		
		$(this).html('<div id="html5-video-' + countVideo + '"></div>');
		
		jwplayer('html5-video-' + countVideo).setup({
			file: $(this).attr('data-url'),
			image: $(this).attr('data-image'),
			width: $(this).attr('data-width'),
			height: $(this).attr('data-height'),
			autostart: $(this).attr('data-auto'),
		});
	});
});
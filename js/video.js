var $v = jQuery.noConflict();
function videoResolutionSelection( p, type ){
	if( type == 'low' ){
		$v('#archive-res-sel-high-'+p).removeClass('active');
		$v('#archive-res-sel-low-'+p).addClass('active');
	} else if( type == 'high' ) {
		$v('#archive-res-sel-low-'+p).removeClass('active');
		$v('#archive-res-sel-high-'+p).addClass('active');
	}
	$v.ajax({
	  method: "POST",
	  dataType: 'json',
	  data: { option: 'videoDataProcessFront', post_id: p, type: type },
	  beforeSend: function() {
    	$v('#video-archive-download-link-'+p).attr('href', '#');
  	  }
	})
	.done(function( data ) {
		$v('#video-archive-download-link-'+p).attr('href', data.download_link);
		if( data.video != false ){
			$v('#video-player-single-'+p).html(data.video);
		}
		if( data.video_size != false ){
			$v('#video-size-'+p).html(data.video_size);
		}
	});
}
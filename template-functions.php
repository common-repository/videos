<?php

function video_single_template( $single ) {
    global $post;
    if ( $post->post_type == 'video' ) {
		$template_file = 'single-video.php';
		if ( file_exists( TEMPLATEPATH . '/' . VIDEO_TEMPLATE_DIR_NAME . '/' . $template_file ) ) {
             return TEMPLATEPATH . '/' . VIDEO_TEMPLATE_DIR_NAME . '/' . $template_file;
        } else {
			if ( file_exists( VIDEO_DIR_PATH . '/templates/' . $template_file ) ) {
				return VIDEO_DIR_PATH . '/templates/' . $template_file;
			}
		}
    }
    return $single;
}

function video_archive_template( $single ) {
    global $post;
    if ( $post->post_type == 'video' ) {
		$template_file = 'archive-video.php';
		if ( file_exists( TEMPLATEPATH . '/' . VIDEO_TEMPLATE_DIR_NAME . '/' . $template_file ) ) {
             return TEMPLATEPATH . '/' . VIDEO_TEMPLATE_DIR_NAME . '/' . $template_file;
        } else {
			if ( file_exists( VIDEO_DIR_PATH . '/templates/' . $template_file ) ) {
				return VIDEO_DIR_PATH . '/templates/' . $template_file;
			}
		}
    }
    return $single;
}

function get_the_video( $post_id ){
	$video_data = get_video_file( $post_id );
	if( $video_data['type'] == 'public' ){
		$video = video_player( $video_data['file'] );
		return $video;
	} else {
		return get_archive_video_thumb( $post_id );
	}
	return false;
}

function the_video( $post_id ){
	$video = get_the_video( $post_id );
	include( VIDEO_DIR_PATH . '/view/front/video-player-single.php' );
}

function get_archive_video_thumb( $post_id ){
	if(!$post_id){
		return false;
	}
	ob_start();
	
	$video_sample_file = get_video_sample_file($post_id);
	if( $video_sample_file != false ){ // video has a sample video 
		$video = $video_sample_file['file'];
		include( VIDEO_DIR_PATH . '/view/front/video-archive-sample-video.php' );
	} else {
		// now check video has a featured image 
		$featured_image = get_the_post_thumbnail_url($post_id);	
		if( $featured_image ){ // video has a featured image 
			include( VIDEO_DIR_PATH . '/view/front/video-archive-featured-image.php' );
		} else {
			include( VIDEO_DIR_PATH . '/view/front/video-archive-default-image.php' );
		}
	}
	
	$data = ob_get_contents();
	ob_end_clean();
	return $data;
}

function video_archive_resolution_selection( $post_id ){
	if(!$post_id){
		return false;
	}
	$video_data = get_video_file( $post_id );
	$video_data_high_res = get_video_high_res_file( $post_id );
	$download_status = is_video_download_enabled($post_id);
	
	if( $download_status['status'] == true ){
		include( VIDEO_DIR_PATH . '/view/front/video-archive-resolution-selection.php' );
	}
}

function video_download_link( $post_id ){
	$download_status = is_video_download_enabled($post_id);
	if( $download_status['status'] == true ){
		include( VIDEO_DIR_PATH . '/view/front/video-download-link.php' );
	} else {
		include( VIDEO_DIR_PATH . '/view/front/video-download-false.php' );
	}
}

function video_archive_download_link( $post_id ){
	$download_status = is_video_download_enabled($post_id);
	if( $download_status['status'] == true ){
		include( VIDEO_DIR_PATH . '/view/front/video-archive-download-link.php' );
	} else {
		include( VIDEO_DIR_PATH . '/view/front/video-download-false.php' );
	}
}

function video_duration( $post_id ){
	$video_file_duration = get_post_meta( $post_id, 'video_file_duration', true );
	if( $video_file_duration ){
		include( VIDEO_DIR_PATH . '/view/front/video-duration.php' );
	}
}

function video_size( $post_id, $type = '' ){
	$video_size = get_video_file_size($post_id, $type);
	if( $video_size ){
		include( VIDEO_DIR_PATH . '/view/front/video-size.php' );
	}
}

function the_relative_videos( $post_id = '' ){
	if($post_id == ''){
		global $post;
		$post_id = $post->ID;
	}
	$args = get_relative_video_args( $post_id );
	include( VIDEO_DIR_PATH . '/view/front/relative-videos.php' );
}

function the_all_videos( $search_form ){
	$args = get_all_video_args();
	if($search_form){
		the_videos_search();
	}
	include( VIDEO_DIR_PATH . '/view/front/all-videos.php' );
}

function the_videos_search(){
	include( VIDEO_DIR_PATH . '/view/front/videos-search.php' );
}
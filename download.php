<?php

add_action( 'init', 'video_force_download' );

function video_force_download(){
	
	if( isset($_REQUEST['vopt']) and video_download_decode( sanitize_text_field( $_REQUEST['vopt'] ) ) == 'download' ){
		set_time_limit(0);

		$post_id = video_download_decode( sanitize_text_field( $_REQUEST['pid'] ), true );
		
		$download_status = is_video_download_enabled($post_id);
		if( $download_status['status'] == false ){
			wp_die('Error');
		}
		
		$video_data = get_video_file( $post_id );
		if( $video_data == false ){
			wp_die('Error');
		}
		
		$upload_dir = wp_upload_dir();
		$video_file = $video_data['file'];
		
		if( $video_data['type'] != 'public' ){
			wp_die('Error');
		}
		
		$video_dir = $upload_dir['basedir'] . '/' . VIDEO_UPLOAD_DIR_NAME;
		$video_file_path = $video_dir . '/' . $video_file;
		
		if( !$video_file_path ){
			wp_die('Error');
		}
		
		header("Content-type: octet/stream");
		header("Content-disposition: attachment; filename=".basename($video_file_path).";");
		header("Content-Length: ".filesize($video_file_path));
		readfile($video_file_path);
		exit;
	}
	
	if( isset($_REQUEST['vopt']) and video_download_decode( sanitize_text_field( $_REQUEST['vopt'] ) ) == 'download_high' ){
		set_time_limit(0);

		$post_id = video_download_decode( sanitize_text_field( $_REQUEST['pid'] ), true );
		
		$download_status = is_video_download_enabled($post_id);
		if( $download_status['status'] == false ){
			wp_die('Error');
		}
		
		$video_data = get_video_high_res_file( $post_id );
		if( $video_data == false ){
			wp_die('Error');
		}
		
		$upload_dir = wp_upload_dir();
		$video_file = $video_data['file'];
		
		if( $video_data['type'] != 'public' ){
			wp_die('Error');
		}
		
		$video_dir = $upload_dir['basedir'] . '/' . VIDEO_UPLOAD_DIR_NAME;
		$video_file_path = $video_dir . '/' . $video_file;
		
		if( !$video_file_path ){
			wp_die('Error');
		}
		
		header("Content-type: octet/stream");
		header("Content-disposition: attachment; filename=".basename($video_file_path).";");
		header("Content-Length: ".filesize($video_file_path));
		readfile($video_file_path);
		exit;
	}
	
	if( isset($_REQUEST['vopt']) and video_download_decode( sanitize_text_field( $_REQUEST['vopt'] ) ) == 'download_admin' ){
		set_time_limit(0);
		
		$post_id = video_download_decode( sanitize_text_field( $_REQUEST['pid'] ), true );
		
		// check if admin
		if ( !current_user_can( 'manage_options' ) ) {
			wp_die('Error');
		}
		
		$video_data = get_video_file( $post_id );
		if( $video_data == false ){
			wp_die('Error');
		}
		
		$upload_dir = wp_upload_dir();
		
		$video_file = $video_data['file'];
		
		if( $video_data['type'] != 'public' ){
			wp_die('Error');
		}
		
		$video_dir = $upload_dir['basedir'] . '/' . VIDEO_UPLOAD_DIR_NAME;
		$video_file_path = $video_dir . '/' . $video_file;
		
		if( !$video_file_path ){
			wp_die('Error');
		}
		
		header("Content-type: octet/stream");
		header("Content-disposition: attachment; filename=".basename($video_file_path).";");
		header("Content-Length: ".filesize($video_file_path));
		readfile($video_file_path);
		exit;
	}
	
	if( isset($_REQUEST['vopt']) and video_download_decode( sanitize_text_field( $_REQUEST['vopt'] ) ) == 'download_admin_high' ){
		set_time_limit(0);
		
		$post_id = video_download_decode( sanitize_text_field( $_REQUEST['pid'] ), true );
		
		// check if admin
		if ( !current_user_can( 'manage_options' ) ) {
			wp_die('Error');
		}
		
		$video_data = get_video_high_res_file( $post_id );
		if( $video_data == false ){
			wp_die('Error');
		}
		
		$upload_dir = wp_upload_dir();
		
		$video_file = $video_data['file'];
		
		if( $video_data['type'] != 'public' ){
			wp_die('Error');
		}
		
		$video_dir = $upload_dir['basedir'] . '/' . VIDEO_UPLOAD_DIR_NAME;
		$video_file_path = $video_dir . '/' . $video_file;
		
		if( !$video_file_path ){
			wp_die('Error');
		}
		
		header("Content-type: octet/stream");
		header("Content-disposition: attachment; filename=".basename($video_file_path).";");
		header("Content-Length: ".filesize($video_file_path));
		readfile($video_file_path);
		exit;
	}
	
	if( isset($_REQUEST['vopt']) and video_download_decode( sanitize_text_field( $_REQUEST['vopt'] ) ) == 'download_admin_sample' ){
		set_time_limit(0);
		
		$post_id = video_download_decode( sanitize_text_field( $_REQUEST['pid'] ), true );
		
		// check if admin
		if ( !current_user_can( 'manage_options' ) ) {
			wp_die('Error');
		}
		
		$video_data = get_video_sample_file( $post_id );
		if( $video_data == false ){
			wp_die('Error');
		}
		
		$upload_dir = wp_upload_dir();
		
		$video_file = $video_data['file'];
		$video_dir = $upload_dir['basedir'] . '/' . VIDEO_UPLOAD_DIR_NAME;
		$video_file_path = $video_dir . '/' . $video_file;		
		
		if( !$video_file_path ){
			wp_die('Error');
		}
		
		header("Content-type: octet/stream");
		header("Content-disposition: attachment; filename=".basename($video_file_path).";");
		header("Content-Length: ".filesize($video_file_path));
		readfile($video_file_path);
		exit;
	}
	
}
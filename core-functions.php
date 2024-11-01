<?php

function video_text_domain(){
	load_plugin_textdomain('videos', FALSE, basename( dirname( __FILE__ ) ) .'/languages');
}

function get_video_file( $post_id ){
	if(!$post_id){
		return false;
	}
	global $wpdb;
	$sql = $wpdb->prepare( "SELECT v_file, v_file_type FROM `".$wpdb->base_prefix."video_files` WHERE blog_id = %d AND post_id = %d", get_current_blog_id(), $post_id );
	$data = $wpdb->get_row( $sql );
	if( $data and $data->v_file != '' ){
		return array( 'file' => $data->v_file, 'type' => $data->v_file_type );
	}
	return false;	
}

function get_video_high_res_file( $post_id ){
	if(!$post_id){
		return false;
	}
	global $wpdb;
	$sql = $wpdb->prepare( "SELECT v_file_high, v_file_type FROM `".$wpdb->base_prefix."video_files` WHERE blog_id = %d AND post_id = %d", get_current_blog_id(), $post_id );
	$data = $wpdb->get_row( $sql );
	if( $data and $data->v_file_high != '' ){
		return array( 'file' => $data->v_file_high, 'type' => $data->v_file_type );
	}
	return false;	
}

function get_video_sample_file( $post_id ){
	if(!$post_id){
		return false;
	}
	global $wpdb;
	$sql = $wpdb->prepare( "SELECT v_file_sample FROM `".$wpdb->base_prefix."video_files` WHERE blog_id = %d AND post_id = %d", get_current_blog_id(), $post_id );
	$data = $wpdb->get_row( $sql );
	if( $data and $data->v_file_sample != '' ){
		return array( 'file' => $data->v_file_sample );
	}
	return false;	
}

function video_player( $file ){
	if(!$file){
		return false;
	}
	$upload_dir = wp_upload_dir();
	$video_dir = $upload_dir['baseurl'] . '/' . VIDEO_UPLOAD_DIR_NAME;
	$video_file_path = $video_dir . '/' . $file;
	return do_shortcode( '[video src="'.$video_file_path.'"]' );
}

function get_video_download_link( $post_id, $type = 'low' ){
	if( $type == 'high' ){
		$link = 'vopt='.video_download_encode('download_high').'&pid='.video_download_encode($post_id);
	} else {
		$link = 'vopt='.video_download_encode('download').'&pid='.video_download_encode($post_id);
	}
	if ( get_option('permalink_structure') ) { 
		$download_link = site_url( '/?' . $link );
	} else {
		$download_link = site_url('/&' . $link );
	}
	return $download_link;
}

function get_video_download_link_admin( $post_id, $sample = false, $type = 'low' ){
	if( $sample === true ){
		$link = 'vopt='.video_download_encode('download_admin_sample').'&pid='.video_download_encode($post_id);
	} else {
		if( $type == 'high' ){
			$link = 'vopt='.video_download_encode('download_admin_high').'&pid='.video_download_encode($post_id);
		} else {
			$link = 'vopt='.video_download_encode('download_admin').'&pid='.video_download_encode($post_id);
		}
	}
	if ( get_option('permalink_structure') ) { 
		$download_link = site_url( '/?' . $link );
	} else {
		$download_link = site_url('/&' . $link );
	}
	return $download_link;
}

function is_video_download_enabled( $post_id ){
	$video_enable_d_link = get_option( 'video_enable_d_link' );
	
	$video_data = get_video_file( $post_id );
	$video_data_high_res = get_video_high_res_file( $post_id );
	if( $video_data == false && $video_data_high_res == false ){
		return array( 'status' => false, 'error' => 'video_not_found' );
	}
	// if here then we have video data 
	
	if( $video_enable_d_link != 'yes' ){
		return array( 'status' => false, 'error' => 'video_download_disabled' );
	} else{
		return array( 'status' => true );
	}
}

function get_video_file_size( $post_id, $type = '' ){
	if(!$post_id){
		return false;
	}
	$dir_path = '';
	if( $type == 'high' ){
		$video_data = get_video_high_res_file( $post_id );
		$upload_dir = wp_upload_dir();
		if( $video_data['type'] == 'public' ){
			$dir_path = $upload_dir['basedir'] . '/' . VIDEO_UPLOAD_DIR_NAME;
		}
	} else {
		$video_data = get_video_file( $post_id );
		$upload_dir = wp_upload_dir();
		if( $video_data['type'] == 'public' ){
			$dir_path = $upload_dir['basedir'] . '/' . VIDEO_UPLOAD_DIR_NAME;
		}
	}
	if( file_exists( $dir_path . '/' . $video_data['file'] ) ){
		return video_file_size( filesize( $dir_path . '/' . $video_data['file'] ) );
	} else {
		return false;
	}
}

function video_cur_page_url() {
	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"]) and $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if (isset($_SERVER["SERVER_PORT"]) and $_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

function get_relative_video_args( $post_id ){
	$tags = wp_get_post_terms( $post_id, 'video_tag', array( 'fields' => 'ids' ) );
	$args = array(
		'post_type' => 'video',
		'post__not_in' => array( $post_id ),
		'posts_per_page' => 3,
	);
	
	if( $tags ){
		$args['tax_query'] = array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'video_tag',
				'field' => 'term_id',
				'terms' => $tags
			)
		);
	}
	return $args;
}

function get_all_video_args(){
	$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
	$args = array(
		'post_type' => 'video',
		'paged'	=> $paged,
	);
	if( isset($_REQUEST['vsrch_adv']) ){
		$search = sanitize_text_field( $_REQUEST['vsrch_adv'] );
		$args['s'] = $search;
	}
	return $args;
}
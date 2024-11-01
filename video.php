<?php
/*
Plugin Name: Videos
Plugin URI: https://wordpress.org/plugins/videos/
Description: Upload video files (MP4) and display in frontend for users to view and download. Videos can be categorized into different categories. Tags are also supported. 
Version: 1.0.5
Text Domain: videos
Domain Path: /languages
Author: aviplugins.com
Author URI: https://www.aviplugins.com/
*/

/**
	  |||||   
	<(`0_0`)> 	
	()(afo)()
	  ()-()
**/

define( 'VIDEO_DIR_NAME', 'videos' );
define( 'VIDEO_DIR_PATH', dirname( __FILE__ ) );
define( 'VIDEO_TEMPLATE_DIR_NAME', 'video' );
define( 'VIDEO_UPLOAD_DIR_NAME', 'videos' );

function video_plug_install(){
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'videos-pro/video.php' ) ) {
	 	wp_die('It seems you have <strong>Videos PRO</strong> plugin activated. Please deactivate to continue.');
		exit;
	}
	
	include_once VIDEO_DIR_PATH . '/autoload.php';
	new Video_Autoload;
	new Video_Settings;
	new Video_Post_Class;
	new Video_Custom_Tax_Class;
	new Video_Scripts;
	new Video_Data_Process_Class;
	new Video_Data_Process_Front_Class;
}

class Video_Plugin_Init {
	function __construct() {
		video_plug_install();
	}
}
new Video_Plugin_Init;

register_activation_hook( __FILE__, 'video_plugin_activation' );

function video_plugin_activation(){

	global $wpdb;
	
	$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->base_prefix."video_files` (
	  `v_id` int(11) NOT NULL AUTO_INCREMENT,
	  `blog_id` int(11) NOT NULL,
	  `post_id` int(11) NOT NULL,
	  `v_file` varchar(255) NOT NULL,
	  `v_file_sample` varchar(255) NOT NULL,
	  `v_file_type` ENUM('public','private') NOT NULL DEFAULT 'public' ,
	  PRIMARY KEY (`v_id`)
	)");	
	
	// after version 1.0.2 //
	$old_table = $wpdb->get_row("SHOW COLUMNS FROM `".$wpdb->base_prefix."video_files` WHERE field = 'v_file_high'", ARRAY_A);
	if(!is_array($old_table)){
		$wpdb->query("ALTER TABLE `".$wpdb->base_prefix."video_files` ADD `v_file_high` VARCHAR(255) NOT NULL AFTER `v_file`");	
	}
	// after version 1.0.2 //
	
	// create video dir if not exists
	$upload_dir = wp_upload_dir();
	$video_dir = $upload_dir['basedir'] . '/' . VIDEO_UPLOAD_DIR_NAME;
	
	if (!is_dir( $video_dir )) {
		mkdir( $video_dir );
		chmod( $video_dir, 0777 ); 
	}	
	
	// protect the dir 
	$ht = fopen( $video_dir . '/' . ".htaccess", 'w' );
	fwrite( $ht, "#" );
	fclose( $ht );

}

add_action( 'plugins_loaded', 'video_text_domain' );
add_action( 'widgets_init', function(){ register_widget( 'Video_Search_Widget' ); } );
add_action( 'widgets_init', function(){ register_widget( 'Video_Category_Widget' ); } );
add_action( 'widgets_init', function(){ register_widget( 'Video_Tag_Widget' ); } );

add_filter( 'single_template', 'video_single_template' );
add_filter( 'archive_template', 'video_archive_template' );

add_shortcode( 'videos', 'ap_videos_shortcode' );
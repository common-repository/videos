<?php
class Video_Scripts {
	
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'front_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}	
	
	public function admin_scripts(){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'ap.cookie', plugins_url( VIDEO_DIR_NAME . '/js/ap.cookie.js' ) );
		wp_enqueue_script( 'ap-tabs', plugins_url( VIDEO_DIR_NAME . '/js/ap-tabs.js' ) );
		wp_enqueue_style( 'video-admin', plugins_url( VIDEO_DIR_NAME . '/css/video-admin.css' ) );	
	}
	
	public function front_scripts() {
		wp_enqueue_style( 'video', plugins_url( VIDEO_DIR_NAME . '/css/video.css' ) );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'video', plugins_url( VIDEO_DIR_NAME . '/js/video.js' ) );
	}
	
}

<?php

class Video_Data_Class {
	
	public function __construct(){
		add_action( 'add_meta_boxes_video', array( $this, 'video_upload' ) );
		add_action( 'add_meta_boxes_video', array( $this, 'video_meta' ) );
	}
		
	public function video_upload( $post ) {
		add_meta_box(
			'video_upload',
			__( 'Video Upload', 'videos' ),
			array( $this, 'video_upload_callback' ), $post->post_type, 'advanced' 
		);
	}
	
	public function video_upload_callback( $post ) {
		wp_nonce_field( 'attachment_meta_box', 'attachment_meta_box_nonce' );
		$video_file = get_video_file( $post->ID );
		$video_high_res_file = get_video_high_res_file( $post->ID );
		$video_sample_file = get_video_sample_file( $post->ID );
		include( VIDEO_DIR_PATH . '/view/admin/video-data.php' );
	}
	
	public function video_meta( $post ) {
		add_meta_box(
			'video_meta',
			__( 'Video Data', 'videos' ),
			array( $this, 'video_meta_callback' ), $post->post_type, 'side' 
		);
	}
	
	public function video_meta_callback( $post ) {
		wp_nonce_field( 'attachment_meta_box', 'attachment_meta_box_nonce' );
		$video_file_duration = get_post_meta( $post->ID, 'video_file_duration', true );
		include( VIDEO_DIR_PATH . '/view/admin/video-duration-field.php' );
	}
	
}

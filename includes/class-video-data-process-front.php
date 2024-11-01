<?php

class Video_Data_Process_Front_Class{
	
	public function __construct(){
		add_action( 'init', array( $this, 'video_data_ajax' ) );
	}
	
	public function video_data_ajax( $post_id ) {
		if( isset( $_REQUEST['option'] ) and $_REQUEST['option'] == 'videoDataProcessFront' ){
			$post_id = sanitize_text_field( $_REQUEST['post_id'] ); 
			$type = sanitize_text_field( $_REQUEST['type'] ); 
			
			if( $type == 'high' ){
				$video_data = get_video_high_res_file( $post_id );
				if( $video_data ){
					if( $video_data['type'] == 'public' ){
						$video = video_player( $video_data['file'], 500 );
					} else {
						$video = __('Oops!','videos');
					}
					$video_size = get_video_file_size($post_id, 'high');
				}
				$link = get_video_download_link( $post_id, 'high' );
			} else {
				$link = get_video_download_link( $post_id );
				$video_data = get_video_file( $post_id );
				if( $video_data ){
					if( $video_data['type'] == 'public' ){
						$video = video_player( $video_data['file'], 500 );
					} else {
						$video = __('Oops!','videos');
					}
					$video_size = get_video_file_size($post_id);
				}
			}
			
			echo json_encode( array( 'download_link' => $link, 'video' => $video, 'video_size' => $video_size ) ) ;
			exit;
		}
	}

}
<?php

class Video_Data_Process_Class extends Video_Data_Class{
	
	public function __construct(){
		parent::__construct();
		add_action( 'save_post', array( $this, 'save_post_data' ) );
	}
	
	public function save_post_data( $post_id ) {
		if ( ! isset( $_POST['attachment_meta_box_nonce'] ) ) {
			return;
		}
	
		if ( ! wp_verify_nonce( $_POST['attachment_meta_box_nonce'], 'attachment_meta_box' ) ) {
			return;
		}
	
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
	
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
	
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
	
		} else {
	
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}
		
		$this->remove_video_file_data( $post_id );
		$this->upload_video_file_data( $post_id );
		$this->save_video_meta_data( $post_id );
	}
	
	public function remove_video_file_data( $post_id ){
		if(!$post_id){
			return false;
		}
		global $wpdb;
		$sql = $wpdb->prepare( "SELECT v_file, v_file_high, v_file_sample, v_file_type FROM `".$wpdb->base_prefix."video_files` WHERE blog_id = %d AND post_id = %d", get_current_blog_id(), $post_id );
		$stored_files = $wpdb->get_row( $sql );
		
		if( $stored_files ){
			// check if video file needs to be removed 
			if( isset($_REQUEST['remove_video_file']) and sanitize_text_field($_REQUEST['remove_video_file']) == 'yes' ){
				if( $stored_files->v_file_type == 'public' ){
					$upload_dir = wp_upload_dir();
					$video_dir = $upload_dir['basedir'] . '/' . VIDEO_UPLOAD_DIR_NAME;
					unlink( $video_dir . '/' . $stored_files->v_file );
					
					$video_where = array( 'blog_id' => get_current_blog_id(), 'post_id' => $post_id );
					$wpdb->update( $wpdb->base_prefix."video_files", array( 'v_file' => '' ), $video_where );
				}
			}
			// check if video file needs to be removed 
			
			// check if video high res file needs to be removed 
			if( isset($_REQUEST['remove_video_high_res_file']) and sanitize_text_field($_REQUEST['remove_video_high_res_file']) == 'yes' ){
				if( $stored_files->v_file_type == 'public' ){
					$upload_dir = wp_upload_dir();
					$video_dir = $upload_dir['basedir'] . '/' . VIDEO_UPLOAD_DIR_NAME;
					unlink( $video_dir . '/' . $stored_files->v_file_high );
					
					$video_where = array( 'blog_id' => get_current_blog_id(), 'post_id' => $post_id );
					$wpdb->update( $wpdb->base_prefix."video_files", array( 'v_file_high' => '' ), $video_where );
				}
			}
			// check if video high res file needs to be removed 
			
			// check if video sample file needs to be removed 
			if( isset($_REQUEST['remove_video_sample_file']) and sanitize_text_field($_REQUEST['remove_video_sample_file']) == 'yes' ){
				if( $stored_files->v_file_type == 'public' ){
					$upload_dir = wp_upload_dir();
					$video_dir = $upload_dir['basedir'] . '/' . VIDEO_UPLOAD_DIR_NAME;
					unlink( $video_dir . '/' . $stored_files->v_file_sample );
					
					$video_where = array( 'blog_id' => get_current_blog_id(), 'post_id' => $post_id );
					$wpdb->update( $wpdb->base_prefix."video_files", array( 'v_file_sample' => '' ), $video_where );
				}
			}
			// check if video sample file needs to be removed 
		}
	}
	
	public function upload_video_file_data( $post_id ){
		// upload video file  		
		if( $_FILES['video_file']['name'] ){
			add_filter( 'upload_mimes', 'video_restrict_mime_types' );
			add_filter( 'upload_dir', 'video_upload_dir' );
			$upload = wp_upload_bits( $_FILES['video_file']['name'], null, file_get_contents( $_FILES['video_file']['tmp_name'] ) );
			remove_filter( 'upload_dir', 'video_upload_dir' );
			remove_filter( 'upload_mimes', 'video_restrict_mime_types' );
			
			if ( $upload['error'] === false ) {
				$this->store_video_file_data( $post_id, $upload, 'public', 'main' );
			} else {
				wp_die( $upload['error'] );
			}
		}
		// upload video file  		
		
		// upload video high res file  		
		if( $_FILES['video_high_res_file']['name'] ){
			add_filter( 'upload_mimes', 'video_restrict_mime_types' );
			add_filter( 'upload_dir', 'video_upload_dir' );
			$upload = wp_upload_bits( $_FILES['video_high_res_file']['name'], null, file_get_contents( $_FILES['video_high_res_file']['tmp_name'] ) );
			remove_filter( 'upload_dir', 'video_upload_dir' );
			remove_filter( 'upload_mimes', 'video_restrict_mime_types' );
			
			if ( $upload['error'] === false ) {
				$this->store_video_file_data( $post_id, $upload, 'public', 'high_res' );
			} else {
				wp_die( $upload['error'] );
			}
		}
		// upload video high res file  		
		
		// upload video sample file  			
		if( $_FILES['video_sample_file']['name'] ){
			add_filter( 'upload_mimes', 'video_restrict_mime_types' );
			add_filter( 'upload_dir', 'video_upload_dir' );
			$upload = wp_upload_bits( $_FILES['video_sample_file']['name'], null, file_get_contents( $_FILES['video_sample_file']['tmp_name'] ) );
			remove_filter( 'upload_dir', 'video_upload_dir' );
			remove_filter( 'upload_mimes', 'video_restrict_mime_types' );
			
			if ( $upload['error'] === false ) {
				$this->store_video_file_data( $post_id, $upload, 'public', 'sample' );
			} else {
				wp_die( $upload['error'] );
			}
		}
		// upload video sample file  			
		
	}
	
	public function store_video_file_data( $post_id, $upload, $video_type, $type = 'main' ){
		if(!$post_id){
			return false;
		}
		global $wpdb;
		$sql = $wpdb->prepare( "SELECT COUNT(*) FROM `".$wpdb->base_prefix."video_files` WHERE blog_id = %d AND post_id = %d", get_current_blog_id(), $post_id );
		$count = $wpdb->get_var( $sql ); 		
		if( $count ){
			// update 
			if( $type == 'main' ){
				$video['v_file'] = basename($upload['file']);
			} elseif( $type == 'high_res' ){
				$video['v_file_high'] = basename($upload['file']);
			} elseif( $type == 'sample' ){
				$video['v_file_sample'] = basename($upload['file']);
			}
			$video_where = array( 'blog_id' => get_current_blog_id(), 'post_id' => $post_id );
			$wpdb->update( $wpdb->base_prefix."video_files", $video, $video_where );
		} else {
			// insert 
			$video['blog_id'] = get_current_blog_id();
			$video['post_id'] = $post_id;
			if( $type == 'main' ){
				$video['v_file'] = basename($upload['file']);
			} elseif( $type == 'high_res' ){
				$video['v_file_high'] = basename($upload['file']);
			} elseif( $type == 'sample' ){
				$video['v_file_sample'] = basename($upload['file']);
			}
			$video['v_file_type'] = $video_type;
			$wpdb->insert( $wpdb->base_prefix."video_files", $video );
		}
	}
	
	public function save_video_meta_data( $post_id ){
		if(!$post_id){
			return false;
		}
		if( isset($_REQUEST['video_file_duration']) ){
			update_post_meta($post_id, 'video_file_duration', sanitize_text_field($_REQUEST['video_file_duration']));
		} else {
			delete_post_meta($post_id, 'video_file_duration');
		}
	}

}
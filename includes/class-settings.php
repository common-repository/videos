<?php
class Video_Settings {
	
	public $msg;
	
	public function __construct() {
		$this->load_settings();
		$this->msg = new Video_Message_Class;
	}
	
	public function save(){
		if( isset( $_POST['option'] ) and sanitize_text_field( $_POST['option'] ) == "Video_Settings_save" ){
			global $video_default_options_data;
			if ( ! isset( $_POST['video_data_save_action_field'] ) || ! wp_verify_nonce( $_POST['video_data_save_action_field'], 'video_data_save_action' ) ) {
			   wp_die( 'Sorry, your nonce did not verify.');
			} 
			$video_default_options_data = apply_filters( 'video_default_options_data', $video_default_options_data );
			if( is_array($video_default_options_data) ){
				foreach( $video_default_options_data as $key => $value ){
					if ( !empty( $_REQUEST[$key] ) ) {
						
						if( $value['sanitization'] == 'sanitize_text_field' ){
							update_option( $key, sanitize_text_field($_REQUEST[$key]) );
						} elseif( $value['sanitization'] == 'esc_html' ){
							update_option( $key, esc_html($_REQUEST[$key]) );
						} elseif( $value['sanitization'] == 'esc_textarea' ){
							update_option( $key, esc_textarea($_REQUEST[$key]) );
						} elseif( $value['sanitization'] == 'sanitize_text_field_array' ){
						 	update_option( $key, array_filter( $_REQUEST[$key], 'sanitize_text_field' ) );
						} else {
							update_option( $key, sanitize_text_field($_REQUEST[$key]) );
						}
					} else {
						delete_option( $key );
					}
				}
			}
			
			$this->msg->add( 'Plugin data updated successfully.', 'updated' );
		}
	}
	
	public function settings() {
		global $wpdb;
		$video_enable_d_link 			= get_option( 'video_enable_d_link' );
		$video_low_res_text 			= get_option( 'video_low_res_text' );
		$video_high_res_text 			= get_option( 'video_high_res_text' );
		
		echo '<div class="wrap">';
		$this->msg->show();
		Form_Class::form_open();
		wp_nonce_field( 'video_data_save_action', 'video_data_save_action_field' );
		Form_Class::form_input('hidden','option','','Video_Settings_save');
		self::help_support();
		include( VIDEO_DIR_PATH . '/view/admin/settings.php' );
		Form_Class::form_close();
		//self::videos_pro_add();
		echo '</div>';
	}
	
	public static function help_support(){ 
		include( VIDEO_DIR_PATH . '/view/admin/help-support.php' );
	}
	
	private static function videos_pro_add(){
		include( VIDEO_DIR_PATH . '/view/admin/videos-pro-add.php');
	}
	
	public function menu() {
		add_menu_page( 'Video Settings', 'Video Settings', 'activate_plugins', 'Video_Settings', array( $this,'settings' ) );
	}
	
	public function load_settings(){
		add_action( 'admin_menu' , array( $this, 'menu' ) );
		add_action( 'admin_init', array( $this, 'save' ) );
	}	
}

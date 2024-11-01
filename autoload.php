<?php
class Video_Autoload{
	public $load = array(
	// configs 
	'/config/config-default-fields.php',
	// includes 
	'/includes/class-message.php',
	'/includes/class-settings.php',
	'/includes/class-scripts.php',
	'/includes/class-form.php',
	'/includes/class-video-post.php',
	'/includes/class-video-tax-types.php',
	'/includes/class-video-data.php',
	'/includes/class-video-data-process.php',
	'/includes/class-video-data-process-front.php',
	'/includes/class-video-search-widget.php',
	'/includes/class-video-category-widget.php',
	'/includes/class-video-tag-widget.php',
	// widgets 
	'/widgets/video-search-widget.php',
	'/widgets/video-category-widget.php',
	'/widgets/video-tag-widget.php',
	// others
	'/actions.php',
	'/general-functions.php',
	'/core-functions.php',
	'/template-functions.php',
	'/download.php',
	'/video-shortcode.php',
	);
	
	public function __construct(){
		if( is_array( $this->load ) ){
			foreach( $this->load as $value ){
				include_once VIDEO_DIR_PATH . $value;
			}
		}
	}
}
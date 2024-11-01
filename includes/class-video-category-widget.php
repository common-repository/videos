<?php
class Video_Category_Widget_Class{
	public function view(){
		$categories = get_terms( 'video_category', array(
			'orderby'    => 'count',
			'hide_empty' => true,
		) );
		include( VIDEO_DIR_PATH . '/view/front/video-category-widget.php' );
	}
}
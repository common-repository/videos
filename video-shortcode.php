<?php

function ap_videos_shortcode( $atts ) {
     global $post;
	 extract( shortcode_atts( array(
	      'title' => '',
		  'search_form' => 1
     ), $atts ) );
     
	ob_start();
	if($title){
		echo '<h2>'. esc_html( $title ) .'</h2>';
	}
	the_all_videos( $search_form );
	$ret = ob_get_contents();	
	ob_end_clean();
	return $ret;
}
<?php

add_action( 'post_edit_form_tag' , 'video_post_edit_form_tag' );
function video_post_edit_form_tag( ) {
    echo ' enctype="multipart/form-data"';
}

function video_upload_dir( $param ){
    $param['path'] = $param['basedir'] . '/' . VIDEO_UPLOAD_DIR_NAME;
    $param['url'] = $param['baseurl'] . '/' . VIDEO_UPLOAD_DIR_NAME;
    return $param;
}

function video_restrict_mime_types( $mime_types ) {
	$mime_types = array(
		'mp4' => 'video/mp4',
	);
	return $mime_types;
}

add_action( 'pre_get_posts', 'video_search_query', 1 );
function video_search_query( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_post_type_archive( 'video' ) ) {
		if( isset( $_REQUEST['vsrch'] ) ){
			$query->set( 's', sanitize_text_field($_REQUEST['vsrch']) );
        	return;
		}
    }
}

add_filter( 'admin_post_thumbnail_html', 'video_featured_image_html');
function video_featured_image_html( $html ) {
	$pt = get_current_screen()->post_type;
	if ( $pt != 'video') return $html;
	return $html .= __( 'For best retults use image of size 360 x 250', 'videos' );
}

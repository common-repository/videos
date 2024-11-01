<?php

define( 'VIDEO_ENCRYPTION_KEY', '59ae87f68e5116bc716e5bda4783d42c4675e560fdfa' );

global $video_default_options_data;

$video_default_options_data = array( 
	// general
	'video_enable_d_link' => array( 'sanitization' => 'sanitize_text_field' ),
	'video_low_res_text' => array( 'sanitization' => 'sanitize_text_field' ),
	'video_high_res_text' => array( 'sanitization' => 'sanitize_text_field' ),
);
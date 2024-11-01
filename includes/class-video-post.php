<?php

class Video_Post_Class {
	
	public function __construct(){
		add_action( 'init', array( $this, 'codex_reg_video' ) );
	}
	
	public function codex_reg_video() {
		$labels = array(
		'name'               => _x( 'Video', 'post type general name', 'videos' ),
		'singular_name'      => _x( 'Video', 'post type singular name', 'videos' ),
		'menu_name'          => _x( 'Videos', 'admin menu', 'videos' ),
		'name_admin_bar'     => _x( 'Videos', 'add new on admin bar', 'videos' ),
		'add_new'            => _x( 'Add New', 'Video', 'videos' ),
		'add_new_item'       => __( 'Add New Video', 'videos' ),
		'new_item'           => __( 'New Videos', 'videos' ),
		'edit_item'          => __( 'Edit Video', 'videos' ),
		'view_item'          => __( 'View Video', 'videos' ),
		'all_items'          => __( 'All Videos', 'videos' ),
		'search_items'       => __( 'Search Videos', 'videos' ),
		'parent_item_colon'  => __( 'Parent Video:', 'videos' ),
		'not_found'          => __( 'No Videos found.', 'videos' ),
		'not_found_in_trash' => __( 'No Videos found in Trash.', 'videos' )
		);
	
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'video', 'with_front' => false ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'excerpt', 'thumbnail' ),
			'menu_icon'			 => 'dashicons-format-video'
		);
	
		register_post_type( 'video', $args );
	}
	
}

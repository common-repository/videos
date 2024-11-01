<?php

class Video_Custom_Tax_Class{
	
	public function __construct(){
		add_action( 'init', array( $this, 'custom_tax' ) );
	}
	
	public function custom_tax() {
		$labels = array(
			'name'              => _x( 'Category', 'taxonomy general name' ),
			'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Category' ),
			'all_items'         => __( 'All Category' ),
			'parent_item'       => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item'         => __( 'Edit Category' ),
			'update_item'       => __( 'Update Category' ),
			'add_new_item'      => __( 'Add New Category' ),
			'new_item_name'     => __( 'New Category' ),
			'menu_name'         => __( 'Category' ),
		);
	
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => 'video-category',
			'rewrite'           => array( 'slug' => 'video-category' ),
		);
	
		register_taxonomy( 'video_category', array( 'video' ), $args );
		
		$labels = array(
			'name'              => _x( 'Tag', 'taxonomy general name' ),
			'singular_name'     => _x( 'Tag', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Tags' ),
			'all_items'         => __( 'All Tags' ),
			'parent_item'       => __( 'Parent Tag' ),
			'parent_item_colon' => __( 'Parent Tag:' ),
			'edit_item'         => __( 'Edit Tag' ),
			'update_item'       => __( 'Update Tag' ),
			'add_new_item'      => __( 'Add New Tag' ),
			'new_item_name'     => __( 'New Tag' ),
			'menu_name'         => __( 'Tag' ),
		);
	
		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => 'video-tag',
			'rewrite'           => array( 'slug' => 'video-tag' ),
		);
	
		register_taxonomy( 'video_tag', array( 'video' ), $args );
		
	}

}

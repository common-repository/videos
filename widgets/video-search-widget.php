<?php

class Video_Search_Widget extends WP_Widget {
	
	public function __construct() {
		parent::__construct(
	 		'video_search_widget',
			'Video Search',
			array( 'description' => __( 'Video search form', 'videos' ), )
		);
	 }

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['wid_title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['wid_title'] ) . $args['after_title'];
		}
		$cvs = new Video_Search_Widget_Class;
		$cvs->view();
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['wid_title'] = strip_tags( $new_instance['wid_title'] );
		return $instance;
	}

	public function form( $instance ) {
		$wid_title = '';
		if(!empty($instance[ 'wid_title' ])){
			$wid_title = esc_html($instance[ 'wid_title' ]);
		}
		?>
		<p><label for="<?php echo $this->get_field_id('wid_title'); ?>"><?php _e('Title','videos'); ?> </label>
        <input type="text" name="<?php echo $this->get_field_name('wid_title');?>" id="<?php echo $this->get_field_id('wid_title');?>" value="<?php echo $wid_title;?>" class="widefat">
		</p>
		<?php 
	}
	
} 
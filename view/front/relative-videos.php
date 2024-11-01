<?php $rel_videos_query = new WP_Query( $args ); ?>
<?php if ( $rel_videos_query->have_posts() ) { ?>

<h3><?php _e('Related Videos', 'videos'); ?> </h3>

<ul class="video_thumb">

<?php while ( $rel_videos_query->have_posts()  ) : $rel_videos_query->the_post(); ?>

    <li>
		<?php echo get_archive_video_thumb( $rel_videos_query->post->ID );?>
        <div class="video-res"><?php video_archive_resolution_selection( $rel_videos_query->post->ID );?></div>
        <div class="info">
            <h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
            <p><?php video_the_excerpt( 90 );?></p>
        </div>
        <div class="video_download_wrap">
			<?php video_size( $rel_videos_query->post->ID );?>
			<?php video_duration( $rel_videos_query->post->ID );?>
			<?php video_archive_download_link( $rel_videos_query->post->ID );?>
        </div>
    </li>
    
<?php endwhile; ?>

</ul> 

<?php } ?> 

<?php wp_reset_postdata(); ?>
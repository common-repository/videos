<?php 
$videos_query = new WP_Query( $args ); ?>
<?php if ( $videos_query->have_posts() ) { ?>
<ul class="video_thumb">
<?php while ( $videos_query->have_posts()  ) : $videos_query->the_post(); ?>

    <li>
		<?php echo get_archive_video_thumb( $videos_query->post->ID );?>
        <div class="video-res"><?php video_archive_resolution_selection( $videos_query->post->ID );?></div>
        <div class="info">
            <h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
            <p><?php video_the_excerpt( 90 );?></p>
        </div>
        <div class="video_download_wrap">
			<?php video_size( $videos_query->post->ID );?>
			<?php video_duration( $videos_query->post->ID );?>
			<?php video_archive_download_link( $videos_query->post->ID );?>
        </div>
    </li>
    
<?php endwhile; ?>

</ul> 

<div class="video-paginate">
<?php

$big = 999999999; // need an unlikely integer

echo paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $videos_query->max_num_pages
) );
?>
</div>
            
<?php } else { ?>

	<center><?php _e('Sorry no videos found','video'); ?></center>
    
<?php } ?> 

<?php wp_reset_postdata(); ?>
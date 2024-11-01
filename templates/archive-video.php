<?php get_header(); ?>

	<section class="content-area col-md-8">
		<main class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">Videos</h1>
			</header>
            
            <ul class="video_thumb">
			<?php while ( have_posts() ) : the_post(); ?>
            	<li>
                    <?php echo get_archive_video_thumb( $post->ID );?>
                    <div class="video-res"><?php video_archive_resolution_selection( $post->ID );?></div>
                    <div class="info">
                    	<h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                    	<p><?php video_the_excerpt( 90 );?></p>
                    </div>
                    <div class="video_download_wrap">
						<?php video_size( $post->ID );?>
						<?php video_duration( $post->ID );?>
						<?php video_archive_download_link( $post->ID );?>
                    </div>
				</li>
			<?php endwhile; ?>
            </ul>  
            
            <div class="video-paginate">
            <?php
			global $wp_query;
			
			$big = 999999999; // need an unlikely integer
			
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages
			) );
			?>
            </div>
            
		<?php else : ?>

			<center><?php _e('Sorry no videos found','video'); ?></center>

		<?php endif; ?>
		
        
        <div class="video-clear"></div>
        
		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

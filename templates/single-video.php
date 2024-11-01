<?php get_header(); ?>

	<div class="content-area col-md-8">
		<main class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
		
        <h3><?php the_title(); ?> </h3>
        <h4><?php echo get_the_term_list( $post->ID, 'video_category', '', ', ' ); ?></h4>
        
        <div class="video_single"><?php the_video( $post->ID );?> 
        
        <div class="video_download_wrap_single">
        	<?php video_size( $post->ID );?>
			<?php video_duration( $post->ID );?>
        	<?php video_download_link( $post->ID ) ;?>
            <?php video_archive_resolution_selection( $post->ID );?>
        </div>
        
        </div>
        
        <div class="video-clear"></div>
        
        <?php the_excerpt(); ?>
        
        <div class="video-clear"></div>
        
        <?php echo get_the_term_list( $post->ID, 'video_tag', 'Tags: ', ', ' ); ?>
			
		<?php endwhile; // end of the loop. ?>
        
        <?php the_relative_videos();?>

		</main>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
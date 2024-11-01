<!-- video file -->
<h3><?php _e('Video File','videos');?></h3>
<p><strong><?php _e('Upload File (MP4)','videos');?></strong> <input type="file" name="video_file"></p>
<?php
if( $video_file['type'] == 'public' ){
	if( $video_file['file'] ){
		echo video_player( $video_file['file'] );
		?>
		<p><label style="color:red;"><input type="checkbox" name="remove_video_file" value="yes"><?php _e( 'Check to remove', 'videos' );?> <?php echo $video_file['file'];?></label></p>
		<p><a href="<?php echo get_video_download_link_admin( $post->ID, false );?>" title="<?php _e('Download', 'videos');?>"><img src="<?php echo plugins_url( VIDEO_DIR_NAME . '/images/download_link.png' );?>" alt="Download"></a></p>
		<?php
    }
}
?>

<!-- video high resolution file -->
<hr>
<h3><?php _e('Video High Resolution File','videos');?></h3>
<p><strong><?php _e('Upload File (MP4)','videos');?></strong> <input type="file" name="video_high_res_file"></p>
<?php
if( $video_high_res_file['type'] == 'public' ){
	if( $video_high_res_file['file'] ){
		echo video_player( $video_high_res_file['file'] );
		?>
		<p><label style="color:red;"><input type="checkbox" name="remove_video_high_res_file" value="yes"><?php _e( 'Check to remove', 'videos' );?> <?php echo $video_high_res_file['file'];?></label></p>
		<p><a href="<?php echo get_video_download_link_admin( $post->ID, false, 'high' );?>" title="<?php _e('Download', 'videos');?>"><img src="<?php echo plugins_url( VIDEO_DIR_NAME . '/images/download_link.png' );?>" alt="Download"></a></p>
		<?php
    }
}
?>

<!-- video sample file -->
<hr>
<h3><?php _e('Video Sample File','videos');?></h3>
<p><strong><?php _e('Upload File (MP4)','videos');?></strong> <input type="file" name="video_sample_file"></p>
<?php
if( $video_sample_file['file'] ){
	echo video_player( $video_sample_file['file'] );
	?>
	<p><label style="color:red;"><input type="checkbox" name="remove_video_sample_file" value="yes"><?php _e( 'Check to remove', 'videos' );?> <?php echo $video_sample_file['file'];?></label></p>
	<p><a href="<?php echo get_video_download_link_admin( $post->ID, true );?>" title="<?php _e('Download', 'videos');?>"><img src="<?php echo plugins_url( VIDEO_DIR_NAME . '/images/download_link.png' );?>" alt="Download"></a></p>
	<?php
}


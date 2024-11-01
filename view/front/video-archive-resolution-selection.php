<?php if($video_data){ ?>
<div class="res" id="archive-res-sel-low-<?php echo $post_id;?>" onClick="videoResolutionSelection('<?php echo $post_id;?>', 'low');"><?php _e((get_option('video_low_res_text')==''?'Low Res':get_option('video_low_res_text')),'videos');?></div>
<?php } ?>

<?php if($video_data_high_res){ ?>
<div class="res" id="archive-res-sel-high-<?php echo $post_id;?>" onClick="videoResolutionSelection('<?php echo $post_id;?>', 'high');"><?php _e((get_option('video_high_res_text')==''?'High Res':get_option('video_high_res_text')),'videos');?></div>
<?php } ?>

<script>
<?php
if($video_data){
	echo 'videoResolutionSelection(\''.$post_id.'\', \'low\');';
} else if( !$video_data && $video_data_high_res ){
	echo 'videoResolutionSelection(\''.$post_id.'\', \'high\');';
}
?>
</script>
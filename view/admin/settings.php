<table width="100%" border="0" class="ap-table">
<tr>
  <td><h3><?php _e('Video Settings', 'videos');?></h3></td>
</tr>
<tr>
  <td><div class="ap-tabs">
      <div class="ap-tab">
        <?php _e('General','videos');?>
      </div>
      <div class="ap-tab">
        <?php _e('URLs','videos');?>
      </div>
      <div class="ap-tab">
        <?php _e('Shortcodes','videos');?>
      </div>
      <?php do_action('video_custom_settings_tab');?>
    </div>
    <div class="ap-tabs-content">
      <div class="ap-tab-content">
        <table width="100%" border="0">
            <tr>
              <td width="300" valign="top"><strong><?php _e('Enable Video Download','videos');?></strong></td>
              <td><label><input type="checkbox" name="video_enable_d_link" value="yes" <?php echo ($video_enable_d_link == 'yes'?'checked':'');?>>If enabled then video download link will be displayed for General & Private videos.</label></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td width="300" valign="top"><strong><?php _e('Change Low Res Text','videos');?></strong></td>
              <td><input type="text" name="video_low_res_text" value="<?php echo $video_low_res_text;?>" class="widefat" placeholder="<?php _e('720p','videos');?>"></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td width="300" valign="top"><strong><?php _e('Change High Res Text','videos');?></strong></td>
              <td><input type="text" name="video_high_res_text" value="<?php echo $video_high_res_text;?>" class="widefat" placeholder="<?php _e('1080p','videos');?>"></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" name="submit" class="button button-primary button-large" value="<?php _e('Submit','videos');?>"></td>
            </tr>
        </table>	
      </div>
      <div class="ap-tab-content">
        <table width="100%" border="0">
            <tr>
              <td width="300" valign="top"><strong><?php _e('Video archive page URL','videos');?></strong></td>
              <td><a href="<?php echo get_post_type_archive_link('video');?>" target="_blank"><?php echo get_post_type_archive_link('video');?></a></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
             <tr>
              <td colspan="2">
              	<strong><?php _e('Note','videos');?></strong> <?php echo sprintf( __("If you get Page not found error then please update the %s and check again.", 'video'), '<a href="options-permalink.php">Permalink</a>' ); ?>
              </td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
        </table>	
      </div>
      <div class="ap-tab-content">
        <table width="100%" border="0">
            <tr>
              <td><p><strong>[videos title="Videos" search_form="1"]</strong> <?php _e('shortcode to display videos in a page.','videos');?></p></td>
            </tr>
        </table>	
      </div>
      <?php do_action('video_custom_settings_tab_content');?>
    </div></td>
</tr>
</table>
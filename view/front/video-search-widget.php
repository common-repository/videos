<div class="video-search-widget">
    <form name="video-search" method="get" action="<?php echo get_post_type_archive_link('video');?>">
        <input type="text" placeholder="<?php _e('Search for videos','videos');?>" value="<?php echo sanitize_text_field(@$_REQUEST['vsrch']);?>" name="vsrch">
        <input type="submit" name="submit" value="<?php _e('Go','videos');?>">
    </form>
</div>
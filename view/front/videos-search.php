<div class="video-search-widget">
    <form name="video-search-adv" method="get" action="">
        <input type="text" placeholder="<?php _e('Search for videos','videos');?>" value="<?php echo sanitize_text_field(@$_REQUEST['vsrch_adv']);?>" name="vsrch_adv">
        <input type="submit" name="submit" value="<?php _e('Go','videos');?>">
    </form>
</div>
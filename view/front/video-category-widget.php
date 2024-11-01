<div class="video-category-widget">
<?php
if ( ! empty( $categories ) && ! is_wp_error( $categories ) ){
    echo '<ul>';
    foreach ( $categories as $category ) {
        echo '<li><a href="' . esc_url( get_term_link( $category ) ) . '" alt="' . $category->name . '">' . $category->name . '</a></li>';
    }
    echo '</ul>';
}
?>
</div>
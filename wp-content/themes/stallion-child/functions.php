<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
    wp_enqueue_style( 'stallion-master', get_template_directory_uri().'/style.css' );
}
?>

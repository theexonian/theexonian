<style>
body{
    background-color: <?php esc_attr_e(get_option('mmp_bgcolor')) ?>;
    color: <?php esc_attr_e(get_option('mmp_text_color')) ?>;
}

body *{
    color: <?php esc_attr_e(get_option('mmp_text_color')) ?>;
}

a{
    color: <?php  esc_attr_e(get_option('mmp_links_color')) ?>;
}

.success-message, .error-message {
    padding-top: 10px;
}


<?php if ( get_option('mmp_background_image') !== '' ): ?>
body {
    background: url( "<?php echo esc_url(get_option('mmp_background_image')) ?>" ) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
<?php endif; ?>



<?php if ( get_option('mmp_links_hover_color') !== '' ): ?>
a:hover{
    color: <?php echo get_option('mmp_links_hover_color') ?> !important;
}
<?php endif; ?>

<?php if ( get_option('mmp_fft') !== '' ): ?>
body{
    font-family: '<?php echo str_replace("+"," ",get_option("mmp_fft")) ?>','Lato','Georgia','Times New Roman', serif;
}
<?php endif; ?>

<?php if ( get_option('mmp_ffht') !== '' ): ?>
h1, h2, h3, h4, h5, h6 {
    font-family: '<?php echo str_replace("+"," ",get_option("mmp_ffht")) ?>','Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif !important;
}
<?php endif; ?>

<?php if ( get_option('mmp_headingcolor') !== '' ): ?>
h1, h2, h3, h4, h5, h6 {
    color: <?php echo get_option('mmp_headingcolor') ?> !important;
}
<?php endif; ?>

<?php echo get_option('mmp_custom_css') ?>
</style>

<?php if ( get_option('mmp_custom_footrt_script') !== '' ): ?>
    <?php echo get_option('mmp_custom_footrt_script') ?>
<?php endif; ?>




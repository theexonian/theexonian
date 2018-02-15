<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package newsbd24
 */

get_header(); ?>
<div class="content col-lg-12">
<div class="single-page clearfix">
<div class="notfound">   
    <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
            <h2><?php esc_html_e( '404', 'newsbd24' ); ?></h2>
            <h3><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'newsbd24' ); ?></h3>
           <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'newsbd24' ); ?></p>
          
            <a href="<?php echo esc_url( home_url()); ?>" class="btn btn-primary"><?php esc_html_e('Back to Home', 'newsbd24'); ?></a>
        </div>
    </div>
</div>
</div>
</div>
<?php
get_footer();

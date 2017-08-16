<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
    wp_enqueue_style( 'stallion-master', get_template_directory_uri().'/style.css' );
}
function posts_by_author( $name, $page, $page_size = 10 ) {
	global $wpdb;
	$pn = (max(1, $page)-1)*$page_size;
	return $wpdb->get_results(
		"
		SELECT $wpdb->posts.* FROM $wpdb->postmeta INNER JOIN $wpdb->posts 
		 ON $wpdb->postmeta.post_id = $wpdb->posts.ID 
		 WHERE $wpdb->postmeta.meta_key = 'authors'
		 AND $wpdb->postmeta.meta_value LIKE '%".esc_sql($name)."%'
		 AND $wpdb->posts.post_status = 'publish'
		 ORDER BY $wpdb->posts.post_date DESC
		 LIMIT ".intval($pn).", ".intval($page_size)."
		", OBJECT
	);
}
function get_ads ($pos, $limit = 1) {
	global $wpdb;
	return $wpdb->get_results(
		"
		SELECT wp_ads.* FROM wp_ads
		 WHERE position = '".esc_sql($pos)."'
		 ORDER BY RAND()
		 LIMIT ".intval($limit).";
		", OBJECT
	);
}
function the_ads ($pos = 'HEADER', $limit = 1) {
	$ads = get_ads($pos, $limit);
	foreach ($ads as $ad) {
		echo '<div class="sponsor">'.PHP_EOL;
		echo "\t".'<a href="'.htmlentities($ad->link).'" title="'.htmlentities($ad->tooltip).'">'.PHP_EOL;
		echo "\t\t".'<img class="sponsor_img" src="'.htmlentities($ad->image).'" alt="'.htmlentities($ad->tooltip).'" />'.PHP_EOL;
		echo "\t".'</a>'.PHP_EOL;
		echo '</div>'.PHP_EOL;
	}
}
function ads_content ($more_link_text = null, $strip_teaser = false) {
	$content = get_the_content($more_link_text = null, $strip_teaser = false);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	$content = explode('</p>'.PHP_EOL, $content);
	$n = count($content);
	$qtr = floor($n/4);
	for ($i = 0; $i < $n; $i++) {
		if (($i == $qtr && $n > 4) || $i == 2*$qtr || ($i == 3*$qtr && $n > 4)) {
			the_ads('SIDEBAR', 1);
		}
		echo $content[$i].'</p>'.PHP_EOL;
	}
}
function cflems_hit () {
	global $wpdb;
	$wpdb->query(
		"UPDATE $wpdb->options
		  SET option_value = option_value + 1
		  WHERE option_id = 40816"
	);
}
?>
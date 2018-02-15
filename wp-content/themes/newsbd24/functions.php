<?php
/**
 * Implement the theme Core function
 */
require get_template_directory() . '/inc/core.php';

/**
 * Implement News Bd 24 Custom HOOK
 */
require get_template_directory() . '/inc/theme-hooks.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

/**
* Custom posts hooks
*/
require get_template_directory() . '/inc/post_hooks.php';

/**
* Custom Theme Function
*/
require get_template_directory() . '/inc/template-functions.php';

/**
* Custom Theme Function
*/
require get_template_directory() . '/inc/common_hook.php';


/**
* Custom Theme Function
*/
require get_template_directory() . '/inc/customizer/customizer.php';

/**
* Load All Filter Hook
*/
require get_template_directory() . '/inc/filter_hook.php';

/**
* Load All Filter Hook
*/
require get_template_directory() . '/inc/pro/newsbd24-admin-page.php';

/**
* Load All Filter Hook
*/
require get_template_directory() . '/inc/tgm/plugins.php';





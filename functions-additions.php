<?php
/**
 * Additions for WordPress theme functions.php
 * 
 * Copy the entire content of this file to the end of your theme's functions.php
 * Do NOT replace your existing functions.php – just append this code.
 *
 * @package PotatoCatalog
 * @version 1.0
 */

// 1. Register taxonomy "variety_tags" for default posts
function add_variety_tags_to_posts() {
    register_taxonomy( 'variety_tags', 'post', array(
        'labels' => array(
            'name'              => 'Variety Tags',
            'singular_name'     => 'Variety Tag',
            'menu_name'         => 'Variety Tags',
        ),
        'public'            => true,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_menu'      => true,
        'hierarchical'      => false,
    ) );
}
add_action( 'init', 'add_variety_tags_to_posts' );

// 2. Allow custom query vars (array for multi-tag and pagination)
function add_catalog_query_vars($vars) {
    $vars[] = 'variety_tag';
    $vars[] = 'pagenum';
    return $vars;
}
add_filter('query_vars', 'add_catalog_query_vars');

// 3. Add Yandex.RTB loader script to <head>
function add_yandex_ads() {
    ?>
    <!-- Yandex.RTB -->
    <script>window.yaContextCb = window.yaContextCb || []</script>
    <script src="https://yandex.ru/ads/system/context.js" async></script>
    <?php
}
add_action('wp_head', 'add_yandex_ads');
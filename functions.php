// Register "variety_tags" taxonomy for posts
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

// Allow variety_tag (array) and pagenum parameters in URLs
function add_catalog_query_vars($vars) {
    $vars[] = 'variety_tag';
    $vars[] = 'pagenum';
    return $vars;
}
add_filter('query_vars', 'add_catalog_query_vars');

// Add Yandex.RTB loader to <head>
function add_yandex_ads() {
    ?>
    <!-- Yandex.RTB -->
    <script>window.yaContextCb = window.yaContextCb || []</script>
    <script src="https://yandex.ru/ads/system/context.js" async></script>
    <?php
}
add_action('wp_head', 'add_yandex_ads');
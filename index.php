<?php
/*
Plugin Name: CD2 FullStory Integration
Description: This plugin is designed to Integrate the fullstory platform with WordPress. Plugin Targets PHP7, don't try running on 5.x branch
Author: LewisCowles
Version: 1.09
Author URI: https://www.codesign2.co.uk/
*/

if(!defined('FULLSTORY_ORG')) { // Why do this? Oh yeah because automated installs via ansible or shell-script
    define('FULLSTORY_ORG', '00000');
}

function cd2_fullstory_get_org() {
    return esc_attr(get_option('fullstory_org_code', FULLSTORY_ORG));
}

function cd2_fullstory_get_snippet() {
    $install_overwrite_path = WP_CONTENT_DIR . '/fullstory/snippet.js';
    if(file_exists($install_overwrite_path) && is_readable($install_overwrite_path)) {
        return file_get_contents($install_overwrite_path);
    }
    return file_get_contents(plugin_dir_path(__FILE__) . '/js/fs-snippet.js');
}

function render_cd2_fullstory_settings_page() {
    ?><h3>FullStory Settings</h3>
    <form method="post" action="options.php">
    <?php
        echo settings_fields( 'cd2_fullstory_wordpress_integration' );
        $val = cd2_fullstory_get_org() ?>
        <table class="form-table" role="presentation">
        <tbody>
        <tr>
        <th scope="row"><label for="fullstory_org_code">Fullstory Organisation Code</label></th>
        <td>
        <input type="text" name="fullstory_org_code" id="fullstory_org_code" value="<?= $val; ?>" class="regular-text ltr"/>
        </td>
        </tr>
        </table>
        <script type="text/javascript">
        <?= file_get_contents(plugin_dir_path(__FILE__) . '/js/admin.js'); ?>
        </script>
        <?php submit_button(); ?>
    </form><?php
}

register_activation_hook( __FILE__, function(){
    add_option( 'fullstory_org_code', '00000', '', true );
} );

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), function($links) {
    $mylinks = [
        '<a href="' . admin_url( 'options-general.php?page=cd2-fullstory-wordpress-integration' ) . '">Settings</a>',
        '<a href="https://github.com/CODESIGN2/wordpress-fullstory-integration/">Source Code (GitHub)</a>',
    ];
    return array_merge( $links, $mylinks );
} );

add_action('admin_init', function() {
    register_setting( 'cd2_fullstory_wordpress_integration', 'fullstory_org_code', 'esc_attr' );
} );

add_action('admin_menu', function() {
    add_options_page(
        'FullStory WordPress Options',
        'FullStory',
        'manage_options',
        'cd2-fullstory-wordpress-integration',
        'render_cd2_fullstory_settings_page'
    );
});

add_filter( 'cd2_fstory_data', function($dataFields) {
    if( class_exists( 'woocommerce' ) ) {
      $dataFields["totalOrders_int"] = wc_get_customer_order_count(get_current_user_id());
      $spent = wc_get_customer_total_spent(get_current_user_id());
      $dataFields["totalSpent_str"] = "'{$spent}'";
    }
    return $dataFields;
} );

add_action( 'wp_head', function() {
?>
<?php if(apply_filters('cd2_enable_fstory', true) && apply_filters('cd2_disable_fstory_admin', !is_admin())): ?>
<!-- FullStory WP Integration -->
<script>
window['_fs_debug'] = '<?= apply_filters('cd2_fstory_debug_enable', false) ? 'true' : 'false'; ?>';
window['_fs_org'] = '<?= cd2_fullstory_get_org() ?>';

<?= apply_filters('cd2_fstory_snippet', cd2_fullstory_get_snippet()); ?>
</script>
<?php if (is_user_logged_in()): ?><?php $current_user = wp_get_current_user(); ?><?php $current_user_data = get_userdata(get_current_user_id()); ?>
<script>
(function() {
    var wpEmail = "<?= $current_user->user_email; ?>";
    var wpUsername = "<?= $current_user->display_name; ?>";
    var wpRoles = "<?= implode(', ', $current_user_data->roles); ?>";
    var data = {
        "displayName": wpUsername,
        "email": wpEmail,
        "roles_str": wpRoles
    };

    <?php foreach(apply_filters('cd2_fstory_data', []) as $key => $value): ?> 
    data["<?= $key; ?>"] = <?= $value; ?>; <?php // ensure you enclose strings ?>
    <?php endforeach; ?> 
    FS.identify(wpUsername, data);
    FS.consent(<?= apply_filters('cd2_fstory_consent_to_protected_fields', false) ? 'true' : 'false' ?>);
})();
<?php endif; ?>
<?php endif; ?>
</script>
<?php
} );

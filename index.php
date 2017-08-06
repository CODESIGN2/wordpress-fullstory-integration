<?php
/*
Plugin Name: CD2 FullStory Integration
Description: This plugin is designed to Integrate the fullstory platform with WordPress. Plugin Targets PHP7, don't try running on 5.x branch
Author: CD2 Team
Version: 1.00
Author URI: https://www.codesign2.co.uk/
*/

if(!defined('FULLSTORY_ORG')) { // Why do this? Oh yeah because automated installs via ansible or shell-script
    define('FULLSTORY_ORG', '00000');
}

function fullstory_get_org() {
    return esc_attr(get_option('fullstory_org_code', FULLSTORY_ORG));
}

register_activation_hook( __FILE__, function(){
    add_option( 'fullstory_org_code', '00000', '', true );
} );

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), function($links) {
    $mylinks = [
        '<a href="' . admin_url( 'options-general.php#fullstory_org_code' ) . '">Settings</a>',
    ];
    return array_merge( $links, $mylinks );
} );

add_action('admin_init', function() {
	register_setting( 'general', 'fullstory_org_code', 'esc_attr' ); 
    add_settings_field(
	    'fullstory_org_code',
	    'FullStory Organisation Code',
	    function(){
	        $val = fullstory_get_org() ?>
	        <input type="text" name="fullstory_org_code" id="fullstory_org_code" value="<?= $val; ?>"/>
	        <?php
	    },
	    'general'
    );
});

add_action( 'wp_head', function() {
?>
<!-- FullStory WP Integration -->
<script>
window['_fs_debug'] = false;
window['_fs_host'] = 'fullstory.com';
window['_fs_org'] = '<?= fullstory_get_org() ?>';
window['_fs_namespace'] = 'FS';
(function(m,n,e,t,l,o,g,y){
    if (e in m && m.console && m.console.log) { m.console.log('FullStory namespace conflict. Please set window["_fs_namespace"].'); return;}
    g=m[e]=function(a,b){g.q?g.q.push([a,b]):g._api(a,b);};g.q=[];
    o=n.createElement(t);o.async=1;o.src='https://'+_fs_host+'/s/fs.js';
    y=n.getElementsByTagName(t)[0];y.parentNode.insertBefore(o,y);
    g.identify=function(i,v){g(l,{uid:i});if(v)g(l,v)};g.setUserVars=function(v){g(l,v)};
    g.identifyAccount=function(i,v){o='account';v=v||{};v.acctId=i;g(o,v)};
    g.clearUserCookie=function(c,d,i){if(!c || document.cookie.match('fs_uid=[`;`]*`[`;`]*`[`;`]*`')){
    d=n.domain;while(1){n.cookie='fs_uid=;domain='+d+
    ';path=/;expires='+new Date(0).toUTCString();i=d.indexOf('.');if(i<0)break;d=d.slice(i+1)}}};
})(window,document,window['_fs_namespace'],'script','user');
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
  
  <?php if( class_exists( 'woocommerce' ) ): ?>
  var count = <?= wc_get_customer_order_count(get_current_user_id()); ?>;
  var spend = "<?= wc_get_customer_total_spent(get_current_user_id()); ?>";
  data["totalOrders_int"] = count;
  data["totalSpent_str"] = spend;
  <?php endif; ?>
    
  FS.identify(wpUsername, data);
})();
<?php endif; ?>
</script>
<?php
} );

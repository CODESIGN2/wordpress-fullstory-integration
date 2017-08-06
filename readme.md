# fullstory WordPress reference integration

This plugin enables painless integration with WordPress (including WooCommerce) with the fullstory user-monitoring platform.

It adds an entry to the general settings page where you simply enter your valid fullstory organisation ID, and you get data from your WordPress site.

    https://app.fullstory.com/ui/**{ORGID}**/segments/everyone/people/0

![alt text][screenshot urlbar]
    
The plugin is also compatible with wp-cli automated deployment by injecting a define 'FULLSTORY_ORG' to the wp-config.php.

The plugin does no special work apart from ensuring that attributes are escaped in saved values before being used.

This is a reference plugin, we'd love to develop it further, or work with you or your business to include additional features, perhaps a hooks interface or more formal view-separation for complex projects.

[screenshot urlbar]: http://i.imgur.com/QymXVzD.png "Screenshot of URL Organisation ID Highlighted in Yellow"

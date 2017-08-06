=== fullstory WordPress reference integration ===
Contributors: CD2Team
Tags: integrate, integration, ux, user experience, user-experience, fullstory, cd2, codesign2, lewiscowles, user behaviour, user recording, metrics, user insight, woocommerce analytics, woocommerce monitoring, customer profile, replay user session
Requires at least: 4.6
Tested up to: 4.8
Stable tag: 1.0.3
License: GPLv3

== Description ==
This plugin enables painless integration with WordPress (including WooCommerce) with the fullstory user-monitoring platform.

It adds an entry to the general settings page where you simply enter your valid fullstory organisation ID, and you get data from your WordPress site.

    https://app.fullstory.com/ui/**{ORGID}**/segments/everyone/people/0

![alt text][screenshot urlbar]
    
The plugin is also compatible with wp-cli automated deployment by injecting a define 'FULLSTORY_ORG' to the wp-config.php.

The plugin does no special work apart from ensuring that attributes are escaped in saved values before being used.

This is a reference plugin, we'd love to develop it further, or work with you or your business to include additional features, perhaps a hooks interface or more formal view-separation for complex projects.

== Changelog ==
= 1.0.3 =
**Added**

* filter hook `cd2_fstory_data` custom variables to be passed to FullStory.

**Changed**

* WooCommerce moved to use new `cd2_fstory_data` filter

**Fixed**

N/A

= 1.0.2 =
**Added**

* filter hook `cd2_fstory_data` custom variables to be passed to FullStory.

**Changed**

* WooCommerce moved to use new `cd2_fstory_data` filter

**Fixed**

* N/A

= 1.0.1 =
**Added**

* Link to GitHub Repo where plugin code lives to make it easier to raise development-related issues

**Changed**

* N/A

**Fixed**

* N/A

= 1.0.0 =
**Added**

* Initial Release
* Ability to edit one-setting and have FullStory integrated with WordPress, including WooCommerce


[screenshot urlbar]: http://i.imgur.com/QymXVzD.png "Screenshot of URL Organisation ID Highlighted in Yellow"

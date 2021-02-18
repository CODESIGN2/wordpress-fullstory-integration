=== fullstory WordPress reference integration ===
Contributors: LewisCowles,CD2Team
Tags: integrate, integration, ux, user experience, user-experience, fullstory, cd2, codesign2, lewiscowles, user behaviour, user recording, metrics, user insight, woocommerce analytics, woocommerce monitoring, customer profile, replay user session
Requires at least: 4.6
Tested up to: 5.7.0
Requires PHP: 5.6
Stable tag: 1.0.9
License: GPLv3

== Description ==
This plugin enables painless integration with WordPress (including WooCommerce) with the fullstory user-monitoring platform.

It adds a new settings page, where you simply enter your valid fullstory organisation ID, and you get data from your WordPress site.

The latest version has a helper so that you can paste a UI link from FullStory and automatically extract your Organisation ID.

This is still experimental, so below is the format expected.

    https://app.fullstory.com/ui/**{ORGID}**/segments/everyone/people/0
    
The plugin is also compatible with wp-cli automated deployment by injecting a define 'FULLSTORY_ORG' to the wp-config.php.

The plugin does no special work apart from ensuring that attributes are escaped in saved values before being used.

Care has been taken to supply the following filters, so that you can specify your own custom fullstory attributes.

* cd2_fstory_data (array)

If using custom filters, please note you are wholely responsible for not messing things up. I recommend using a sibling plugin rather than editing this one; as well as testing locally, perhaps in staging before deploying to production as FullStory does not love malformed data. The format of data is simply key-value in a PHP array which is merged with the default array.

This is a reference plugin, I'd love to develop it further, or work with you or your business to include additional features, perhaps a hooks interface or more formal view-separation for complex projects. I've used this on Multisite, Standard WP, multi-lingual sites.

== Changelog ==
= 1.0.9 =
**Added**

* N/A

**Changed**

* N/A

**Fixed**

* function rename error (sorry, for some reason this wasn't present on the dev-site)

= 1.0.8 =
**Added**

* Hook `cd2_enable_fstory` which allows custom plugins to disable the fullstory integration by returning false from filter. It's true by default. Just deactivate the plugin if you don't want to use.
* Hook `cd2_disable_fstory_admin` which allows custom plugins to enable fullstory integration in the admin area by returning true from filter. Importantly, `cd2_enable_fstory` also needs to be true.
* Hook `cd2_fstory_debug_enable` which allows custom plugins to enable debug mode by returning true from filter.
* Hook `cd2_fstory_snippet` allows custom plugins to enable using alternative JavaScript when integrating with FullStory.
* Ability to edit FullStory plugin JavaScript using files (source control vs database call) by editing the plugin or creating a `snippet.js` within a `fullstory` directory, inside your `wp-content` direcotry.

**Changed**

* Reported WordPress compatibility (after tests).
* Disabling logic.
* Plugin source code (following moving to the CD2 org)

**Fixed**

* N/A

= 1.0.7 =
**Added**

* N/A

**Changed**

Reported WordPress compatibility (after tests)

**Fixed**

* N/A

= 1.0.6 =
**Added**

* Label & Standard WP Options Markup for LTR

**Changed**

* Options Page HTML

**Fixed**

* N/A

= 1.0.6 =
**Added**

* Separate settings page
* URL helper

**Changed**

* Separated settings page

**Fixed**

* N/A (Nothing was broken, but this was tested with WordPress 5.3.2)

= 1.0.4 =
**Added**

* N/A

**Changed**

* N/A

**Fixed**

* That awful (hasn't been tested with latest 3 major revisions) nonsense.

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


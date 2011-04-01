=== Galleria Galleria ===
Contributors: gluten
Donate link: https://github.com/samargulies/galleria-galleria/
Tags: photo, photos, gallery, galleries, photo gallery, lightbox 
Requires at least: 3.0
Tested up to: 3.1
Stable tag: 0.1.1

Transform standard WordPress galleries into galleria slideshows. 

== Description ==

Galleria Galleria is a fork of [Photo Galleria](http://wordpress.org/extend/plugins/photo-galleria/) that is designed to minimize resources and selectively load javascript. This plugin will only load javascript on pages that actually have a gallery. Galleria Galleria also keeps standard gallery styling if javascript is not enabled.  Beyond that, this plugin is built using the [Galleria javascript library](http://galleria.aino.se/) that allows for advanced theming and customization. 

== Installation ==

1. Upload the entire `galleria-galleria` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. All existing galleries inserted using the [gallery] shortcode will now use Galleria Galleria.

== Screenshots ==

1. The Galleria Galleria settings page
2. An example gallery
== Frequently Asked Questions ==

= How is this plugin different from other Wordpress gallery plugins? =
Galleria Galleria is designed to only selectively load javascript to reduce the load time of your site. It also works seamlessly with galleries you have already created for your site in Wordpress.

== Other Notes ==
This plugin uses the standard [gallery] shortcode to create slideshows. It also adds support for a per gallery height attribute in the format [gallery height=500] to create a gallery with a height of 500px.

== Changelog ==

= Version 0.1.1 =
Display gallery where it is embedded instead of at the top of the post.

= Version 0.1 =
Initial commit

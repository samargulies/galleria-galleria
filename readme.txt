=== Galleria Galleria ===
Contributors: gluten
Donate link: https://github.com/samargulies/galleria-galleria/
Tags: photo, photos, gallery, galleries, photo gallery, lightbox 
Requires at least: 3.0
Tested up to: 3.1
Stable tag: 0.2

Transform standard WordPress galleries into galleria slideshows. 

== Description ==

Galleria Galleria is a fork of [Photo Galleria](http://wordpress.org/extend/plugins/photo-galleria/) that is designed to minimize resources and selectively load javascript. This plugin will only load javascript on pages that actually have a gallery. Galleria Galleria also keeps standard gallery styling if javascript is not enabled.  Beyond that, this plugin is built using the [Galleria javascript library](http://galleria.aino.se/) that allows for advanced theming and customization. 

Links: [github](https://github.com/samargulies/galleria-galleria/)

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
= How can I customize my galleries using this plugin? =
Galleria Galleria gives you a choice of two build-in themes, transitions and background color. Beyond that, it also supports custom built Galleria themes and [paid themes](http://galleria.aino.se/themes/) (see [other notes](http://wordpress.org/extend/plugins/galleria-galleria/other_notes/) for more information.

== Other Notes ==

= Gallery Shortcode =
This plugin uses the standard [gallery] shortcode to create slideshows. It also adds support for a per gallery height attribute in the format [gallery height=500] to create a gallery with a height of 500px.

= Custom Galleria Themes =
The [Galleria javascript library](http://galleria.aino.se/) uses themes to style your galleries. If you would like to customize the build-in themes or use a [paid theme](http://galleria.aino.se/themes/) add a `galleria-themes` directory inside your Wordpress theme directory (make sure to place your galleria theme javascript file directly within the `galleria-themes` directory.) When you visit the Galleria Galleria settings page your javascript file will appear in the design dropdown menu.

== Changelog ==

= Version 0.2 =
* Added ability to add custom galleria themes. To enable a custom galleria theme, add a `galleria-themes` directory inside your Wordpress theme directory (make sure to place your galleria theme javascript file directly within the `galleria-themes` directory.) When you visit the Galleria Galleria settings page your javascript file will appear in the design dropdown menu.

= Version 0.1.1 =
Display gallery where it is embedded instead of at the top of the post.

= Version 0.1 =
Initial commit

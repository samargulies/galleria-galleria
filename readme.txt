=== Plugin Name ===
Contributors: endortrails
Donate link: http://graphpaperpress.com/
Tags: photo, photos, gallery, galleries, photo gallery, lightbox 
Requires at least: 3.0
Tested up to: 3.1
Stable tag: 0.3.6

Photo Galleria is a simple, yet elegant, plugin for photographers and designers who want to beautify and streamline their WordPress photo galleries.

== Description ==

Photo Galleria is a simple, yet elegant, plugin for photographers and designers who want to beautify and simplify their WordPress photo galleries. The Photo Galleria plugin filters the default WordPress gallery shortcode and replaces it with an elegant jQuery-powered gallery.  Simply upload photos as normal and the Photo Galleria plugin will create a photo gallery with fade-in and fade-out effects common on flash-based websites. All the transitions happen inline without having to navigate to multiple WordPress attachment pages. This plugin comes with different design options, which you can select on the Photo Galleria Settings page.  Pretty neat, eh?

* [Live Demo](http://demo.graphpaperpress.com/photo-galleria/)
* [Release Info](http://graphpaperpress.com/2008/05/31/photo-galleria-plugin-for-wordpress/)
* [Support](http://graphpaperpress.com/support/)

== Installation ==

1. Upload the entire `photo-galleria` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. All existing galleries inserted using the [gallery] shortcode will now use Photo Galleria.

== Screenshots ==
1. Design options

== Frequently Asked Questions ==

= Why does mine not work? =

You likely have a plugin that is inserting a conflicting javascript (the stuff that runs Photo Galleria). Deactivate your plugins, one by one, to see which one is the culprit.  If that doesn't work, switch to the default WordPress theme to see if your theme is actually adding conflicting javascript.  If it is, consider upgrading to a theme that enqueues javascript the smart way.  Finally, delete your browser cache after completing the steps above.

= What about titles and captions? =

Yep.  If you got 'em, this plugin can display 'em  Just make sure you add yours to each image after uploading.

= Can I have multiple Photo Gallerias on my homepage, archive page, page or post? =

No.  Why?  Photo Galleria loads large images all at once.  If you have, say, 10 posts on your archive page, each containing 10 images, your users would have to wait for 100 large images to load before they could even begin to interact with your Photo Galleria.  This would make for a terrible user experience.

= How do I change colors, thumbnail sizes or icons? =

Virtually every aspect of each theme is customizable with CSS.  Themes are located here: /wp-content/plugins/photo-galleria/themes/
 
= How do I get help? =
http://graphpaperpress.com/support/

== Changelog ==

= Version 0.3.6 =
* Added new options
* Added support for multiple photo gallerias on home and archive pages
* Opera 11 bug fix
* Updated galleria.js to version 1.2 preprelease

= Version 0.3.5 =
* IE 7 & 8 bug fix

= Version 0.3.4 =
* Updated galleria.js to fix reported IE problems.
* Removed Lightbox theme.  It is no longer supported by galleria.js.
* Added CSS conditionally if set.

= Version 0.3.3 =
* Fixes for IE 6, 7 & 8.  Moved CSS to wp_header.

= Version 0.3.2 =
* Fixes for IE 7 & 8 thumbnail bug

= Version 0.3.1 =
* Added support for the lightbox theme
* Updated readme.txt

= Version 0.3.0 =
* Massive overhaul dudes and dudets!
* Upgraded to jQuery 1.4.2 and Galleria 1.2
* Added plugin options panel
* Added design options, including default Galleria themes
* Added common faq

= Version 0.2.9 =
* Fixed alt tag and background color

= Version 0.2.5 =
* Fixed gallery display on homepage and pages

= Version 0.2.4 =
* Fixed text wrapping issue

= Version 0.2.3 =
* Added caption/description support
* Added line breaks for more readable html output
* Updated readme.txt

= Version 0.2.2 =
* Updates styles

= Version 0.2.1 =
* Added screenshot
* Updated versions
* Added comments to code

= Version 0.2 =
* Now works with latest jquery (1.3.2)
* Uses enqueue_script
* Compressed CSS

= Version 0.1 =
Initial commit

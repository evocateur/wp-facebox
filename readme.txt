=== WP Facebox ===
Contributors: evocateur
Tags: facebox, lightbox, media, gallery
Requires at least: 2.5.1
Tested up to: 2.5.1
Stable tag: 1.2.2

Automagically invoke Facebox on gallery items and linked images in a post or page.

== Description ==

Takes [Facebox](http://famspam.com/facebox/) and wires it up for sweet WP action. Also makes julienne fries. Maybe.

== Installation ==

1. Unzip and upload the `wp-facebox` directory to `/wp-content/plugins/`
1. Activate the plugin through the 'Plugins' menu in WordPress
1. There is no step 3.\*

\* **Note**: *For advanced configuration, refer to the comments of the constructor method, located near the bottom of `wp-facebox.php`*

== Frequently Asked Questions ==

= What does this plugin do, exactly? =

1. For any image contained in a post that has been specified as linked to the image source (the default, e.g. a large image resized to 'medium' and linked to the larger version), add a `rel` attribute with the value `facebox`. This is accomplished as a filter on `the_content`.

2. *Any* linked content inside a shortcode gallery will demonstrate identical behaviour to those linked images in posts; viz., when clicked they will giggle and squee in delight, emitting sunshine and rainbow glitter.

Or, you know, a Facebook-style lightbox appears with the linked content.

== Screenshots ==

Go to the [Facebox](http://famspam.com/facebox/) site to see it in action.
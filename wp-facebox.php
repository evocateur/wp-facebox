<?php
/*
Plugin Name: WP FaceBox
Plugin URI: http://evocateur.org/projects/wp-facebox/
Description: Automagical Facebox for WordPress
Version: 0.4
Author: Daniel Stockman
Author URI: http://evocateur.org/
*/

function wp_facebox_rel_replace($content) {
	$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
	$replacement = '<a$1href=$2$3.$4$5 rel="facebox"$6>$7</a>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}

add_filter('the_content', 'wp_facebox_rel_replace');

function wp_facebox_header() {
	$root = get_option('siteurl') . '/wp-content/plugins/wp-facebox';

	echo <<<HTML
<link rel="stylesheet" type="text/css" href="{$root}/facebox.css" />\n
HTML;

	wp_enqueue_script('facebox', "{$root}/facebox.js", array('jquery'), '1.2');

	echo <<<HTML
<script type="text/javascript">
	jQuery(function($) {
		$("a[rel*='facebox']").facebox({
			loadingImage: {$root}/images/loading.gif,
			closeImage: {$root}/images/closelabel.gif
		});
	});
</script>\n
HTML;
}

add_action('wp_print_scripts', 'wp_facebox_header');

?>
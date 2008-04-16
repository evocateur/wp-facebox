<?php
/*
Plugin Name: WP Facebox
Plugin URI: http://evocateur.org/projects/wp-facebox/
Description: Automagical Facebox for WordPress
Version: 1.0
Author: Daniel Stockman
Author URI: http://evocateur.org/
*/
/*	Copyright 2008  Daniel Stockman <daniel.stockman@gmail.com>

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
*/

function wp_facebox_rel_replace( $content ) {
	$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
	$replacement = '<a$1href=$2$3.$4$5 rel="facebox"$6>$7</a>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}

add_filter( 'the_content', 'wp_facebox_rel_replace' );

function wp_facebox_header() {
	$root = get_option( 'siteurl' ) . '/wp-content/plugins/wp-facebox';

	echo <<<HTML
<link rel="stylesheet" type="text/css" href="{$root}/facebox.css" />
<script type="text/javascript">FACEBOX_ROOT = "{$root}";</script>\n
HTML;

	wp_enqueue_script( 'facebox', "{$root}/facebox.js", array('jquery'), '1.2' );

}

add_action( 'wp_print_scripts', 'wp_facebox_header' );

?>
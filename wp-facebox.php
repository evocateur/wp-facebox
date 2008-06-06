<?php
/*
Plugin Name: WP Facebox
Plugin URI: http://evocateur.org/projects/wp-facebox/
Description: Automagical Facebox for WordPress
Version: 1.2
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
/**
* WP Facebox
* 	julienne fries!
*/
class WP_Facebox {
	var $opts;
	var $site;
	var $home;
	var $root; // plugin root dir

	/*
		Utilities
	*/
	function header() {
		echo <<<HTML
	<link rel="stylesheet" type="text/css" href="{$this->root}/facebox.css" />
	<script type="text/javascript">	/* wp-facebox init */
	WPFB = { root: "{$this->root}", home: "{$this->home}", site: "{$this->site}" };
	WPFB.opts = { loadingImage: WPFB.root + '/images/loading.gif', closeImage: WPFB.root + '/images/closelabel.gif', opacity: 0.5 };
	</script>\n
HTML;
		wp_enqueue_script( 'facebox', "{$this->root}/facebox.js", array('jquery'), '1.2' );
	}

	function invoke_header() {
		$selectors = array();
		if ( $this->opts['do_default'] ) $selectors[] = "a[rel*='facebox']";
		if ( $this->opts['do_gallery'] ) $selectors[] = ".gallery-item a";
		$selectors = implode(', ', $selectors);
		if ( !empty($selectors) )
			echo "<script type=\"text/javascript\">if (jQuery && jQuery.facebox) jQuery(function($) { $(\"$selectors\").facebox(WPFB.opts); });</script>\n";
	}

	function rel_replace( $content ) {
		$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
		$replacement = '<a$1href=$2$3.$4$5 rel="facebox"$6>$7</a>';
		$content = preg_replace($pattern, $replacement, $content);
		return $content;
	}

	/*
		Init / Constructor
	*/
	function init() {
		if ( $this->opts['loadscript'] ) {
			add_action( 'wp_print_scripts', array(&$this, 'header') );
			add_action( 'wp_head',   array(&$this, 'invoke_header') );
		}
		if ( $this->opts['autofilter'] ) {
			add_filter( 'the_content', array(&$this, 'rel_replace') );
		}
	}

	function WP_Facebox() {	// constructor
		$this->opts = array(
			'autofilter' => 1,
			'do_default' => 1,
			'do_gallery' => 0,
			'loadscript' => 1
		);
		$this->home = get_option('home');
		$this->site = get_option('siteurl');
		$this->root = $this->site . '/wp-content/plugins/wp-facebox';
		$this->init();
	}
}

// make those julienne fries, baby
function wp_facebox_bootstrap() {
	global $wp_facebox;
	$wp_facebox = new WP_Facebox();
}

add_action( 'plugins_loaded', 'wp_facebox_bootstrap' );

?>
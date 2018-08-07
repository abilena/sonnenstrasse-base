<?php
/*
Plugin Name: Sonnenstrasse Base Shortcodes
Plugin URI: https://wordpress.org/plugins/sonnenstrasse-base/
Description: This plugin allows you to display style blocks in your posts using shortcodes.
Version: 1.00
Author: Klemens
Author URI: https://profiles.wordpress.org/Klemens#content-plugins
Text Domain: sonnenstrasse-base
*/ 

require_once('inc/template.class.php');
require_once('inc/sonnenstrasse-base-install.php'); 
require_once('inc/sonnenstrasse-base-templates.php'); 

// register_deactivation_hook(__FILE__, 'sonnenstrasse_base_uninstall');
// register_activation_hook(__FILE__, 'sonnenstrasse_base_install');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 'sonnenstrasse-base' Parchment Shortcode
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

add_shortcode ('aventurien-parchment', 'aventurien_parchment_shortcode');

function aventurien_parchment_shortcode($atts, $content) {

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

	extract(shortcode_atts(array(
		'title' => __('Parchment', 'parchment'),
		'name' => get_the_title(),
        'style' => 'default',
		'crest' => null,
		'type' => null
	), $atts));

	return sonnenstrasse_base_parchment_html($name, $content, $crest, $type);
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 'aventurien-shortcodes' Cover Shortcode
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

add_shortcode ('aventurien-cover', 'aventurien_cover_shortcode');

function aventurien_cover_shortcode($atts, $content) {

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

	extract(shortcode_atts(array(
		'title' => __('Cover', 'cover'),
        'image' => get_the_post_thumbnail_url(),
        'style' => 'default'
	), $atts));

	return sonnenstrasse_base_cover_html($image);
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 'aventurien-shortcodes' Cover Shortcode
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

add_shortcode ('aventurien-list', 'aventurien_list_shortcode');

function aventurien_list_shortcode($atts, $content) {

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
	
	if (!is_array($atts)) {
		$atts = array();
	}

	if (!isset($atts['id']) || !intval($atts['id'])) {
		$atts['id'] = get_the_ID();
	}

	if (!isset($atts['order']) || !$atts['order']) {
		$atts['order'] = 'asc';
	}

	if (!isset($atts['size']) || !$atts['size']) {
		$atts['size'] = 'normal';
	}

	$atts['title'] = $content;

	return sonnenstrasse_base_list_html($atts);
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 'aventurien-shortcodes' Date Shortcode
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

add_shortcode ('aventurien-date', 'aventurien_date_shortcode');

function aventurien_date_shortcode($atts, $content) {

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

	if (!isset($atts['date']) || !$atts['date']) {
		$atts['date'] = '1. PRA 1014 BF';
	}

	if (!isset($atts['location']) || !$atts['location']) {
		$atts['location'] = '';
	}

	if (!isset($atts['info']) || !$atts['info']) {
		$atts['info'] = '';
	}

	return sonnenstrasse_base_date_html($atts);
}

?>
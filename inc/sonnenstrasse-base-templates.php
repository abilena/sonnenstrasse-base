<?php

function sonnenstrasse_base_parchment_html($name, $content, $crest, $type) {

    $path_local = plugin_dir_path(__FILE__);
    $path_url = plugins_url() . "/sonnenstrasse-base";
	
	if (!isset($crest))
	{
		$crest = "dragon";
	}

	if (!isset($type))
	{
		$block_class = "aventurien-container-block";
		$parchment_class = "aventurien-parchment-cornered";
	}
	else
	{
		$block_class = "aventurien-container-block-$type";
		$parchment_class = "aventurien-parchment-$type";
	}

    $output = "";
    $template = new Sonnenstrasse\Template($path_local . "../tpl/parchment.html");
    $template->set("Name", $name);
    $template->set("Content", $content);
	$template->set("Crest", $crest);
	$template->set("BlockClass", $block_class);
	$template->set("ParchmentClass", $parchment_class);
    $output .= $template->output();

	return $output;
}

function sonnenstrasse_base_cover_html($image) {

    $path_local = plugin_dir_path(__FILE__);
    $path_url = plugins_url() . "/sonnenstrasse-base";

    $output = "";
    $template = new Sonnenstrasse\Template($path_local . "../tpl/cover.html");
    $template->set("Image", $image);
    $output .= $template->output();

	return $output;
}

function sonnenstrasse_base_list_html($atts) {

    $path_local = plugin_dir_path(__FILE__);
    $path_url = plugins_url() . "/sonnenstrasse-base";

    $args = array(
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_parent' => $atts['id'],
        'orderby' => 'menu_order',
        'order' => $atts['order'],
        'nopaging' => true,
    );

    $args = apply_filters('aventurien_list_query', $args, $atts);

    $items = "";
    $pages = get_posts($args);
    foreach ($pages as $post) {
        $url = esc_url(get_permalink($post->ID));
        $img = get_the_post_thumbnail_url($post->ID, 'full');
        // $img = preg_replace( '/(width|height)="\d*"\s/', "", $img);

        $item_template = new Sonnenstrasse\Template($path_local . "../tpl/listitem.html");
        $item_template->setObject($post);
        $item_template->set("URL", $url);
        $item_template->set("Thumbnail", $img);
        $item_template->set("Size", $atts['size']);
        $items .= $item_template->output();
    }

    $output = "";
    $template = new Sonnenstrasse\Template($path_local . "../tpl/list.html");
    $template->set("ID", $atts['id']);
    $template->set("Order", $atts['order']);
    $template->set("Title", $atts['title']);
    $template->set("Items", $items);
    $output .= $template->output();

	return $output;
}

function sonnenstrasse_base_date_html($atts) {
    
    $path_local = plugin_dir_path(__FILE__);
    $path_url = plugins_url() . "/sonnenstrasse-base";

    $day = "?";
    $month = "";
    $year = "";
    $style = "aventurien-date-unknown";
    preg_match_all('/(\d+)\. (\w+) (\d+) [Bb][Ff]/', $atts['date'], $matches);
    $count = count($matches[0]);
    if ($count > 0)
    {
        $day = $matches[1][0];
        $month = $matches[2][0];
        $year = $matches[3][0] . " BF";
        $style = "";
    }

    $output = "";
    $template = new Sonnenstrasse\Template($path_local . "../tpl/date.html");
    $template->set("Day", $day);
    $template->set("Month", $month);
    $template->set("Year", $year);
    $template->set("Style", $style);
    $template->set("Location", $atts['location']);
    $template->set("Info", $atts['info']);
    $template->set("Post", get_the_title());
    $template->set("Link", get_permalink());
    $output .= $template->output();

	return $output;
}

?>
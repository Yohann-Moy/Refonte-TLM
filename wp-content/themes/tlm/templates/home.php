<?php

/**
 * Template Name: La commune
 *
 * @package TLM
 * @author Karl Clémence
 */

    get_header();
    include_once(get_template_directory().'/template-parts/homepage/hero_banner.php');
    include_once(get_template_directory().'/template-parts/homepage/latest_news.php');
    include_once(get_template_directory().'/template-parts/homepage/latest_events.php');
    include_once(get_template_directory().'/template-parts/homepage/statistics.php');


    get_footer(); 
?>
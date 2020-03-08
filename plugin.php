<?php
/**
 * Plugin Name: JSON REST API Yoast routes 
 * Description: Adds Yoast fields to page and post metadata 
 * Author: jmfurlott<jmfurlott@gmail.com>
 * Author URI: https://jmfurlott.com
 * Author: nabilfreeman<nabil+oss@freemans.website>
 * Author URI: http://freemans.website
 * Version: 1.1.0
 * Plugin URI: https://github.com/jmfurlott/wp-api-yoast
 */

//for posts, pages and custom post types
function wp_api_encode_yoast_post($data, $post, $context) {
    $Id = $post->ID;
    $postType = $post->post_type;

    //Defaults from yoast search appearance section
    $yoast_wpseo_default_title = wpseo_replace_vars(get_option('wpseo_titles')["title-$postType"], $post);
    $yoast_wpseo_default_metadesc = wpseo_replace_vars(get_option('wpseo_titles')["metadesc-$postType"], $post);
    $yoast_wpseo_default_meta_robots_noindex = get_option('wpseo_titles')["noindex-$postType"];

    //Options specified in each post
    $yoast_wpseo_focuskw = get_post_meta($Id, '_yoast_wpseo_focuskw', true);
    $yoast_wpseo_title = wpseo_replace_vars(get_post_meta($Id, '_yoast_wpseo_title', true), $post);
    $yoast_wpseo_metadesc = wpseo_replace_vars(get_post_meta($Id, '_yoast_wpseo_metadesc', true), $post);
    $yoast_wpseo_linkdex = get_post_meta($post->ID, '_yoast_wpseo_linkdex', true);
    $yoast_wpseo_meta_robots_noindex = get_post_meta($Id, '_yoast_wpseo_meta-robots-noindex', true);
    $yoast_wpseo_meta_robots_nofollow = get_post_meta($Id, '_yoast_wpseo_meta-robots-nofollow', true);
    $yoast_wpseo_meta_robots_adv = get_post_meta($Id, '_yoast_wpseo_meta-robots-adv', true);
    $yoast_wpseo_canonical = get_post_meta($Id, '_yoast_wpseo_canonical', true);
    $yoast_wpseo_redirect = get_post_meta($Id, '_yoast_wpseo_redirect', true);
    $yoast_wpseo_opengraph_title = get_post_meta($Id, '_yoast_wpseo_opengraph-title', true);
    $yoast_wpseo_opengraph_description = get_post_meta($Id, '_yoast_wpseo_opengraph-description', true);
    $yoast_wpseo_opengraph_image = get_post_meta($Id, '_yoast_wpseo_opengraph-image', true);
    $yoast_wpseo_twitter_title = get_post_meta($Id, '_yoast_wpseo_twitter-title', true);
    $yoast_wpseo_twitter_description = get_post_meta($Id, '_yoast_wpseo_twitter-description', true);
    $yoast_wpseo_twitter_image = get_post_meta($Id, '_yoast_wpseo_twitter-image', true);

    //logic for noindex fallback. true = noindex. false = index.
    if ($yoast_wpseo_meta_robots_noindex =="noindex") {
        $yoast_wpseo_meta_robots_noindex = true;
    }
    else if($yoast_wpseo_meta_robots_noindex =="index") {
        $yoast_wpseo_meta_robots_noindex = false;
    }
    else {
        $yoast_wpseo_meta_robots_noindex = $yoast_wpseo_default_meta_robots_noindex;
    }

    $yoastMeta = array(   
        'yoast_wpseo_focuskw' =>  $yoast_wpseo_focuskw,
        'yoast_wpseo_title' => $yoast_wpseo_title == '' ? $yoast_wpseo_default_title : $yoast_wpseo_title,
        'yoast_wpseo_metadesc' => $yoast_wpseo_metadesc == '' ? $yoast_wpseo_default_metadesc : $yoast_wpseo_metadesc,
        'yoast_wpseo_linkdex' => $yoast_wpseo_linkdex,
        'yoast_wpseo_meta_robots_noindex' => $yoast_wpseo_meta_robots_noindex,
        'yoast_wpseo_meta_robots_nofollow' => $yoast_wpseo_meta_robots_nofollow == "" ? false : true,
        'yoast_wpseo_meta_robots_adv' => $yoast_wpseo_meta_robots_adv, 
        'yoast_wpseo_canonical' => $yoast_wpseo_canonical,
        'yoast_wpseo_redirect'=>$yoast_wpseo_redirect,
        'yoast_wpseo_opengraph_title' => $yoast_wpseo_opengraph_title,
        'yoast_wpseo_opengraph_description' => $yoast_wpseo_opengraph_description,
        'yoast_wpseo_opengraph_image' => $yoast_wpseo_opengraph_image,
        'yoast_wpseo_twitter_title' => $yoast_wpseo_twitter_title,
        'yoast_wpseo_twitter_description' => $yoast_wpseo_twitter_description,
        'yoast_wpseo_twitter_image' => $yoast_wpseo_twitter_image
    );

    $data->data['yoast_meta'] = (array) $yoastMeta;
    return $data;
}

//for categories, tags, and custom taxonomies
function wp_api_encode_yoast_taxonomy($data, $term, $context) {
    $Id = $term->term_id;
    $taxonomyType = $term->taxonomy;

    //Defaults from yoast search appearance section
    $yoast_wpseo_default_title = wpseo_replace_vars(get_option('wpseo_titles')["title-tax-$taxonomyType"], $term);
    $yoast_wpseo_default_metadesc = wpseo_replace_vars(get_option('wpseo_titles')["metadesc-tax-$taxonomyType"], $term);
    $yoast_wpseo_default_meta_robots_noindex = get_option('wpseo_titles')["noindex-tax-$taxonomyType"];

    //Options specified in each taxonomy
    $yoast_wpseo_focuskw = get_option('wpseo_taxonomy_meta')[$taxonomyType][$Id]['wpseo_focuskw'];
    $yoast_wpseo_title = wpseo_replace_vars(get_option('wpseo_taxonomy_meta')[$taxonomyType][$Id]['wpseo_title'], $term);
    $yoast_wpseo_metadesc = wpseo_replace_vars(get_option('wpseo_taxonomy_meta')[$taxonomyType][$Id]['wpseo_desc'], $term);
    $yoast_wpseo_linkdex = get_option('wpseo_taxonomy_meta')[$taxonomyType][$Id]['wpseo_linkdex'];
    $yoast_wpseo_meta_robots_noindex = get_option('wpseo_taxonomy_meta')[$taxonomyType][$Id]['wpseo_noindex'];
    $yoast_wpseo_canonical = get_option('wpseo_taxonomy_meta')[$taxonomyType][$Id]['wpseo_canonical'];
    $yoast_wpseo_canonical = get_option('wpseo_taxonomy_meta')[$taxonomyType][$Id]['wpseo_redirect'];
    $yoast_wpseo_opengraph_title = get_option('wpseo_taxonomy_meta')[$taxonomyType][$Id]['wpseo_opengraph-title'];
    $yoast_wpseo_opengraph_description = get_option('wpseo_taxonomy_meta')[$taxonomyType][$Id]['wpseo_opengraph-description'];
    $yoast_wpseo_opengraph_image = get_option('wpseo_taxonomy_meta')[$taxonomyType][$Id]['wpseo_opengraph-image'];
    $yoast_wpseo_twitter_title = get_option('wpseo_taxonomy_meta')[$taxonomyType][$Id]['wpseo_twitter-title'];
    $yoast_wpseo_twitter_description = get_option('wpseo_taxonomy_meta')[$taxonomyType][$Id]['wpseo_twitter-description'];
    $yoast_wpseo_twitter_image = get_option('wpseo_taxonomy_meta')[$taxonomyType][$Id]['wpseo_twitter-image'];

    //logic for noindex fallback. true = noindex. false = index.
    if ($yoast_wpseo_meta_robots_noindex =="noindex") {
        $yoast_wpseo_meta_robots_noindex = true;
    }
    else if($yoast_wpseo_meta_robots_noindex =="index") {
        $yoast_wpseo_meta_robots_noindex = false;
    }
    else {
        $yoast_wpseo_meta_robots_noindex = $yoast_wpseo_default_meta_robots_noindex;
    }
   
    $yoastMeta = array(    
        'yoast_wpseo_focuskw' =>  $yoast_wpseo_focuskw,
        'yoast_wpseo_title' => $yoast_wpseo_title =="" ? $yoast_wpseo_default_title : $yoast_wpseo_title,
        'yoast_wpseo_metadesc' =>  $yoast_wpseo_metadesc =="" ? $yoast_wpseo_default_metadesc : $yoast_wpseo_metadesc,     
        'yoast_wpseo_linkdex' => $yoast_wpseo_linkdex,
        'yoast_wpseo_meta_robots_noindex' => $yoast_wpseo_meta_robots_noindex,
        'yoast_wpseo_canonical' => $yoast_wpseo_canonical,
        'yoast_wpseo_redirect'=>$yoast_wpseo_redirect,
        'yoast_wpseo_opengraph_title' => is_null($yoast_wpseo_opengraph_title) ? "" : $yoast_wpseo_opengraph_title,
        'yoast_wpseo_opengraph_description' => is_null($yoast_wpseo_opengraph_description) ? "" : $yoast_wpseo_opengraph_description,
        'yoast_wpseo_opengraph_image' => is_null($yoast_wpseo_opengraph_image) ? "" : $yoast_wpseo_opengraph_image,
        'yoast_wpseo_twitter_title' => is_null($yoast_wpseo_twitter_title) ? "" : $yoast_wpseo_twitter_title,
        'yoast_wpseo_twitter_description' => is_null($yoast_wpseo_twitter_description) ? "" : $yoast_wpseo_twitter_description,
        'yoast_wpseo_twitter_image' => is_null($yoast_wpseo_twitter_image) ? "" : $yoast_wpseo_twitter_image
    );

    $data->data['yoast_meta'] = (array) $yoastMeta;
    return $data;
}

//can add to additional custom post types with 'rest_prepare_postTypeName'
add_filter('rest_prepare_post', 'wp_api_encode_yoast_post', 10, 3);
add_filter('rest_prepare_page', 'wp_api_encode_yoast_post', 10, 3);

//can add to additional custom taxonomies with 'rest_prepare_taxonomyName'
add_filter('rest_prepare_collection', 'wp_api_encode_yoast_taxonomy', 10, 3);
add_filter('rest_prepare_post_tag', 'wp_api_encode_yoast_taxonomy', 10, 3);

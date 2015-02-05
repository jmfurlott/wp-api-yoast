<?php
/**
 * Plugin Name: JSON REST API Yoast routes 
 * Description: Adds Yoast fields to page and post metadata 
 * Author: jmfurlott<jmfurlott@gmail.com>
 * Author URI: https://jmfurlott.com
 * Version: 0.1
 * Plugin URI: https://github.com/jmfurlott/wp-api-yoast
 */
function wp_api_encode_yoast($data, $post, $context) {
    $yoastMeta = array(
        'yoast_wpseo_focuskw' => get_post_meta($post['ID'], '_yoast_wpseo_focuskw', true),
        'yoast_wpseo_title' => get_post_meta($post['ID'], '_yoast_wpseo_title', true),
        'yoast_wpseo_metadesc' => get_post_meta($post['ID'], '_yoast_wpseo_metadesc', true),
        'yoast_wpseo_linkdex' => get_post_meta($post['ID'], '_yoast_wpseo_linkdex', true),
        'yoast_wpseo_metakeywords' => get_post_meta($post['ID'], '_yoast_wpseo_metakeywords', true),
        'yoast_wpseo_meta-robots-noindex' => get_post_meta($post['ID'], '_yoast_wpseo_meta-robots-noindex', true),
        'yoast_wpseo_meta-robots-nofollow' => get_post_meta($post['ID'], '_yoast_wpseo_meta-robots-nofollow', true),
        'yoast_wpseo_meta-robots-adv' => get_post_meta($post['ID'], '_yoast_wpseo_meta-robots-adv', true),
        'yoast_wpseo_canonical' => get_post_meta($post['ID'], '_yoast_wpseo_canonical', true),
        'yoast_wpseo_redirect' => get_post_meta($post['ID'], '_yoast_wpseo_redirect', true),
    );
    $customMeta = (array) get_fields($post['ID']);
    $data['meta'] = array_merge($data['meta'], $customMeta, $yoastMeta );
    return $data;
}

add_filter('json_prepare_post', 'wp_api_encode_yoast', 10, 3);
add_filter('json_prepare_page', 'wp_api_encode_yoast', 10, 3);
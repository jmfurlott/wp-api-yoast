<?php
/**
 * Plugin Name: JSON REST API Yoast routes 
 * Description: Adds Yoast fields to page and post metadata 
 * Author: jmfurlott<jmfurlott@gmail.com>
 * Author URI: https://jmfurlott.com
 * Version: 0.1.1
 * Plugin URI: https://github.com/jmfurlott/wp-api-yoast
 */
function wp_api_encode_yoast($data, $post, $context) {
    $yoastAttr = array(
        'yoast_wpseo_focuskw',
        'yoast_wpseo_title',
        'yoast_wpseo_metadesc',
        'yoast_wpseo_linkdex',
        'yoast_wpseo_metakeywords',
        'yoast_wpseo_meta-robots-noindex',
        'yoast_wpseo_meta-robots-nofollow',
        'yoast_wpseo_meta-robots-adv',
        'yoast_wpseo_canonical',
        'yoast_wpseo_redirect'
    );

    foreach ($yoastAttr as $attr) {
        $yoastMeta[$attr] = get_post_meta($post['ID'], '_'.$attr, true);
    }

    $data['yoast_meta'] = (array) $yoastMeta;

    return $data;
}

add_filter('json_prepare_post', 'wp_api_encode_yoast', 10, 3);
add_filter('json_prepare_page', 'wp_api_encode_yoast', 10, 3);

## WP API Yoast

Returns Yoast post or page metadata in a normal post or page request.  Stores the metadata in the `metadata` field of the returned data.

Works for custom post types and custom taxonomies.

*Note:* `yoast_wpseo_metakeywords` are deprecated.

### Currently fetching for pages & custom post types:
- `yoast_wpseo_focuskw`
- `yoast_wpseo_title`
- `yoast_wpseo_metadesc`
- `yoast_wpseo_linkdex`
- `yoast_wpseo_meta-robots-noindex`
- `yoast_wpseo_meta-robots-nofollow`
- `yoast_wpseo_meta-robots-adv`
- `yoast_wpseo_canonical`
- `yoast_wpseo_redirect`
- `yoast_wpseo_opengraph-title`
- `yoast_wpseo_opengraph-description`
- `yoast_wpseo_opengraph-image`
- `yoast_wpseo_twitter-title`
- `yoast_wpseo_twitter-description`
- `yoast_wpseo_twitter-image`

### Currently fetching for categories, tags and custom taxonomies:
- `yoast_wpseo_focuskw`
- `yoast_wpseo_title`
- `yoast_wpseo_metadesc`
- `yoast_wpseo_linkdex`
- `yoast_wpseo_meta-robots-noindex`
- `yoast_wpseo_canonical`
- `yoast_wpseo_redirect`
- `yoast_wpseo_opengraph-title`
- `yoast_wpseo_opengraph-description`
- `yoast_wpseo_opengraph-image`
- `yoast_wpseo_twitter-title`
- `yoast_wpseo_twitter-description`
- `yoast_wpseo_twitter-image`

### Fetching default snippets from Yoast SEO -> Search Appearance section:
- `index/noindex ("show posts in search results?")`
- `SEO title`
- `Meta Description`

Defaults are used in case post-specific or taxonomy-specific values are missing. Just like Yoast intended.

Tested with Wordpress **v5.3.2** and Yoast **v13.2**.

Thanks to [PanManAms/WP-JSON-API-ACF](https://github.com/PanManAms/WP-JSON-API-ACF) for the inspiration

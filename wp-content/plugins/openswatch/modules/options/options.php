<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function openwatch_optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = 'optionsframework_vna';
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('openswatch_options');
	$optionsframework_settings['id'] = $themename;

	update_option('openswatch_options', $optionsframework_settings);

}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function openwatch_optionsframework_options() {
    $attributes = array();
	if ( class_exists( 'WooCommerce' ) ) {
		$attribute_taxonomies = wc_get_attribute_taxonomies();
		$attributes = array();
		foreach($attribute_taxonomies as $attr)
		{
			if($attr->attribute_type == 'select')
			{
				$key = 'pa_'.$attr->attribute_name;
				$attributes[$key] = $attr->attribute_label;
			}
		}
	}




	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  OPENSWATCH_PATH. 'modules/options/images/';

	$options = array();

    //General setting

	$options[] = array(
		'name' => __('General Settings', 'openswatch'),
		'type' => 'heading' );


    if(!empty($attributes))
    {
        $tmp = array_keys($attributes);

        $options[] = array(
            'name' => __('Swatch style Attributes', 'openswatch'),
            'desc' => "",
            'id' => "openwatch_attribute_swatch",
            'std' => $tmp[0],
            'type' => "multicheck",
            'options' => $attributes
        );

        $options[] = array(
            'name' => __('Swatch Images Attributes', 'openswatch'),
            'desc' => "",
            'id' => "openwatch_attribute_image_swatch",
            'std' => $tmp[0],
            'type' => "radio",
            'options' => $attributes
        );

        $options[] = array(
            'name' => __('Swatch Attributes PreSelect', 'openswatch'),
            'desc' => "",
            'id' => "openwatch_attribute_pre_select",
            'std' => 0,
            'type' => "radio",
            'options' => array(0=>'No',1 => 'Yes')
        );
        $options[] = array(
            'name' => __('Show Swatch on List', 'openswatch'),
            'desc' => "",
            'id' => "openwatch_attribute_product_list",
            'std' => 1,
            'type' => "radio",
            'options' => array(0=>'No',1 => 'Yes')
        );


        $options[] = array(
            'name' => __('Price Filter', 'look'),
            'desc' => 'Sample: 100,200|$100-$200 (1 range per line).',
            'id'   => 'openwatch_price_range',
            'class' => 'small',
            'type' => 'textarea');

        $options[] = array(
            'name' => __('Attributes Tooltips', 'openswatch'),
            'desc' => "",
            'id' => "openwatch_attribute_tooltips",
            'std' => 1,
            'type' => "radio",
            'options' => array(0=>'No',1 => 'Yes')
        );
    }




	return $options;
}
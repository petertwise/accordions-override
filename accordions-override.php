<?php
/*
Plugin Name: Accordions Override
Plugin URI:  https://github.com/squarecandy/accordions-override
GitHub Plugin URI: https://github.com/squarecandy/accordions-override
Description: Adds some settings and removes some others from the PickPlugins "Accordion" plugin.
Version:     v1.0.0
Author:      Square Candy Design
Author URI:  http://squarecandydesign.com
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
Text Domain: squarecandy_accordions_override
*/

function squarecandy_accordions_override_acf() {
	// if ACF is enabled and user is an Admin
	if( function_exists('acf_add_local_field_group') && current_user_can('manage_options') ):
	// Add ACF fields box to control the speed and animation style
	acf_add_local_field_group(array(
		'key' => 'group_5be47c02a8c4e',
		'title' => 'Accordion Animation',
		'fields' => array(
			array(
				'key' => 'field_5be47c13103e2',
				'label' => 'Animation Style',
				'name' => 'accordions_animate_style',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'swing' => 'swing',
					'linear' => 'linear',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'swing',
				'layout' => 'horizontal',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_5be47c89103e3',
				'label' => 'Animation Speed',
				'name' => 'accordions_animate_delay',
				'type' => 'number',
				'instructions' => 'accordion animation speed in milliseconds (enter 1000 for a 1 second animation)',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 300,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => 5000,
				'step' => 1,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'accordions',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	endif;
}
add_action('init', 'squarecandy_accordions_override_acf');

// only admin users should be able to see the more complex settings
function squarecandy_accordions_override_css() {
	$screen = get_current_screen();
	if (
		! current_user_can('manage_options') &&
		'accordions' == $screen->post_type &&
		( 'post' == $screen->base || 'edit' == $screen->base )
	) {
		echo '<style>
			#shortcode .field-input > div:nth-child(n+2),
			#accordions_metabox li.tab-nav[data-id=options],
			#accordions_metabox li.tab-nav[data-id=style],
			#accordions_metabox li.tab-nav[data-id=custom_scripts],
			tr.type-accordions .column-shortcode textarea {
				display: none;
			}
		</style>';
	}
}
add_action('admin_head', 'squarecandy_accordions_override_css');

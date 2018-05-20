<?php
/**
 * fstore Theme Customizer
 *
 * @package fstore
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fstore_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_section("theme", array(
		"title" => __("Fstore Theme", "fstore"),
		"priority" => 30,
	));

	////// Footer text
	$wp_customize->add_setting("footer-text", array(
		"type" => "option",
		"default" => "",
		"transport" => "postMessage",
		'sanitize_callback' => '',
		'sanitize_js_callback' => '' // Basically to_json.
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"footer-text",
		array(
			"label" => __("Footer text", "fstore"),
			"section" => "theme",
			"settings" => "footer-text",
			"type" => "textarea"
		)
	));

	////// Footer logo
	$wp_customize->add_setting("footer-logo", array(
		"type" => "theme_mod"
	));

	$wp_customize->add_control(new WP_Customize_Media_Control(
		$wp_customize,
		"footer-logo",
		array(
			"label" => __("Footer logo", "fstore"),
			"section" => "theme",
			"settings" => "footer-logo"
		)
	));

	////// Footer social
	$wp_customize->add_setting("footer-social", array(
		"type" => "option",
		"default" => "",
		"transport" => "postMessage",
		'sanitize_callback' => '',
		'sanitize_js_callback' => '' // Basically to_json.
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"footer-social",
		array(
			"label" => __("Footer social", "fstore"),
			"section" => "theme",
			"settings" => "footer-social",
			"type" => "textarea"
		)
	));

}
add_action( 'customize_register', 'fstore_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fstore_customize_preview_js() {
	wp_enqueue_script( 'fstore_customizer', get_template_directory_uri() . '/js/customizer.min.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'fstore_customize_preview_js' );

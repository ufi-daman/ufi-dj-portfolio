<?php
/**
 * UFI DA MAN Theme Customizer Settings
 *
 * @package ufi-daman
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register customizer settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function ufi_customize_register( $wp_customize ) {

	// -------------------------------------------------------------------------
	// Section: Contact & Social
	// -------------------------------------------------------------------------
	$wp_customize->add_section(
		'ufi_contact_social',
		array(
			'title'    => __( 'Contact & Social', 'ufi-daman' ),
			'priority' => 30,
		)
	);

	// Booking email
	$wp_customize->add_setting(
		'ufi_email',
		array(
			'default'           => 'booking@ufidaman.com',
			'sanitize_callback' => 'sanitize_email',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'ufi_email',
		array(
			'label'   => __( 'Booking Email', 'ufi-daman' ),
			'section' => 'ufi_contact_social',
			'type'    => 'email',
		)
	);

	// Resident Advisor URL
	$wp_customize->add_setting(
		'ufi_ra_url',
		array(
			'default'           => 'https://ra.co/dj/ufidaman',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'ufi_ra_url',
		array(
			'label'   => __( 'Resident Advisor URL', 'ufi-daman' ),
			'section' => 'ufi_contact_social',
			'type'    => 'url',
		)
	);

	// SoundCloud URL
	$wp_customize->add_setting(
		'ufi_sc_url',
		array(
			'default'           => 'https://soundcloud.com/ufi-daman',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'ufi_sc_url',
		array(
			'label'   => __( 'SoundCloud URL', 'ufi-daman' ),
			'section' => 'ufi_contact_social',
			'type'    => 'url',
		)
	);

	// Mixcloud URL
	$wp_customize->add_setting(
		'ufi_mixcloud_url',
		array(
			'default'           => 'https://www.mixcloud.com/ufidaman/',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'ufi_mixcloud_url',
		array(
			'label'   => __( 'Mixcloud URL', 'ufi-daman' ),
			'section' => 'ufi_contact_social',
			'type'    => 'url',
		)
	);

	// Facebook URL
	$wp_customize->add_setting(
		'ufi_fb_url',
		array(
			'default'           => 'https://www.facebook.com/ufi.daman.official',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'ufi_fb_url',
		array(
			'label'   => __( 'Facebook URL', 'ufi-daman' ),
			'section' => 'ufi_contact_social',
			'type'    => 'url',
		)
	);

	// Instagram URL
	$wp_customize->add_setting(
		'ufi_ig_url',
		array(
			'default'           => 'https://www.instagram.com/ufi.daman',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'ufi_ig_url',
		array(
			'label'   => __( 'Instagram URL', 'ufi-daman' ),
			'section' => 'ufi_contact_social',
			'type'    => 'url',
		)
	);

	// Press Kit URL
	$wp_customize->add_setting(
		'ufi_presskit_url',
		array(
			'default'           => 'https://drive.google.com/drive/folders/1BA8sYOZWWrFfgCezI_Dr7Xrk2-Ju-gpX',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'ufi_presskit_url',
		array(
			'label'   => __( 'Press Kit URL (Google Drive)', 'ufi-daman' ),
			'section' => 'ufi_contact_social',
			'type'    => 'url',
		)
	);

	// Sound Events URL
	$wp_customize->add_setting(
		'ufi_soundevents_url',
		array(
			'default'           => 'https://www.soundevents.cz',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'ufi_soundevents_url',
		array(
			'label'   => __( 'Sound Events URL', 'ufi-daman' ),
			'section' => 'ufi_contact_social',
			'type'    => 'url',
		)
	);
}
add_action( 'customize_register', 'ufi_customize_register' );

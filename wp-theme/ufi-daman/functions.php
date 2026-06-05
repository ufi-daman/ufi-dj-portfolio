<?php
/**
 * UFI DA MAN Theme Functions
 *
 * @package ufi-daman
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// -------------------------------------------------------------------------
// 1. Theme Support
// -------------------------------------------------------------------------
function ufi_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'elementor' );
}
add_action( 'after_setup_theme', 'ufi_theme_setup' );

// -------------------------------------------------------------------------
// 2. Enqueue Scripts & Styles
// -------------------------------------------------------------------------
function ufi_enqueue_assets() {
	// Google Fonts
	wp_enqueue_style(
		'ufi-google-fonts',
		'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Space+Mono:wght@400;700&display=swap',
		array(),
		null
	);

	// Font Awesome CDN
	wp_enqueue_style(
		'ufi-font-awesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
		array(),
		'6.5.0'
	);

	// Main theme stylesheet
	wp_enqueue_style(
		'ufi-style',
		get_stylesheet_uri(),
		array( 'ufi-google-fonts', 'ufi-font-awesome' ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'ufi_enqueue_assets' );

// -------------------------------------------------------------------------
// 3. CPT: ufi_event
// -------------------------------------------------------------------------
function ufi_register_cpt_event() {
	$labels = array(
		'name'               => __( 'Events', 'ufi-daman' ),
		'singular_name'      => __( 'Event', 'ufi-daman' ),
		'add_new'            => __( 'Add New', 'ufi-daman' ),
		'add_new_item'       => __( 'Add New Event', 'ufi-daman' ),
		'edit_item'          => __( 'Edit Event', 'ufi-daman' ),
		'new_item'           => __( 'New Event', 'ufi-daman' ),
		'view_item'          => __( 'View Event', 'ufi-daman' ),
		'search_items'       => __( 'Search Events', 'ufi-daman' ),
		'not_found'          => __( 'No events found', 'ufi-daman' ),
		'not_found_in_trash' => __( 'No events found in Trash', 'ufi-daman' ),
		'menu_name'          => __( 'Events', 'ufi-daman' ),
	);

	register_post_type(
		'ufi_event',
		array(
			'labels'      => $labels,
			'public'      => false,
			'show_ui'     => true,
			'menu_icon'   => 'dashicons-calendar-alt',
			'supports'    => array( 'title' ),
			'rewrite'     => false,
		)
	);
}
add_action( 'init', 'ufi_register_cpt_event' );

// Meta box: Event Details
function ufi_add_event_meta_box() {
	add_meta_box(
		'ufi_event_details',
		__( 'Event Details', 'ufi-daman' ),
		'ufi_render_event_meta_box',
		'ufi_event',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'ufi_add_event_meta_box' );

function ufi_render_event_meta_box( $post ) {
	wp_nonce_field( 'ufi_save_event_meta', 'ufi_event_meta_nonce' );

	$status     = get_post_meta( $post->ID, '_ufi_event_status', true );
	$day        = get_post_meta( $post->ID, '_ufi_event_day', true );
	$month      = get_post_meta( $post->ID, '_ufi_event_month', true );
	$year       = get_post_meta( $post->ID, '_ufi_event_year', true );
	$location   = get_post_meta( $post->ID, '_ufi_event_location', true );
	$tag        = get_post_meta( $post->ID, '_ufi_event_tag', true );
	$ticket_url = get_post_meta( $post->ID, '_ufi_event_ticket_url', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="ufi_event_status"><?php esc_html_e( 'Status', 'ufi-daman' ); ?></label></th>
			<td>
				<select id="ufi_event_status" name="ufi_event_status">
					<option value="upcoming" <?php selected( $status, 'upcoming' ); ?>><?php esc_html_e( 'Upcoming', 'ufi-daman' ); ?></option>
					<option value="past" <?php selected( $status, 'past' ); ?>><?php esc_html_e( 'Past', 'ufi-daman' ); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<th><label for="ufi_event_day"><?php esc_html_e( 'Day', 'ufi-daman' ); ?></label></th>
			<td>
				<input type="text" id="ufi_event_day" name="ufi_event_day" value="<?php echo esc_attr( $day ); ?>" placeholder="<?php esc_attr_e( 'e.g. 15', 'ufi-daman' ); ?>" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th><label for="ufi_event_month"><?php esc_html_e( 'Month', 'ufi-daman' ); ?></label></th>
			<td>
				<input type="text" id="ufi_event_month" name="ufi_event_month" value="<?php echo esc_attr( $month ); ?>" placeholder="<?php esc_attr_e( 'e.g. MAR', 'ufi-daman' ); ?>" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th><label for="ufi_event_year"><?php esc_html_e( 'Year', 'ufi-daman' ); ?></label></th>
			<td>
				<input type="text" id="ufi_event_year" name="ufi_event_year" value="<?php echo esc_attr( $year ); ?>" placeholder="<?php esc_attr_e( 'e.g. 2025', 'ufi-daman' ); ?>" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th><label for="ufi_event_location"><?php esc_html_e( 'Location', 'ufi-daman' ); ?></label></th>
			<td>
				<input type="text" id="ufi_event_location" name="ufi_event_location" value="<?php echo esc_attr( $location ); ?>" placeholder="<?php esc_attr_e( 'e.g. Prague · Techno', 'ufi-daman' ); ?>" class="regular-text" />
				<p class="description"><?php esc_html_e( 'Venue name is the post Title.', 'ufi-daman' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="ufi_event_tag"><?php esc_html_e( 'Tag', 'ufi-daman' ); ?></label></th>
			<td>
				<input type="text" id="ufi_event_tag" name="ufi_event_tag" value="<?php echo esc_attr( $tag ); ?>" placeholder="<?php esc_attr_e( 'e.g. Live', 'ufi-daman' ); ?>" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th><label for="ufi_event_ticket_url"><?php esc_html_e( 'Ticket URL', 'ufi-daman' ); ?></label></th>
			<td>
				<input type="url" id="ufi_event_ticket_url" name="ufi_event_ticket_url" value="<?php echo esc_attr( $ticket_url ); ?>" placeholder="https://" class="large-text" />
			</td>
		</tr>
	</table>
	<?php
}

function ufi_save_event_meta( $post_id ) {
	if ( ! isset( $_POST['ufi_event_meta_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ufi_event_meta_nonce'] ) ), 'ufi_save_event_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$fields = array(
		'ufi_event_status'     => '_ufi_event_status',
		'ufi_event_day'        => '_ufi_event_day',
		'ufi_event_month'      => '_ufi_event_month',
		'ufi_event_year'       => '_ufi_event_year',
		'ufi_event_location'   => '_ufi_event_location',
		'ufi_event_tag'        => '_ufi_event_tag',
	);

	foreach ( $fields as $field => $meta_key ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, $meta_key, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
		}
	}

	// Ticket URL
	if ( isset( $_POST['ufi_event_ticket_url'] ) ) {
		update_post_meta( $post_id, '_ufi_event_ticket_url', esc_url_raw( wp_unslash( $_POST['ufi_event_ticket_url'] ) ) );
	}
}
add_action( 'save_post_ufi_event', 'ufi_save_event_meta' );

// -------------------------------------------------------------------------
// 4. CPT: ufi_mix
// -------------------------------------------------------------------------
function ufi_register_cpt_mix() {
	$labels = array(
		'name'               => __( 'Mixes', 'ufi-daman' ),
		'singular_name'      => __( 'Mix', 'ufi-daman' ),
		'add_new'            => __( 'Add New', 'ufi-daman' ),
		'add_new_item'       => __( 'Add New Mix', 'ufi-daman' ),
		'edit_item'          => __( 'Edit Mix', 'ufi-daman' ),
		'new_item'           => __( 'New Mix', 'ufi-daman' ),
		'view_item'          => __( 'View Mix', 'ufi-daman' ),
		'search_items'       => __( 'Search Mixes', 'ufi-daman' ),
		'not_found'          => __( 'No mixes found', 'ufi-daman' ),
		'not_found_in_trash' => __( 'No mixes found in Trash', 'ufi-daman' ),
		'menu_name'          => __( 'Mixes', 'ufi-daman' ),
	);

	register_post_type(
		'ufi_mix',
		array(
			'labels'    => $labels,
			'public'    => false,
			'show_ui'   => true,
			'menu_icon' => 'dashicons-controls-play',
			'supports'  => array( 'title' ),
			'rewrite'   => false,
		)
	);
}
add_action( 'init', 'ufi_register_cpt_mix' );

// Meta box: Mix Details
function ufi_add_mix_meta_box() {
	add_meta_box(
		'ufi_mix_details',
		__( 'Mix Details', 'ufi-daman' ),
		'ufi_render_mix_meta_box',
		'ufi_mix',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'ufi_add_mix_meta_box' );

function ufi_render_mix_meta_box( $post ) {
	wp_nonce_field( 'ufi_save_mix_meta', 'ufi_mix_meta_nonce' );

	$order  = get_post_meta( $post->ID, '_ufi_mix_order', true );
	$detail = get_post_meta( $post->ID, '_ufi_mix_detail', true );
	$sc_url = get_post_meta( $post->ID, '_ufi_mix_sc_url', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="ufi_mix_order"><?php esc_html_e( 'Order', 'ufi-daman' ); ?></label></th>
			<td>
				<input type="number" id="ufi_mix_order" name="ufi_mix_order" value="<?php echo esc_attr( $order ); ?>" min="1" class="small-text" />
				<p class="description"><?php esc_html_e( 'Display order (1 = first).', 'ufi-daman' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="ufi_mix_detail"><?php esc_html_e( 'Detail', 'ufi-daman' ); ?></label></th>
			<td>
				<input type="text" id="ufi_mix_detail" name="ufi_mix_detail" value="<?php echo esc_attr( $detail ); ?>" placeholder="<?php esc_attr_e( 'e.g. 2025 · Techno / House', 'ufi-daman' ); ?>" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th><label for="ufi_mix_sc_url"><?php esc_html_e( 'SoundCloud Embed URL', 'ufi-daman' ); ?></label></th>
			<td>
				<input type="url" id="ufi_mix_sc_url" name="ufi_mix_sc_url" value="<?php echo esc_attr( $sc_url ); ?>" placeholder="https://w.soundcloud.com/player/?url=..." class="large-text" />
				<p class="description"><?php esc_html_e( 'Full SoundCloud iframe src URL.', 'ufi-daman' ); ?></p>
			</td>
		</tr>
	</table>
	<?php
}

function ufi_save_mix_meta( $post_id ) {
	if ( ! isset( $_POST['ufi_mix_meta_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ufi_mix_meta_nonce'] ) ), 'ufi_save_mix_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['ufi_mix_order'] ) ) {
		update_post_meta( $post_id, '_ufi_mix_order', absint( $_POST['ufi_mix_order'] ) );
	}
	if ( isset( $_POST['ufi_mix_detail'] ) ) {
		update_post_meta( $post_id, '_ufi_mix_detail', sanitize_text_field( wp_unslash( $_POST['ufi_mix_detail'] ) ) );
	}
	if ( isset( $_POST['ufi_mix_sc_url'] ) ) {
		update_post_meta( $post_id, '_ufi_mix_sc_url', esc_url_raw( wp_unslash( $_POST['ufi_mix_sc_url'] ) ) );
	}
}
add_action( 'save_post_ufi_mix', 'ufi_save_mix_meta' );

// -------------------------------------------------------------------------
// 5. Customizer
// -------------------------------------------------------------------------
require get_template_directory() . '/inc/customizer.php';

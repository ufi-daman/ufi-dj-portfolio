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
	$date       = get_post_meta( $post->ID, '_ufi_event_date', true ) ?: date( 'Y-m-d' );
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
			<th><label for="ufi_event_date"><?php esc_html_e( 'Date (for ordering)', 'ufi-daman' ); ?></label></th>
			<td>
				<input type="date" id="ufi_event_date" name="ufi_event_date" value="<?php echo esc_attr( $date ); ?>" class="regular-text" />
				<p class="description"><?php esc_html_e( 'Used for correct chronological ordering.', 'ufi-daman' ); ?></p>
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
		'ufi_event_date'       => '_ufi_event_date',
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
			<th><label for="ufi_mix_sc_url"><?php esc_html_e( 'SoundCloud Embed', 'ufi-daman' ); ?></label></th>
			<td>
				<textarea id="ufi_mix_sc_url" name="ufi_mix_sc_url" rows="5" class="large-text" placeholder="&lt;iframe ... src=&quot;https://w.soundcloud.com/player/?url=...&quot;&gt;&lt;/iframe&gt;"><?php echo esc_textarea( $sc_url ); ?></textarea>
				<p class="description"><?php esc_html_e( 'Paste the full embed code from SoundCloud → Share → Embed (or Mixcloud/YouTube). A plain player URL also works.', 'ufi-daman' ); ?></p>
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
		$raw = trim( wp_unslash( $_POST['ufi_mix_sc_url'] ) );
		if ( false !== stripos( $raw, '<iframe' ) ) {
			// Full embed code: keep the iframe, strip everything else.
			$value = wp_kses( $raw, ufi_allowed_embed_html() );
		} else {
			// Plain player URL.
			$value = esc_url_raw( $raw );
		}
		update_post_meta( $post_id, '_ufi_mix_sc_url', $value );
	}
}
add_action( 'save_post_ufi_mix', 'ufi_save_mix_meta' );

/**
 * Allowed HTML for embedded players (iframe allowlist).
 */
function ufi_allowed_embed_html() {
	return array(
		'iframe' => array(
			'src'             => true,
			'width'           => true,
			'height'          => true,
			'frameborder'     => true,
			'allow'           => true,
			'allowfullscreen' => true,
			'scrolling'       => true,
			'loading'         => true,
			'title'           => true,
			'style'           => true,
			'referrerpolicy'  => true,
		),
	);
}

// -------------------------------------------------------------------------
// 4b. CPT: ufi_track (own productions)
// -------------------------------------------------------------------------
function ufi_register_cpt_track() {
	$labels = array(
		'name'               => __( 'Tracks', 'ufi-daman' ),
		'singular_name'      => __( 'Track', 'ufi-daman' ),
		'add_new'            => __( 'Add New', 'ufi-daman' ),
		'add_new_item'       => __( 'Add New Track', 'ufi-daman' ),
		'edit_item'          => __( 'Edit Track', 'ufi-daman' ),
		'new_item'           => __( 'New Track', 'ufi-daman' ),
		'view_item'          => __( 'View Track', 'ufi-daman' ),
		'search_items'       => __( 'Search Tracks', 'ufi-daman' ),
		'not_found'          => __( 'No tracks found', 'ufi-daman' ),
		'not_found_in_trash' => __( 'No tracks found in Trash', 'ufi-daman' ),
		'menu_name'          => __( 'Tracks', 'ufi-daman' ),
	);

	register_post_type(
		'ufi_track',
		array(
			'labels'    => $labels,
			'public'    => false,
			'show_ui'   => true,
			'menu_icon' => 'dashicons-album',
			'supports'  => array( 'title' ),
			'rewrite'   => false,
		)
	);
}
add_action( 'init', 'ufi_register_cpt_track' );

function ufi_add_track_meta_box() {
	add_meta_box(
		'ufi_track_details',
		__( 'Track Details', 'ufi-daman' ),
		'ufi_render_track_meta_box',
		'ufi_track',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'ufi_add_track_meta_box' );

function ufi_render_track_meta_box( $post ) {
	wp_nonce_field( 'ufi_save_track_meta', 'ufi_track_meta_nonce' );

	$order  = get_post_meta( $post->ID, '_ufi_track_order', true );
	$detail = get_post_meta( $post->ID, '_ufi_track_detail', true );
	$embed  = get_post_meta( $post->ID, '_ufi_track_embed', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="ufi_track_order"><?php esc_html_e( 'Order', 'ufi-daman' ); ?></label></th>
			<td>
				<input type="number" id="ufi_track_order" name="ufi_track_order" value="<?php echo esc_attr( $order ); ?>" min="1" class="small-text" />
				<p class="description"><?php esc_html_e( 'Display order (1 = first).', 'ufi-daman' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="ufi_track_detail"><?php esc_html_e( 'Detail', 'ufi-daman' ); ?></label></th>
			<td>
				<input type="text" id="ufi_track_detail" name="ufi_track_detail" value="<?php echo esc_attr( $detail ); ?>" placeholder="<?php esc_attr_e( 'e.g. 2025 · Original / Ableton', 'ufi-daman' ); ?>" class="regular-text" />
			</td>
		</tr>
		<tr>
			<th><label for="ufi_track_embed"><?php esc_html_e( 'Embed', 'ufi-daman' ); ?></label></th>
			<td>
				<textarea id="ufi_track_embed" name="ufi_track_embed" rows="5" class="large-text" placeholder="&lt;iframe ... src=&quot;https://w.soundcloud.com/player/?url=...&quot;&gt;&lt;/iframe&gt;"><?php echo esc_textarea( $embed ); ?></textarea>
				<p class="description"><?php esc_html_e( 'Paste the full embed code from SoundCloud / Spotify / Bandcamp / YouTube. A plain player URL also works.', 'ufi-daman' ); ?></p>
			</td>
		</tr>
	</table>
	<?php
}

function ufi_save_track_meta( $post_id ) {
	if ( ! isset( $_POST['ufi_track_meta_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ufi_track_meta_nonce'] ) ), 'ufi_save_track_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['ufi_track_order'] ) ) {
		update_post_meta( $post_id, '_ufi_track_order', absint( $_POST['ufi_track_order'] ) );
	}
	if ( isset( $_POST['ufi_track_detail'] ) ) {
		update_post_meta( $post_id, '_ufi_track_detail', sanitize_text_field( wp_unslash( $_POST['ufi_track_detail'] ) ) );
	}
	if ( isset( $_POST['ufi_track_embed'] ) ) {
		$raw = trim( wp_unslash( $_POST['ufi_track_embed'] ) );
		if ( false !== stripos( $raw, '<iframe' ) ) {
			$value = wp_kses( $raw, ufi_allowed_embed_html() );
		} else {
			$value = esc_url_raw( $raw );
		}
		update_post_meta( $post_id, '_ufi_track_embed', $value );
	}
}
add_action( 'save_post_ufi_track', 'ufi_save_track_meta' );

// -------------------------------------------------------------------------
// 5. CPT: ufi_photo (Gallery)
// -------------------------------------------------------------------------
function ufi_register_cpt_photo() {
	register_post_type(
		'ufi_photo',
		array(
			'labels'    => array(
				'name'               => __( 'Gallery', 'ufi-daman' ),
				'singular_name'      => __( 'Photo', 'ufi-daman' ),
				'add_new_item'       => __( 'Add New Photo', 'ufi-daman' ),
				'edit_item'          => __( 'Edit Photo', 'ufi-daman' ),
				'not_found'          => __( 'No photos found', 'ufi-daman' ),
				'menu_name'          => __( 'Gallery', 'ufi-daman' ),
			),
			'public'    => false,
			'show_ui'   => true,
			'menu_icon' => 'dashicons-format-image',
			'supports'  => array( 'title', 'thumbnail' ),
			'rewrite'   => false,
		)
	);
}
add_action( 'init', 'ufi_register_cpt_photo' );

function ufi_add_photo_meta_box() {
	add_meta_box(
		'ufi_photo_order',
		__( 'Display Order', 'ufi-daman' ),
		'ufi_render_photo_meta_box',
		'ufi_photo',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'ufi_add_photo_meta_box' );

function ufi_render_photo_meta_box( $post ) {
	wp_nonce_field( 'ufi_save_photo_meta', 'ufi_photo_meta_nonce' );
	$order = get_post_meta( $post->ID, '_ufi_photo_order', true );
	?>
	<label>
		<?php esc_html_e( 'Order:', 'ufi-daman' ); ?>
		<input type="number" name="ufi_photo_order" value="<?php echo esc_attr( $order ); ?>" min="1" class="small-text" style="margin-left:8px" />
	</label>
	<p class="description" style="margin-top:8px"><?php esc_html_e( '1 = first in gallery. Caption = post Title.', 'ufi-daman' ); ?></p>
	<?php
}

function ufi_save_photo_meta( $post_id ) {
	if ( ! isset( $_POST['ufi_photo_meta_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ufi_photo_meta_nonce'] ) ), 'ufi_save_photo_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['ufi_photo_order'] ) ) {
		update_post_meta( $post_id, '_ufi_photo_order', absint( $_POST['ufi_photo_order'] ) );
	}
}
add_action( 'save_post_ufi_photo', 'ufi_save_photo_meta' );

// -------------------------------------------------------------------------
// 6. Customizer
// -------------------------------------------------------------------------
require get_template_directory() . '/inc/customizer.php';

// -------------------------------------------------------------------------
// 7. Auto-create Bio page on theme activation
// -------------------------------------------------------------------------
function ufi_create_default_pages() {
	if ( get_page_by_path( 'bio' ) ) {
		return;
	}
	wp_insert_post( array(
		'post_title'   => 'Bio',
		'post_name'    => 'bio',
		'post_status'  => 'publish',
		'post_type'    => 'page',
		'post_content' =>
			"<p><strong>UFI DA MAN</strong> is a Prague DJ and producer who constantly moves on the edge of the underground and mainstream scene. He found a relationship with electronic music in <strong>1993</strong> when he first started experimenting with Tracker-type programs.</p>\n\n" .
			"<p>Today, he mainly produces in <strong>Ableton</strong> in combination with <strong>NI Maschine</strong> and presents his work independently on SoundCloud, where he also searches for the latest productions of underground artists, which he likes to include in his sets since <strong>2006</strong> — for the first time behind the mix at Smart Club ST.YX.</p>\n\n" .
			"<p>For a long time, Ufi was a resident of the Prague club <strong>TOUSTER</strong>, where he had the opportunity to play not only with top Czech DJs but also with foreign guests. Currently a resident DJ of <strong>SOUND</strong>. He performs regularly at Roxy Prague, Roxy Room8, Radost FX, Cross][Club, Duplex Rooftop Venue, Hilton Cloud9, Vinyl Bar Prague, Beach Park Mlekojedy, U Bukanyra, NoD, Akropolis, Jilská 22 and at Centrála.</p>\n\n" .
			"<p>Even though in <strong>2016</strong> all seemed lost, thanks to the diagnosis of multiple sclerosis, he is back on the scene. Since <strong>2019</strong> participates in the organization of the electronic day/night open-air festival <strong>Sound</strong>.</p>\n\n" .
			"<p>Beyond the club scene, his sets have landed on the stages of some of the most celebrated Czech open-air festivals and events — <strong>SOUND</strong>, <strong>DARKSHIRE</strong>, <strong>SVOJŠICE</strong>, <strong>APOKALYPSA</strong>, <strong>MÁCHÁČ</strong>, <strong>CINDA</strong> and <strong>DOCK TOWN</strong>. Each stage a different crowd, the same relentless energy. He is always looking forward to the next opportunity to connect, move people and explore new sonic territory.</p>",
	) );
}
add_action( 'after_switch_theme', 'ufi_create_default_pages' );

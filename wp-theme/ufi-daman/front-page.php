<?php
/**
 * Front Page Template — full UFI DA MAN portfolio.
 *
 * @package ufi-daman
 */

get_header();

$soundevents_url = get_theme_mod( 'ufi_soundevents_url', 'https://www.soundevents.cz' );
$sc_url          = get_theme_mod( 'ufi_sc_url', 'https://soundcloud.com/ufi-daman' );
$ra_url          = get_theme_mod( 'ufi_ra_url', 'https://ra.co/dj/ufidaman' );
$mc_url          = get_theme_mod( 'ufi_mixcloud_url', 'https://www.mixcloud.com/ufidaman/' );
$fb_url          = get_theme_mod( 'ufi_fb_url', 'https://www.facebook.com/ufi.daman.official' );
$ig_url          = get_theme_mod( 'ufi_ig_url', 'https://www.instagram.com/ufi.daman' );
$pk_url          = get_theme_mod( 'ufi_presskit_url', 'https://drive.google.com/drive/folders/1BA8sYOZWWrFfgCezI_Dr7Xrk2-Ju-gpX' );
$email           = get_theme_mod( 'ufi_email', 'booking@ufidaman.com' );
$hero_bg         = get_theme_mod( 'ufi_hero_bg_image', '' );
$hero_tagline    = get_theme_mod( 'ufi_hero_tagline', 'Prague Independent Electronic Music Artist · DJ · Producer ·' );
$hero_role       = get_theme_mod( 'ufi_hero_role', 'Multiple Sclerosis fighter' );
$hero_style      = $hero_bg
	? ' style="background-image:linear-gradient(rgba(10,10,10,.75),rgba(10,10,10,.95)),url(' . esc_url( $hero_bg ) . ')"'
	: '';
?>

<!-- ======================================================
     HERO
     ====================================================== -->
<section class="hero"<?php echo $hero_style; // phpcs:ignore WordPress.Security.EscapeOutput -- escaped above ?>>
	<div class="hero-bg-number">82</div>
	<div class="hero-content">
		<p class="hero-index"><?php echo esc_html( $hero_tagline ); ?></p>
		<h1 class="hero-name">
			UFI
			<span class="highlight">DA MAN</span>
		</h1>
	</div>
	<div class="hero-bottom">
		<p class="hero-role">
			<?php echo esc_html( $hero_role ); ?><br>
			<a href="<?php echo esc_url( $soundevents_url ); ?>" target="_blank" rel="noopener noreferrer" class="sound-link"><strong><?php esc_html_e( 'SOUND', 'ufi-daman' ); ?></strong></a> <?php esc_html_e( 'events resident', 'ufi-daman' ); ?>
		</p>
		<p class="hero-scroll"><?php esc_html_e( 'Scroll', 'ufi-daman' ); ?></p>
	</div>
</section>

<!-- ======================================================
     MARQUEE
     ====================================================== -->
<div class="marquee-wrap" aria-hidden="true">
	<div class="marquee-track">
		<span class="marquee-item">Techno</span><span class="marquee-dot">◆</span>
		<span class="marquee-item">Retro</span><span class="marquee-dot">◆</span>
		<span class="marquee-item">HOUSE</span><span class="marquee-dot">◆</span>
		<span class="marquee-item">Electro</span><span class="marquee-dot">◆</span>
		<span class="marquee-item">Techno</span><span class="marquee-dot">◆</span>
		<span class="marquee-item">Retro</span><span class="marquee-dot">◆</span>
		<span class="marquee-item">HOUSE</span><span class="marquee-dot">◆</span>
		<span class="marquee-item">Electro</span><span class="marquee-dot">◆</span>
		<span class="marquee-item">Techno</span><span class="marquee-dot">◆</span>
		<span class="marquee-item">Retro</span><span class="marquee-dot">◆</span>
		<span class="marquee-item">HOUSE</span><span class="marquee-dot">◆</span>
		<span class="marquee-item">Electro</span><span class="marquee-dot">◆</span>
	</div>
</div>

<!-- ======================================================
     ABOUT
     ====================================================== -->
<section class="about" id="about">
	<div class="reveal">
		<p class="section-label"><?php esc_html_e( 'About', 'ufi-daman' ); ?></p>
		<h2 class="about-headline">UFI DA MAN</h2>
		<div class="about-text">
			<?php
			$bio_page = get_page_by_path( 'bio' );
			if ( $bio_page ) {
				echo wp_kses_post( apply_filters( 'the_content', $bio_page->post_content ) );
			} else {
				?>
			<p>
				<strong>UFI DA MAN</strong> <?php esc_html_e( 'is a Prague DJ and producer who constantly moves on the edge of the underground and mainstream scene. He found a relationship with electronic music in', 'ufi-daman' ); ?>
				<strong>1993</strong> <?php esc_html_e( 'when he first started experimenting with Tracker-type programs.', 'ufi-daman' ); ?>
			</p>
			<br>
			<p>
				<?php esc_html_e( 'Today, he mainly produces in', 'ufi-daman' ); ?> <strong>Ableton</strong> <?php esc_html_e( 'in combination with', 'ufi-daman' ); ?> <strong>NI Maschine</strong>
				<?php esc_html_e( 'and presents his work independently on SoundCloud, where he also searches for the latest productions of underground artists, which he likes to include in his sets since', 'ufi-daman' ); ?>
				<strong>2006</strong> — <?php esc_html_e( 'for the first time behind the mix at Smart Club ST.YX.', 'ufi-daman' ); ?>
			</p>
			<br>
			<p>
				<?php esc_html_e( 'For a long time, Ufi was a resident of the Prague club', 'ufi-daman' ); ?> <strong>TOUSTER</strong><?php esc_html_e( ', where he had the opportunity to play not only with top Czech DJs but also with foreign guests. Currently a resident DJ of', 'ufi-daman' ); ?>
				<strong>SOUND</strong>. <?php esc_html_e( 'He performs regularly at Roxy Prague, Roxy Room8, Radost FX, Cross][Club, Duplex Rooftop Venue, Hilton Cloud9, Vinyl Bar Prague, Beach Park Mlekojedy, U Bukanyra, NoD, Akropolis, Jilská 22 and at Centrála.', 'ufi-daman' ); ?>
			</p>
			<br>
			<p>
				<?php esc_html_e( 'Even though in', 'ufi-daman' ); ?> <strong>2016</strong> <?php esc_html_e( 'all seemed lost, thanks to the diagnosis of multiple sclerosis, he is back on the scene. Since', 'ufi-daman' ); ?>
				<strong>2019</strong> <?php esc_html_e( 'participates in the organization of the electronic day/night open-air festival', 'ufi-daman' ); ?> <strong>Sound</strong>.
			</p>
			<br>
			<p>
				<?php esc_html_e( 'Beyond the club scene, his sets have landed on the stages of some of the most celebrated Czech open-air festivals and events —', 'ufi-daman' ); ?>
				<strong>SOUND</strong>, <strong>DARKSHIRE</strong>, <strong>SVOJŠICE</strong>,
				<strong>APOKALYPSA</strong>, <strong>MÁCHÁČ</strong>, <strong>CINDA</strong> <?php esc_html_e( 'and', 'ufi-daman' ); ?>
				<strong>DOCK TOWN</strong>. <?php esc_html_e( 'Each stage a different crowd, the same relentless energy. He is always looking forward to the next opportunity to connect, move people and explore new sonic territory.', 'ufi-daman' ); ?>
			</p>
			<?php
			}
			?>
		</div>
	</div>
</section>

<!-- ======================================================
     GENRES
     ====================================================== -->
<div class="genres">
	<span class="genres-label"><?php esc_html_e( 'Genres', 'ufi-daman' ); ?></span>
	<div class="genre-tags">
		<span class="genre-tag">TECHNO</span>
		<span class="genre-tag">RETRO</span>
		<span class="genre-tag">HOUSE</span>
		<span class="genre-tag">ELECTRO</span>
	</div>
</div>

<!-- ======================================================
     EVENTS
     ====================================================== -->
<section class="events" id="events">
	<div class="gigs-header reveal">
		<h2 class="gigs-title"><?php esc_html_e( 'Events', 'ufi-daman' ); ?></h2>
	</div>

	<?php
	// Upcoming events — ordered by date ASC (soonest first)
	$upcoming_query = new WP_Query( array(
		'post_type'      => 'ufi_event',
		'posts_per_page' => -1,
		'meta_query'     => array(
			'relation'      => 'AND',
			'status_clause' => array(
				'key'   => '_ufi_event_status',
				'value' => 'upcoming',
			),
			'date_clause'   => array(
				'key'     => '_ufi_event_date',
				'compare' => 'EXISTS',
			),
		),
		'orderby'        => array( 'date_clause' => 'ASC' ),
	) );
	?>

	<div class="events-sub-label reveal"><?php esc_html_e( 'Upcoming', 'ufi-daman' ); ?></div>

	<?php if ( $upcoming_query->have_posts() ) : ?>
		<?php while ( $upcoming_query->have_posts() ) : $upcoming_query->the_post(); ?>
			<?php
			$day        = get_post_meta( get_the_ID(), '_ufi_event_day', true );
			$month      = get_post_meta( get_the_ID(), '_ufi_event_month', true );
			$location   = get_post_meta( get_the_ID(), '_ufi_event_location', true );
			$tag        = get_post_meta( get_the_ID(), '_ufi_event_tag', true );
			$ticket_url = get_post_meta( get_the_ID(), '_ufi_event_ticket_url', true );
			?>
			<div class="gig-row upcoming-row reveal">
				<div class="gig-date">
					<span class="gig-day"><?php echo esc_html( $day ); ?></span>
					<span class="gig-month"><?php echo esc_html( $month ); ?></span>
				</div>
				<div class="gig-info">
					<div class="gig-venue"><?php the_title(); ?></div>
					<?php if ( $location ) : ?>
					<div class="gig-location"><?php echo esc_html( $location ); ?></div>
					<?php endif; ?>
				</div>
				<?php if ( $ticket_url ) : ?>
				<a href="<?php echo esc_url( $ticket_url ); ?>" target="_blank" rel="noopener noreferrer" class="gig-ticket"><?php esc_html_e( 'Tickets →', 'ufi-daman' ); ?></a>
				<?php elseif ( $tag ) : ?>
				<div class="gig-tag"><?php echo esc_html( $tag ); ?></div>
				<?php endif; ?>
			</div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<div class="gig-row no-events reveal">
			<div class="gig-info">
				<div class="gig-venue"><?php esc_html_e( 'No upcoming events', 'ufi-daman' ); ?></div>
				<div class="gig-location"><?php esc_html_e( 'Check back soon', 'ufi-daman' ); ?></div>
			</div>
		</div>
	<?php endif; ?>

	<?php
	// Past events — ordered by date DESC (most recent first)
	$past_query = new WP_Query( array(
		'post_type'      => 'ufi_event',
		'posts_per_page' => -1,
		'meta_query'     => array(
			'relation'      => 'AND',
			'status_clause' => array(
				'key'   => '_ufi_event_status',
				'value' => 'past',
			),
			'date_clause'   => array(
				'key'     => '_ufi_event_date',
				'compare' => 'EXISTS',
			),
		),
		'orderby'        => array( 'date_clause' => 'DESC' ),
	) );
	?>

	<div class="events-sub-label reveal" style="margin-top:60px;"><?php esc_html_e( 'Past', 'ufi-daman' ); ?></div>

	<?php if ( $past_query->have_posts() ) : ?>
		<?php while ( $past_query->have_posts() ) : $past_query->the_post(); ?>
			<?php
			$year     = get_post_meta( get_the_ID(), '_ufi_event_year', true );
			$location = get_post_meta( get_the_ID(), '_ufi_event_location', true );
			$tag      = get_post_meta( get_the_ID(), '_ufi_event_tag', true );
			?>
			<div class="gig-row reveal">
				<div class="gig-year"><?php echo esc_html( $year ); ?></div>
				<div class="gig-info">
					<div class="gig-venue"><?php the_title(); ?></div>
					<?php if ( $location ) : ?>
					<div class="gig-location"><?php echo esc_html( $location ); ?></div>
					<?php endif; ?>
				</div>
				<?php if ( $tag ) : ?>
				<div class="gig-tag"><?php echo esc_html( $tag ); ?></div>
				<?php endif; ?>
			</div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<div class="gig-row no-events reveal">
			<div class="gig-info">
				<div class="gig-venue"><?php esc_html_e( 'No past events yet', 'ufi-daman' ); ?></div>
			</div>
		</div>
	<?php endif; ?>

</section>

<!-- ======================================================
     MIXES
     ====================================================== -->
<section class="mixes" id="mixes">
	<div class="mixes-header reveal">
		<h2 class="mixes-title"><?php esc_html_e( 'Stream', 'ufi-daman' ); ?><br><?php esc_html_e( 'My Sets', 'ufi-daman' ); ?></h2>
		<a href="<?php echo esc_url( $sc_url ); ?>" target="_blank" rel="noopener noreferrer" class="sc-all"><?php esc_html_e( 'All on SoundCloud →', 'ufi-daman' ); ?></a>
	</div>

	<?php
	$mixes_query = new WP_Query( array(
		'post_type'      => 'ufi_mix',
		'posts_per_page' => -1,
		'meta_key'       => '_ufi_mix_order',
		'orderby'        => 'meta_value_num',
		'order'          => 'ASC',
	) );

	$total_mixes = $mixes_query->found_posts;
	$mix_counter = 0;
	?>

	<div class="mixes-grid">
	<?php if ( $mixes_query->have_posts() ) : ?>
		<?php while ( $mixes_query->have_posts() ) : $mixes_query->the_post(); ?>
			<?php
			$mix_counter++;
			$detail = get_post_meta( get_the_ID(), '_ufi_mix_detail', true );
			$sc_embed = get_post_meta( get_the_ID(), '_ufi_mix_sc_url', true );
			?>
			<div class="mix-card reveal">
				<div>
					<div class="mix-number"><?php echo esc_html( sprintf( '%02d / %02d', $mix_counter, $total_mixes ) ); ?></div>
					<div class="mix-name"><?php the_title(); ?></div>
					<?php if ( $detail ) : ?>
					<div class="mix-detail"><?php echo esc_html( $detail ); ?></div>
					<?php endif; ?>
				</div>
				<?php if ( $sc_embed ) : ?>
					<?php if ( false !== stripos( $sc_embed, '<iframe' ) ) : ?>
						<?php echo wp_kses( $sc_embed, ufi_allowed_embed_html() ); ?>
					<?php else : ?>
						<iframe scrolling="no" allow="autoplay" loading="lazy"
							src="<?php echo esc_url( $sc_embed ); ?>"
							height="166"></iframe>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<?php
		// Fallback: hardcoded mixes from index.html
		$fallback_mixes = array(
			array(
				'number' => '01 / 04',
				'name'   => 'Sound @ Gabriel Loci Monastery',
				'detail' => '2025 · Techno / House',
				'src'    => 'https://w.soundcloud.com/player/?url=https%3A//soundcloud.com/ufi-daman/ufi-da-man-sound-gabriel-loci&color=%23e8ff00&auto_play=false&hide_related=true&show_comments=false&show_user=true&show_reposts=false&show_teaser=false&visual=false',
			),
			array(
				'number' => '02 / 04',
				'name'   => 'G SOUND+ @ Radost FX Prague',
				'detail' => '2023 · House / Techno / Electro',
				'src'    => 'https://w.soundcloud.com/player/?url=https%3A//soundcloud.com/ufi-daman/g-sound-by-ufi-da-man-radost-fx-prague-april-21st&color=%23e8ff00&auto_play=false&hide_related=true&show_comments=false&show_user=true&show_reposts=false&show_teaser=false&visual=false',
			),
			array(
				'number' => '03 / 04',
				'name'   => 'Sound @ Gabriel Loci Monastery',
				'detail' => '2023 · Deep / Techno',
				'src'    => 'https://w.soundcloud.com/player/?url=https%3A//soundcloud.com/ufi-daman/ufi-da-man-sound-gabriel-loci-monastery&color=%23e8ff00&auto_play=false&hide_related=true&show_comments=false&show_user=true&show_reposts=false&show_teaser=false&visual=false',
			),
			array(
				'number' => '04 / 04',
				'name'   => 'Sound Open Air Mlékojedy w/ Einmusic',
				'detail' => '2021 · Open Air Set',
				'src'    => 'https://w.soundcloud.com/player/?url=https%3A//soundcloud.com/ufi-daman/ufi-daman-at-sound-open-air-mlekojedy-w-einmusic-2472021&color=%23e8ff00&auto_play=false&hide_related=true&show_comments=false&show_user=true&show_reposts=false&show_teaser=false&visual=false',
			),
		);
		foreach ( $fallback_mixes as $mix ) :
		?>
			<div class="mix-card reveal">
				<div>
					<div class="mix-number"><?php echo esc_html( $mix['number'] ); ?></div>
					<div class="mix-name"><?php echo esc_html( $mix['name'] ); ?></div>
					<div class="mix-detail"><?php echo esc_html( $mix['detail'] ); ?></div>
				</div>
				<iframe scrolling="no" allow="autoplay" loading="lazy"
					src="<?php echo esc_url( $mix['src'] ); ?>"
					height="166"></iframe>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
	</div>
</section>

<!-- ======================================================
     GALLERY
     ====================================================== -->
<?php
$gallery_query = new WP_Query( array(
	'post_type'      => 'ufi_photo',
	'posts_per_page' => -1,
	'meta_key'       => '_ufi_photo_order',
	'orderby'        => 'meta_value_num',
	'order'          => 'ASC',
) );
if ( $gallery_query->have_posts() ) :
?>
<section class="gallery-section" id="gallery">
	<div class="gigs-header reveal">
		<h2 class="gigs-title"><?php esc_html_e( 'Gallery', 'ufi-daman' ); ?></h2>
	</div>
	<div class="gallery-grid">
		<?php while ( $gallery_query->have_posts() ) : $gallery_query->the_post(); ?>
		<?php
		$thumb = get_the_post_thumbnail_url( get_the_ID(), 'large' );
		$full  = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		if ( ! $thumb ) {
			continue;
		}
		$caption = get_the_title();
		?>
		<div class="gallery-item reveal" tabindex="0" role="button" aria-label="<?php echo esc_attr( $caption ?: __( 'View photo', 'ufi-daman' ) ); ?>">
			<img src="<?php echo esc_url( $thumb ); ?>"
			     data-full="<?php echo esc_url( $full ); ?>"
			     alt="<?php echo esc_attr( $caption ); ?>"
			     loading="lazy">
			<?php if ( $caption ) : ?>
			<div class="gallery-caption"><?php echo esc_html( $caption ); ?></div>
			<?php endif; ?>
		</div>
		<?php endwhile; wp_reset_postdata(); ?>
	</div>
</section>
<?php endif; ?>

<!-- ======================================================
     CONTACT
     ====================================================== -->
<section class="contact" id="contact">
	<div class="reveal">
		<h2 class="contact-headline">
			<?php esc_html_e( "Let's", 'ufi-daman' ); ?><br><?php esc_html_e( 'make', 'ufi-daman' ); ?><br><span><?php esc_html_e( 'noise.', 'ufi-daman' ); ?></span>
		</h2>
	</div>
	<div class="contact-right reveal">
		<p class="contact-text">
			<?php esc_html_e( 'Bookings, collabs, or just want to talk music?', 'ufi-daman' ); ?><br>
			<?php esc_html_e( 'Hit me up.', 'ufi-daman' ); ?>
		</p>
		<a href="mailto:<?php echo esc_attr( $email ); ?>" class="contact-email"><?php echo esc_html( strtoupper( $email ) ); ?></a>
		<div class="social-icons">
			<?php if ( $ra_url ) : ?>
			<a href="<?php echo esc_url( $ra_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="<?php esc_attr_e( 'Resident Advisor', 'ufi-daman' ); ?>"><i class="fa-solid fa-record-vinyl" aria-hidden="true"></i></a>
			<?php endif; ?>
			<?php if ( $sc_url ) : ?>
			<a href="<?php echo esc_url( $sc_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="<?php esc_attr_e( 'SoundCloud', 'ufi-daman' ); ?>"><i class="fa-brands fa-soundcloud" aria-hidden="true"></i></a>
			<?php endif; ?>
			<?php if ( $mc_url ) : ?>
			<a href="<?php echo esc_url( $mc_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="<?php esc_attr_e( 'Mixcloud', 'ufi-daman' ); ?>"><i class="fa-brands fa-mixcloud" aria-hidden="true"></i></a>
			<?php endif; ?>
			<?php if ( $fb_url ) : ?>
			<a href="<?php echo esc_url( $fb_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="<?php esc_attr_e( 'Facebook', 'ufi-daman' ); ?>"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
			<?php endif; ?>
			<?php if ( $ig_url ) : ?>
			<a href="<?php echo esc_url( $ig_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="<?php esc_attr_e( 'Instagram', 'ufi-daman' ); ?>"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
			<?php endif; ?>
			<?php if ( $pk_url ) : ?>
			<a href="<?php echo esc_url( $pk_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="<?php esc_attr_e( 'Press Kit', 'ufi-daman' ); ?>"><i class="fa-regular fa-folder-open" aria-hidden="true"></i></a>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="fb-root"></div>
<div class="cursor" id="cursor"></div>

<nav class="ufi-nav" aria-label="<?php esc_attr_e( 'Main navigation', 'ufi-daman' ); ?>">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo">UFI DA MAN</a>

	<ul class="nav-links">
		<li><a href="#about"><?php esc_html_e( 'About', 'ufi-daman' ); ?></a></li>
		<li><a href="#events"><?php esc_html_e( 'Events', 'ufi-daman' ); ?></a></li>
		<li><a href="#mixes"><?php esc_html_e( 'Mixes', 'ufi-daman' ); ?></a></li>
		<li><a href="#contact"><?php esc_html_e( 'Contact', 'ufi-daman' ); ?></a></li>
	</ul>

	<div class="nav-socials social-icons">
		<?php if ( $ra_url = get_theme_mod( 'ufi_ra_url', 'https://ra.co/dj/ufidaman' ) ) : ?>
		<a href="<?php echo esc_url( $ra_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="<?php esc_attr_e( 'Resident Advisor', 'ufi-daman' ); ?>">
			<i class="fa-solid fa-record-vinyl" aria-hidden="true"></i>
		</a>
		<?php endif; ?>

		<?php if ( $sc_url = get_theme_mod( 'ufi_sc_url', 'https://soundcloud.com/ufi-daman' ) ) : ?>
		<a href="<?php echo esc_url( $sc_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="<?php esc_attr_e( 'SoundCloud', 'ufi-daman' ); ?>">
			<i class="fa-brands fa-soundcloud" aria-hidden="true"></i>
		</a>
		<?php endif; ?>

		<?php if ( $mc_url = get_theme_mod( 'ufi_mixcloud_url', 'https://www.mixcloud.com/ufidaman/' ) ) : ?>
		<a href="<?php echo esc_url( $mc_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="<?php esc_attr_e( 'Mixcloud', 'ufi-daman' ); ?>">
			<i class="fa-brands fa-mixcloud" aria-hidden="true"></i>
		</a>
		<?php endif; ?>

		<?php if ( $fb_url = get_theme_mod( 'ufi_fb_url', 'https://www.facebook.com/ufi.daman.official' ) ) : ?>
		<a href="<?php echo esc_url( $fb_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="<?php esc_attr_e( 'Facebook', 'ufi-daman' ); ?>">
			<i class="fa-brands fa-facebook-f" aria-hidden="true"></i>
		</a>
		<?php endif; ?>

		<?php if ( $ig_url = get_theme_mod( 'ufi_ig_url', 'https://www.instagram.com/ufi.daman' ) ) : ?>
		<a href="<?php echo esc_url( $ig_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="<?php esc_attr_e( 'Instagram', 'ufi-daman' ); ?>">
			<i class="fa-brands fa-instagram" aria-hidden="true"></i>
		</a>
		<?php endif; ?>

		<?php if ( $pk_url = get_theme_mod( 'ufi_presskit_url', 'https://drive.google.com/drive/folders/1BA8sYOZWWrFfgCezI_Dr7Xrk2-Ju-gpX' ) ) : ?>
		<a href="<?php echo esc_url( $pk_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="<?php esc_attr_e( 'Press Kit', 'ufi-daman' ); ?>">
			<i class="fa-regular fa-folder-open" aria-hidden="true"></i>
		</a>
		<?php endif; ?>
	</div>

	<button class="hamburger" id="hamburger" aria-label="<?php esc_attr_e( 'Open menu', 'ufi-daman' ); ?>" aria-expanded="false">
		<span></span>
		<span></span>
		<span></span>
	</button>
</nav>

<div class="mobile-menu" id="mobileMenu" role="navigation" aria-label="<?php esc_attr_e( 'Mobile navigation', 'ufi-daman' ); ?>">
	<a href="#about"><?php esc_html_e( 'About', 'ufi-daman' ); ?></a>
	<a href="#events"><?php esc_html_e( 'Events', 'ufi-daman' ); ?></a>
	<a href="#mixes"><?php esc_html_e( 'Mixes', 'ufi-daman' ); ?></a>
	<a href="#contact"><?php esc_html_e( 'Contact', 'ufi-daman' ); ?></a>
</div>

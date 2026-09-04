<footer class="ufi-footer">
	<span class="logo">UFI DA MAN</span>
	<span class="copy">
		<?php
		printf(
			/* translators: %s: current year */
			esc_html__( '© %s UFI DA MAN · Prague · All rights reserved.', 'ufi-daman' ),
			esc_html( date( 'Y' ) )
		);
		?>
	</span>
</footer>

<!-- Gallery lightbox -->
<div class="gallery-lightbox" id="galleryLightbox" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Photo lightbox', 'ufi-daman' ); ?>">
	<button class="gallery-lightbox-close" id="galleryLightboxClose" aria-label="<?php esc_attr_e( 'Close', 'ufi-daman' ); ?>">&#x2715;</button>
	<img src="" alt="" id="galleryLightboxImg">
</div>

<script>
const lb = document.getElementById('galleryLightbox');
const lbImg = document.getElementById('galleryLightboxImg');
if (lb) {
  function closeLightbox() { lb.classList.remove('open'); document.body.style.overflow = ''; lbImg.src = ''; }
  document.querySelectorAll('.gallery-item').forEach(function(item) {
    item.addEventListener('click', function() {
      const img = item.querySelector('img');
      lbImg.src = img.getAttribute('data-full') || img.src;
      lbImg.alt = img.alt;
      lb.classList.add('open');
      document.body.style.overflow = 'hidden';
    });
    item.addEventListener('keydown', function(e) { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); item.click(); } });
  });
  document.getElementById('galleryLightboxClose').addEventListener('click', closeLightbox);
  lb.addEventListener('click', function(e) { if (e.target === lb) closeLightbox(); });
  document.addEventListener('keydown', function(e) { if (e.key === 'Escape' && lb.classList.contains('open')) closeLightbox(); });
}

// Past events — activate accordion (progressive enhancement) + collapse all but newest
document.querySelectorAll('.years-accordion').forEach(function(acc) {
  acc.classList.add('js');
});
document.addEventListener('click', function(e) {
  const btn = e.target.closest('.year-toggle');
  if (!btn) return;
  const group = btn.closest('.year-group');
  if (!group) return;
  const isOpen = group.classList.toggle('open');
  btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
});

// Custom cursor — only on fine-pointer (desktop) devices; skip on touch to save mobile CPU
const cursor = document.getElementById('cursor');
if (cursor && window.matchMedia && window.matchMedia('(pointer:fine)').matches) {
  let mouseX = 0, mouseY = 0;
  document.addEventListener('mousemove', function(e) { mouseX = e.clientX; mouseY = e.clientY; });
  (function animateCursor() {
    cursor.style.left = mouseX + 'px';
    cursor.style.top = mouseY + 'px';
    requestAnimationFrame(animateCursor);
  })();
  document.querySelectorAll('a, .mix-card, .gig-row, .genre-tag').forEach(function(el) {
    el.addEventListener('mouseenter', function() { cursor.classList.add('expand'); });
    el.addEventListener('mouseleave', function() { cursor.classList.remove('expand'); });
  });
} else if (cursor) {
  cursor.style.display = 'none';
}

// Hamburger mobile menu
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobileMenu');
if (hamburger && mobileMenu) {
  hamburger.addEventListener('click', function() {
    const isOpen = mobileMenu.classList.toggle('open');
    hamburger.classList.toggle('open', isOpen);
    hamburger.setAttribute('aria-expanded', isOpen);
    document.body.style.overflow = isOpen ? 'hidden' : '';
  });
  mobileMenu.querySelectorAll('a').forEach(function(link) {
    link.addEventListener('click', function() {
      mobileMenu.classList.remove('open');
      hamburger.classList.remove('open');
      hamburger.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    });
  });
}

// Scroll reveal
const observer = new IntersectionObserver(function(entries) {
  entries.forEach(function(e) {
    if (e.isIntersecting) {
      e.target.classList.add('visible');
      observer.unobserve(e.target);
    }
  });
}, { threshold: 0.1 });
document.querySelectorAll('.reveal').forEach(function(el) { observer.observe(el); });
</script>

<?php wp_footer(); ?>
</body>
</html>

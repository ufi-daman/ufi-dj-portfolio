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

<script>
// Custom cursor with requestAnimationFrame for performance
const cursor = document.getElementById('cursor');
let mouseX = 0, mouseY = 0;
document.addEventListener('mousemove', function(e) { mouseX = e.clientX; mouseY = e.clientY; });
(function animateCursor() {
  if (cursor) {
    cursor.style.left = mouseX + 'px';
    cursor.style.top = mouseY + 'px';
  }
  requestAnimationFrame(animateCursor);
})();
document.querySelectorAll('a, .mix-card, .gig-row, .genre-tag').forEach(function(el) {
  el.addEventListener('mouseenter', function() { if (cursor) cursor.classList.add('expand'); });
  el.addEventListener('mouseleave', function() { if (cursor) cursor.classList.remove('expand'); });
});

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

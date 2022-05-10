<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace BigupWeb\Toecaps;

?>

<!-- DELETEME -->
<h1>Content-Page.php</h1>

<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php
		the_content();
		if ( get_edit_post_link() ) :
			?>
			<footer class="entry-footer">
				<div class="container">
					<?php Tags::print_edit_post_link(); ?>
				</div>
			</footer>
			<?php
		endif;
		?>
	</div>
</article>

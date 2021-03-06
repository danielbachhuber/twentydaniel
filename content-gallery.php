<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'minimalstream' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php endif; ?>
	</header><!-- .entry-header -->
	<?php
		if ( ! is_single() ) {
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			  the_post_thumbnail( 'featured-big' ); // use the custom image size we've set in functions.php
			} else {
				// Props Otto http://ottopress.com/2011/photo-gallery-primer/
				$attachments = get_children( array(
					'post_parent' => get_the_ID(),
					'post_status' => 'inherit',
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'order' => 'ASC',
					'orderby' => 'menu_order ID',
					'numberposts' => 1)
				);
				foreach ( $attachments as $thumb_id => $attachment ) {
					echo wp_get_attachment_image( $thumb_id, 'featured-big' ); // whatever size you want
				}
			}
		}
	?>

	<div class="entry-content <?php if ( has_post_thumbnail() ) : { echo 'featured'; } endif; ?>">
		<?php if ( post_password_required() ) : ?>
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'minimalstream' ) ); ?>

		<?php elseif ( is_single() ) : ?>
			<?php the_content(); ?>
			
		<?php else : ?>
			<?php the_excerpt(); ?>
		<?php endif; ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'minimal_stream' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php //endif; ?>

	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'minimal_stream' ), '<span class="edit-link">', '</span>' ); ?>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="post-meta">
			<span class="entry-date"><?php minimal_stream_posted_on(); ?></span>
			<span class="entry-tags"><?php the_tags('', ', '); ?> </span>
		</div>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

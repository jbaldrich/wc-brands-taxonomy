<?php
/**
 * The template for displaying all brands.
 *
 * @package wc-brands-taxonomy
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
			/**
			 * Functions hooked in to tannebasscorner_page add_action
			 *
			 * @hooked tannebasscorner_page_header          - 10
			 * @hooked tannebasscorner_page_content         - 20
			 */
			do_action( 'tannebasscorner_page' );
			?>
		</article><!-- #post-## -->

			<?php
			while ( have_posts() ) :
				the_post();

				do_action( 'tannebasscorner_page_before' );

				// Muestra las marcas con el formato de las subcategorías de producto.
				$terms = get_terms( array(
					'taxonomy'   => 'marca',
					'orderby'    => 'slug',
					'order'      => 'ASC',
					'hide_empty' => true,
				) );
				?>
				<ul class="product-categories">
				<?php
				foreach ( $terms as $term) {
					// obtenemos la imagen de cada marca
					$image_id = get_term_meta( $term->term_id, 'category-image-id', true );
					?>
					<li class="product-category product">
					<?php
					if ( empty( $image_id ) || $image_id !== '') :
						?>
						<h2 class="woocommerce-loop-category__title">
							<a href="<?php echo esc_attr( get_term_link( $term->slug, $term->taxonomy ) ); ?>" class="<?php echo 'marca marca-' . esc_attr( $term->slug ); ?>"><?php echo esc_html( strtoupper( $term->slug ) ); ?></a>
						</h2>
						<?php
					else :
						?>
						<a href="<?php echo esc_attr( get_term_link( $term->slug, $term->taxonomy ) ); ?>" class="<?php echo 'marca marca-' . esc_attr( $term->slug ); ?>">
							<?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
						</a>
						<?php
					endif;
					?>
					</li>
					<?php
				}
				?>
				</ul>
				<?php
				// Finaliza el listado de marcas

				/**
				 * Functions hooked in to tannebasscorner_page_after action
				 *
				 * @hooked tannebasscorner_display_comments - 10
				 */
				do_action( 'tannebasscorner_page_after' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'tannebasscorner_sidebar' );
get_footer();

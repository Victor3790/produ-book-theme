<?php
/**
 * Search widget.
 *
 * @package WordPress
 */

$categories = get_categories( array( 'taxonomy' => 'book_categories' ) );

?>

<div class="card mb-4">
	<div class="card-header">Busca tu libro.</div>
	<div class="card-body">
		<form action="<?php echo esc_url( home_url() ); ?>">
			<div class="input-group">
				<input 
					class="form-control w-100" 
					type="text" 
					placeholder="Palabra de búsqueda..." 
					name="s" 
					id="s" 
					<?php
					//phpcs:disable
					if ( ! empty( $_GET['s'] ) ) {
						echo 'value="' . wp_kses_post( $_GET['s'] ) . '"';
					}
					//phpcs:enable
					?>
				/>
				<input 
					class="form-control w-100 mt-3" 
					type="text" 
					placeholder="Autor" 
					name="book_author" 
					id="book_author" 
					<?php
					//phpcs:disable
					if ( ! empty( $_GET['book_author'] ) ) {
						echo 'value="' . wp_kses_post( $_GET['book_author'] ) . '"';
					}
					//phpcs:enable
					?>
				/>
				<select class="w-100 mt-3" style="padding: 5px 6px; border: 0;" name="book_category" id="book_category">
					<option value="0">Selecciona una categoría</option>
					<?php foreach ( $categories as $category ) : ?>
						<option 
							value="<?php echo wp_kses_post( $category->name ); ?>"
							<?php
							//phpcs:disable
							if ( ! empty( $_GET['book_category'] ) && $_GET['book_category'] === $category->name ) {
								echo 'selected="selected"';
							}
							//phpcs:enable
							?>
						>
							<?php echo wp_kses_post( $category->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
				<p class="mt-4">
					<label for="amount">Precio:</label>
					<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
				</p>
				<div id="slider-range" class="w-100 mb-4"></div>

				<!-- Let's suppose the maximum price is 500 -->
				<input 
					type="hidden" 
					id="min-price" 
					name="min-price" 
					<?php
					//phpcs:disable
					if ( ! empty( $_GET['min-price'] ) ) {
						echo 'value="' . wp_kses_post( $_GET['min-price'] ) . '"';
					} else {
						echo 'value="0"';
					}
					//phpcs:enable
					?>
				>
				<input 
					type="hidden" 
					id="max-price" 
					name="max-price" 
					<?php
					//phpcs:disable
					if ( ! empty( $_GET['max-price'] ) ) {
						echo 'value="' . wp_kses_post( $_GET['max-price'] ) . '"';
					} else {
						echo 'value="500"';
					}
					//phpcs:enable
					?>
				>
				<input type="hidden" value="books" name="post_type" id="post_type" />
				<?php wp_nonce_field( 'search for books', 'search_nonce' ); ?>
				<input type="submit" class="btn btn-primary" value="Buscar" id="button-search">
			</div>
		</form>
	</div>
</div>

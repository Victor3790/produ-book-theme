<?php
/**
 * Search widget.
 *
 * @package WordPress
 */

?>

<div class="card mb-4">
	<div class="card-header">Busca tu libro.</div>
	<div class="card-body">
		<form action="<?php echo esc_url( home_url() ); ?>">
			<div class="input-group">
				<input class="form-control" type="text" placeholder="Palabra de búsqueda..." aria-label="Enter search term..." aria-describedby="button-search" name="s" id="s" />
				<input type="hidden" value="book" name="post_type" id="post_type" />
				<p class="mt-4">
				<label for="amount">Precio:</label>
				<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
				</p>

				<div id="slider-range" class="w-100 mb-4"></div>
				<input type="submit" class="btn btn-primary" value="Buscar" id="button-search">
			</div>
		</form>
	</div>
</div>

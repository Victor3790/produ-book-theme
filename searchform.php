<?php
/**
 * Search widget.
 *
 * @package WordPress
 */

?>

<div class="card mb-4">
	<div class="card-header">Busca artículos en nuestro blog.</div>
	<div class="card-body">
		<form action="<?php echo esc_url( home_url() ); ?>">
			<div class="input-group">
				<input class="form-control" type="text" placeholder="Palabra de búsqueda..." aria-label="Enter search term..." aria-describedby="button-search" name="s" id="s" />
				<input type="hidden" value="post" name="post_type" id="post_type" />
				<input type="submit" class="btn btn-primary" value="Go!" id="button-search">
			</div>
		</form>
	</div>
</div>

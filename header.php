<?php
/**
 * Theme header.
 *
 * @package WordPress
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title><?php bloginfo( 'name' ); ?></title>
	<?php wp_head(); ?>
</head>
<body>
	<!-- Responsive navbar-->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="<?php echo esc_url( get_site_url() ); ?>">Start Bootstrap</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<?php
					echo_my_theme_main_menu();
				?>
			</div>
		</div>
	</nav>

<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Teta
 * @subpackage Outfitmaker
 * @since PACKAGE VERSION 1.0
 */

?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php bloginfo('name'); ?> | <?php wp_title( '|', true, 'left' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!-- <script src="//use.typekit.net/trk2rie.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/normalize.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css" type="text/css" />
	<link href='https://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body <?php body_class(); ?>>
	<?php

	// Get taxonomy
	$taxonomies = array( 
		'gender_category',
	);

	$args = array(
		'orderby'			=> 'id', 
		'order'				=> 'ASC',
		'hide_empty'		=> false,
		'parent'			=> '0'
	); 

	$terms = get_terms($taxonomies, $args);

	if( is_front_page() ) {
		?>
		<div class="wrapper front">
			<div class="category">
				<ul>
					<?php
					foreach( $terms as $term ) {

						// Get the term link
						$term_link = get_term_link( $term );

						echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name .'</a></li>';
					}
					?>
				</ul>
			</div><!-- .category -->
			<?php
	} else if( is_tax() ) {
			?>
			<div class="wrapper mix">
				<div class="gender_menu">
					<ul>
						<?php
						foreach( $terms as $term ) {

							// Get the term link
							$term_link = get_term_link( $term );

							echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name .'</a></li>';
						}
						?>
					</ul>
				</div><!-- .gender_menu -->
				<div class="clearfix"></div>
		<?php
	}
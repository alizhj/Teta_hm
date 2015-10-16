<?php 
/**
* The template for displaying taxonomy (categories) of CPT.
*
* @package Teta
* @subpackage Outfitmaker
* @since PACKAGE VERSION 1.0
*
*/
get_header();

// Get children av taxonomy
$term = get_queried_object();
$term_id = $term->term_id;
$taxonomy_name = $term->taxonomy;

$termchildren = get_term_children( $term_id, $taxonomy_name );

?>
	<div class="menu">
		<div class="pagelogo">
			<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/litenloves.png" alt="HM logga"></a>
			<img class="pridemix" src="<?php echo get_template_directory_uri(); ?>/img/pride_liten.png" alt="Stockholm Pride">
		</div><!-- .pagelogo -->
		<ul>
			<?php

			foreach ( $termchildren as $child ) {
				$term = get_term_by( 'id', $child, $taxonomy_name );
				echo '<li><a href="#" id="' . $term->slug . '">' . $term->name . '</a></li>';
			}

			?>
		</ul>
	</div><!-- .menu -->

<!-- 	<div id="speech-bubble">
		<p>Dra plagget hit <br>för att skapa din outfit</p>
	</div> --><!-- #speech-bubble -->

	<img class='back' src="<?php echo get_template_directory_uri(); ?>/img/nyHourse.png"/>

	<div id="clothes">
		<?php
		if( have_posts() ) {
			$i = 0;
			while( have_posts() ) {
				the_post();
				$term_list = wp_get_post_terms( get_the_ID(), 'gender_category', array('fields' => 'all'));
				//var_dump($term_list);
				$slug_list = array();
				foreach ($term_list as $the_term) {
					if ($the_term->parent != 0) {
						$slug_list[] = $the_term->slug;
					}
				}

				?>
				<div class="cover <?php echo implode(' ', $slug_list); ?>">
					<img class='hanger' src="<?php echo get_template_directory_uri(); ?>/img/hanger.png"></br>
					<?php
					$price = get_post_custom_values('pris');

					if( has_post_thumbnail() ) {
						the_post_thumbnail( 'clothes-thumb', array( 'data-price' => $price[0], 'id' => 'drag'.$i++ ));
					}
					?>
				</div><!-- .cover -->
				<?php
			}

			// the_posts_pagination( array(
			// 	'prev_text'          => __( 'Föregående', 'outfitmaker' ),
			// 	'next_text'          => __( 'Nästa', 'outfitmaker' ),
			// 	'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'outfitmaker' ) . ' </span>',
			// ) );
		}
		?>
	</div><!-- #clothes -->

	<div id="bed"><p>Dra plagget hit <br>för att skapa din outfit</p></div>
	<div id="bin"></div>

	<div class="details"><a id="detailsClose"><i class="fa fa-times" onclick="unloadDetails()"></i></a>
		<img src="<?php echo get_template_directory_uri(); ?>/img/details.png" alt="Färg och storlek">
	</div><!-- .details  -->

	<div class="clearfix"></div>

	<div id="shoppingList">
		<p>Din shoppingbag:</p>
		<ul></ul>
	</div><!-- #shoppingList -->

	<div class="clearfix"></div>

	<div id="order">
		<button onclick="loadShoppingbag()"><i class="fa fa-play"></i>Kassa</button>
		 <script>
		 	/**
		 	* Function to the image of shoppingbag when click on order-button
		 	*/
			function loadShoppingbag() {
				$('#shoppingbag').append('<div class="kassa"><img src="<?php echo get_template_directory_uri(); ?>/img/kassasida.png" alt="Kassan"></div>').fadeIn(500);
				$('.mix').css({'opacity': '0.3'});
			}

		 	/**
		 	* Function to unload the image of shoppingbag
		 	*/
			function unloadShoppingbag() { 
	            $('#shoppingbag').fadeOut(500);
	            $('.mix').css({'opacity': '1'}); 
	        }
		</script>
	</div><!-- #order -->
	
</div><!-- .wrapper mix -->

<div id="shoppingbag">
	<a id="shoppingbagClose"><i class="fa fa-times" onclick="unloadShoppingbag()"></i></a>
</div><!-- #shoppingbag -->

<?php get_footer(); ?>
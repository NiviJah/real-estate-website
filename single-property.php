<?php
/**
 * The Template for displaying all single posts.
 *
 * @package _tk
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

<div class="img_header_wrapper">
<?php echo get_the_post_thumbnail( $post->ID ); ?>
		<h1 class="header_title"><?php  the_title();  ?> <small>$<?php echo number_format_i18n(get_field('price')); ?></small></h1>
		</div>

<div class="has_icons">
<ul class="list-inline text-center">
		<?php  if( in_array( 'AC', get_field('accesories') ) )
{
    echo '<li> <img width="64" src="http://icons.iconarchive.com/icons/icons8/christmas-flat-color/512/snowflake-icon.png" alt=""></li> ';
} ?>
		<?php  if( in_array( 'Pool', get_field('accesories') ) )
{
    echo '<li> <img width="64" src="https://cdn3.iconfinder.com/data/icons/hotel-services-facilities-2/256/Swimming_Pool-512.png" alt=""></li> ';
} ?>
		<?php  if( in_array( 'Garage', get_field('accesories') ) )
{
    echo '<li> <img width="64" src="https://cdn3.iconfinder.com/data/icons/eldorado-stroke-buildings/40/garage_2-512.png" alt=""></li> ';
} ?>

</ul>
</div>
		<h4>Description:</h4>
		<div class="row"> <div class="col-md-6"> <?php the_content(); ?></div>
</div>

<?php
$location = get_field('address');

?>
<p class="alert alert-success"><?php echo $location['address']; ?></p>
<div id="map" style="width: 100%; height: 350px;"></div>
<script src='http://maps.googleapis.com/maps/api/js?sensor=false' type='text/javascript'></script>

<hr>
<h4>Property Details :</h4>
<ul>
	<li>Property Type: <?php the_field('property_type'); ?></li>
	<li>Number of Rooms: <?php the_field('rooms'); ?></li>	
	<li>Number of Bathrooms: <?php the_field('bathrooms'); ?></li>	

	<li>Accesories: <?php the_field('accesories'); ?></li>	

	<li>Price: $<?php echo number_format_i18n(get_field('price')); ?></li>	

		</ul>

<hr> 
<?php
    $gallery_images = easy_image_gallery_get_image_ids();
    echo '<ul id="imageGallery">';
    foreach($gallery_images as $image_id) { // looping on user-selected attachment IDs
     $image_src = wp_get_attachment_url( $image_id ); // returns an array
     $image_thumb_src = wp_get_attachment_url( $image_id, 'thumbnail' ); // returns an array


		echo '<li data-thumb="'. $image_thumb_src .'" data-src="'. $image_src .'">
		    <img src="' . $image_src . '" class="img-responsive" alt="">
		  </li>';
	

    }
    	echo '</ul>';
    ?>

<hr>
    <div class="row">
    	<div class="col-md-6"><img src="<?php the_field('seller_image'); ?> " alt=""> </div>
    	<div class="col-md-6">
<div class="contact_details"> <h4>Contact Details</h4> <?php the_field('contact_details'); ?> </div>
    		<?php echo do_shortcode('[contact-form-7 id="45" title="Contact form 1"]' ); ?>

    	</div>
    </div>

	<?php endwhile; // end of the loop. ?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?><script type="text/javascript">
  //<![CDATA[
	function load() {
	var lat = <?php echo $location['lat']; ?>;
	var lng = <?php echo $location['lng']; ?>;
// coordinates to latLng
	var latlng = new google.maps.LatLng(lat, lng);
// map Options
	var myOptions = {
	zoom: 9,
	center: latlng,
	mapTypeId: google.maps.MapTypeId.ROADMAP
   };
//draw a map
	var map = new google.maps.Map(document.getElementById("map"), myOptions);
	var marker = new google.maps.Marker({
	position: map.getCenter(),
	map: map
   });
}
// call the function
   load();
//]]>
</script>

<script>
	  jQuery(document).ready(function() {
    jQuery('#imageGallery').lightSlider({
        gallery:true,
        // rtl:true,
        item:1,
        thumbItem:9,
        slideMargin:0,
        currentPagerPosition:'left',
        onSliderLoad: function(plugin) {
            plugin.lightGallery();
        }   
    });  
  });

</script>
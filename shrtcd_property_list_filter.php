<?php
if(isset($_REQUEST['lt']) && $_REQUEST['lt']!="")
{
	$filter = $_REQUEST['lt'];
}

function WP_RE_list_properties( $atts ) {
	extract( shortcode_atts( array(
		'list_type' => 'sale',
		'bar' => 'something else',
	), $atts ) );


$p_list_sidebar = get_option('p_list_sidebar');
$et_re_adv_flds = get_option('et_re_adv_flds');
$p_pro_id_display = get_option('p_pro_id_display');

$paged = ( get_query_var( 'paged' ) ) ? get_query_var('paged' ) : 1;
$pro_args_pag = array(
	'posts_per_page'   => -1,
	'orderby'          => 'post_date',
	'order'            => 'DESC',
	'meta_key'         => 'et_er_adtype',
	'meta_value'       => $list_type,
	'post_type'        => 'property',
	'post_status'      => 'publish',
	'suppress_filters' => true );

$pro_list_pag = get_posts( $pro_args_pag );
$pro_args = array(
	'posts_per_page'   => get_option('et_re_pp_listing'),
	'paged' => $paged,
	'orderby'          => 'post_date',
	'order'            => 'DESC',
	'meta_key'         => 'et_er_adtype',
	'meta_value'       => $list_type,
	'post_type'        => 'property',
	'post_status'      => 'publish',
	'suppress_filters' => true );

$pro_list = get_posts( $pro_args );

$pro_return='';
foreach ( $pro_list as $propertyQuery ) {

$pro_return .= '<div id="PropertyQuickView">
  <div class="QVImage">';
  $property_imgs = get_property_images_ids(true,$propertyQuery->ID);
$pro_return .= '<a href="'. get_permalink($propertyQuery->ID) .'" title="'. $propertyQuery->post_title.'"> '.wp_get_attachment_image($property_imgs['property_image1'], 'thumbnail').'</a>
</div>
<div class="QVProInfo">
<h2 class="h2typelist"><a href="'. get_permalink($propertyQuery->ID) .'">'. $propertyQuery->post_title.'</a></h2>';

	  if ($p_pro_id_display == 1) {
	  $pro_return .= translate( 'Property ID: ', 'wprealestate' ).$propertyQuery->ID.'<br>';
	  }

      if (get_post_meta(get_the_ID(), 'et_er_built_size', true) <> '0') {
	  $pro_return .= translate( 'Built Up: ', 'wprealestate' ).get_post_meta($propertyQuery->ID, 'et_er_built_size', true).'<br>';
	  }

      $pro_return .= translate( 'For ', 'wprealestate' ).$list_type.': '.ET_RE_Currency.get_post_meta($propertyQuery->ID, 'et_er_price', true).'<br>';

      if (get_post_meta($propertyQuery->ID, 'et_er_bedroom', true) != 'Not Applicable') {
	  $pro_return .= translate( 'Bedrooms: ', 'wprealestate' ).get_post_meta($propertyQuery->ID, 'et_er_bedroom', true).'<br>';
	  }

	  if (get_post_meta($propertyQuery->ID, 'et_er_bathroom', true) <> 'Not Applicable') {
	  $pro_return .= translate( 'Bathrooms: ', 'wprealestate' ).get_post_meta($propertyQuery->ID, 'et_er_bathroom', true).'<br>';
      }
      $pro_return .='<div style="float:left; width:100px; bottom:0px;"><a href="'. get_permalink($propertyQuery->ID).'"><img src="'. ET_RE_URL.'/images/view_details_button.png" /></a></div>
  </div>
<br style="clear:both;" />
<div class="SpacerDiv"></div>
</div>';
 }
$big = 999999999; // need an unlikely integer
$totalp = ceil( count($pro_list_pag) / get_option('et_re_pp_listing') );
$pro_return .= paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url(get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
	'total' => $totalp
) );

wp_reset_postdata();
return $pro_return;
}
add_shortcode( 'WPRE_LIST_PROPERTIES', 'WP_RE_list_properties' );

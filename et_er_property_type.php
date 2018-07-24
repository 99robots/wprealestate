<div class="wrap">
<h2>WP Real Estate - <?php _e( 'Property Type', 'wprealestate' ); ?></h2><br />
<style>
.tbl_property_type tr td{
	padding:5px;
}
</style>
<input id="property_type_text" type="text" name="property_type" />
<a id="add_property_type_submit" class="button button-primary" href=""><?php _e( 'Add Property Type', 'wprealestate' ); ?></a>
<img src="<?php echo admin_url( '/images/wpspin_light.gif' );?>" class="waiting" style="display:none;" id="et_re_loading" />
<div class="ajxrsp"></div>
<table class="tbl_property_type" width="40%" border="0" cellspacing="0" cellpadding="0">
<?php
$get_property_type = get_option('et_re_property_type');
if($get_property_type!=""){
	if (strpos($get_property_type,',') !== false) {
		$arr_property_type_text = explode(',',$get_property_type);
		$arr_property_type_text = array_reverse($arr_property_type_text);
		foreach($arr_property_type_text as $propertytype){
			echo '<tr class="et_et_'.$propertytype.'">';
			echo '<td width="80%">'.$propertytype.'</td>';
			echo '<td width="10%"><a id="p_delete" class="button" href="javascript:p_delete(\''.$propertytype.'\');">'.__( 'Delete', 'wprealestate' ).'</a></td>';
			echo '</tr>';
		}
	} else {
		echo '<tr class="et_et_'.$propertytype.'">';
		echo '<td width="80%">'.$get_property_type.'</td>';
		echo '<td width="10%"><a id="p_delete" class="button" href="javascript:p_delete(\''.$get_property_type.'\');">'.__( 'Delete', 'wprealestate' ).'</a></td>';
		echo '</tr>';
	}
}

?>
</table>
</div>
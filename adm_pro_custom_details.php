<?php
// Property admin forms

add_action( 'add_meta_boxes', 'PropertyCustomBox' );
/* Adds a box to the main column on the Post and Page edit screens */
function PropertyCustomBox() {
    add_meta_box( 
        'myplugin_sectionid',
        __( 'Property Details', $PluginName ),
        'property_custom_box',
        'property' , 'normal', 'high'
    );
}
//Custom box for Properties
/* Prints the box content */
function property_custom_box( $post ) {
	
	$mypostid = $post->ID;
	
	$et_er_property_name = stripslashes(get_post_meta($mypostid, 'et_er_property_name', true));
	$et_er_adtype = stripslashes(get_post_meta($mypostid, 'et_er_adtype', true));
	$et_er_type = stripslashes(get_post_meta($mypostid, 'et_er_type', true));
	$et_er_built_size = stripslashes(get_post_meta($mypostid, 'et_er_built_size', true));
	$et_er_land_size = stripslashes(get_post_meta($mypostid, 'et_er_land_size', true));
	$et_er_price = stripslashes(get_post_meta($mypostid, 'et_er_price', true));
	$et_er_bedroom = stripslashes(get_post_meta($mypostid, 'et_er_bedroom', true));
	$et_er_bathroom = stripslashes(get_post_meta($mypostid, 'et_er_bathroom', true));
	$et_er_furnishing = stripslashes(get_post_meta($mypostid, 'et_er_furnishing', true));
	$et_er_tenure = stripslashes(get_post_meta($mypostid, 'et_er_tenure', true));
	$et_er_date_vacant = stripslashes(get_post_meta($mypostid, 'et_er_date_vacant', true));
	$et_er_area_location = stripslashes(get_post_meta($mypostid, 'et_er_area_location', true));
	$et_er_address = stripslashes(get_post_meta($mypostid, 'et_er_address', true));
	$et_er_zipcode = stripslashes(get_post_meta($mypostid, 'et_er_zipcode', true));
	$et_er_city = stripslashes(get_post_meta($mypostid, 'et_er_city', true));
	#$et_er_facilities_exp = stripslashes(get_post_meta($mypostid, 'et_er_facilities', true));
	$et_er_cons_year = stripslashes(get_post_meta($mypostid, 'p_cons_year', true));
	$et_er_unit_num = stripslashes(get_post_meta($mypostid, 'et_er_unit_num', true));
	$et_er_state = stripslashes(get_post_meta($mypostid, 'et_er_state', true));
	$et_er_rent_price = stripslashes(get_post_meta($mypostid, 'et_er_rent_price', true));
	$et_er_rent_tenure = stripslashes(get_post_meta($mypostid, 'et_er_rent_tenure', true));
	wp_nonce_field( plugin_basename( __FILE__ ), $PluginName );
	
	?>
    
<div> 
<h2><?php _e( 'Location Details', 'wprealestate' ); ?></h2>
<div class="AdmfrmLabel">
  <label for="et_er_property_name"><?php _e( 'Property Name', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
<input name="et_er_property_name" type="text" id="et_er_property_name" value="<?php echo $et_er_property_name; ?>" size="14" />
</div>
<br style="clear:both;" />

<div class="AdmfrmLabel">
  <label for="et_er_area_location"><?php _e( 'Area / Location', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
  <input name="et_er_area_location" type="text" id="et_er_area_location" value="<?php echo $et_er_area_location; ?>" size="14" />
</div>
<br style="clear:both;" />
<div class="AdmfrmLabel">
  <label for="et_er_address"><?php _e( 'Unit #', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
  <input name="et_er_unit_num" type="text" id="et_er_address" value="<?php echo $et_er_unit_num; ?>" size="14" />
</div>
<br style="clear:both;" />

<div class="AdmfrmLabel">
  <label for="et_er_address"><?php _e( 'Address', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
  <input name="et_er_address" type="text" id="et_er_address" value="<?php echo $et_er_address; ?>" size="14" />
</div>
<br style="clear:both;" />
<div class="AdmfrmLabel">
  <label for="et_er_zipcode"><?php _e( 'Zip Code', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
  <input name="et_er_zipcode" type="text" id="et_er_zipcode" value="<?php echo $et_er_zipcode; ?>" size="14" />
</div><br style="clear:both;" />
<div class="AdmfrmLabel">
  <label for="et_er_city"><?php _e( 'City', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
  <input name="et_er_city" type="text" id="et_er_city" value="<?php echo $et_er_city; ?>" size="14" />
</div>
<br style="clear:both;" />
<div class="AdmfrmLabel">
  <label for="et_er_city"><?php _e( 'State', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
<?php
$args = array(
	'orderby'           => 'name', 
	'order'             => 'ASC',
	'hide_empty'        => 0
); 
$get_state_results = get_terms('state', $args);
?>
    <select id="et_er_state" name="et_er_state" class="AdmFrmList">
        <option value="" selected="selected">Select State</option>
        <?php 
        if($get_state_results){
            foreach($get_state_results as $get_state_result){	
        ?>
            <option <?php if($et_er_state==$get_state_result->term_id){ ?>selected="selected" <?php } ?>value="<?php echo $get_state_result->term_id; ?>"><?php echo $get_state_result->name; ?></option>
        <?php 
            }
        } ?>
    </select>
</div>
<br style="clear:both;" />

</div>    
<div><h2><?php _e( 'Property Information', 'wprealestate' ); ?></h2>
<div class="AdmfrmLabel">
  <label for="et_er_adtype"><?php #echo 'tt'.basename( dirname( __FILE__ ) ) . '/languages/';
  _e( 'List Type', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
  <select id="et_er_adtype" name="et_er_adtype" class="AdmFrmList">
    <option <?php if ($et_er_adtype == __( 'Sale', 'wprealestate' )) {?> selected="selected"<?php }?>><?php _e( 'Sale', 'wprealestate' ); ?></option>
    <option <?php if ($et_er_adtype == __( 'Rent', 'wprealestate' )) {?> selected="selected"<?php }?>><?php _e( 'Rent', 'wprealestate' ); ?></option>
  </select>
</div>
<br style="clear:both;" />
<div class="AdmfrmLabel">
  <label for="et_er_type"><?php _e( 'Property Type', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
  <select id="et_er_type" name="et_er_type" class="AdmFrmList">
    <?php
	$get_property_type = get_option('et_re_property_type');
	if($get_property_type!=""){
		if (strpos($get_property_type,',') !== false) {
			$arr_property_type_text = explode(',',$get_property_type);
			$arr_property_type_text = array_reverse($arr_property_type_text);
			foreach($arr_property_type_text as $propertytype){
	?>
			<option <?php if ($et_er_type == $propertytype) {?> selected="selected"<?php }?>><?php echo $propertytype; ?></option>
    <?php
			}
		} else {
	?>
			<option <?php if ($et_er_type == $get_property_type) {?> selected="selected"<?php }?>><?php echo $get_property_type; ?></option>
    <?php
		}
	}
	?>
  </select>
</div>
<br style="clear:both;" />
<div class="AdmfrmLabel">
  <label for="et_er_built_size"><?php _e( 'Built upto (sq. ft)', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
  <input name="et_er_built_size" type="text" id="et_er_built_size" value="<?php echo $et_er_built_size; ?>" size="14" />
  <span class="admnotes"><?php _e( 'Only numbers', 'wprealestate' ); ?></span>
  </div>
<br style="clear:both;" />
<div class="AdmfrmLabel">
  <label for="et_er_land_size"><?php _e( 'Land area', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
  <input name="et_er_land_size" type="text" id="et_er_land_size" value="<?php echo $et_er_land_size; ?>" size="14" />
</div>
<br style="clear:both;" />
<div class="AdmfrmLabel">
  <label for="et_er_price"><?php _e( 'Sale Price', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
  <input name="et_er_price" type="text" id="et_er_price" value="<?php echo $et_er_price; ?>" size="14" />
  <span class="admnotes"><?php _e( 'Only numbers', 'wprealestate' ); ?></span>
</div>
<br style="clear:both;" />
<div class="AdmfrmLabel">
  <label for="et_er_rent_price"><?php _e( 'Rent Price', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
  <input name="et_er_rent_price" type="text" id="et_er_rent_price" value="<?php echo $et_er_rent_price; ?>" size="14" />
    <select name="et_er_rent_tenure" id="et_er_rent_tenure" class="AdmFrmList">
    <option <?php if ($et_er_rent_tenure == __( 'Per Day', 'wprealestate' )) {?> selected="selected"<?php }?>><?php _e( 'Per Day', 'wprealestate' ); ?></option>
    <option <?php if ($et_er_rent_tenure == __( 'Per Week', 'wprealestate' )) {?> selected="selected"<?php }?>><?php _e( 'Per Week', 'wprealestate' ); ?></option>
    <option <?php if ($et_er_rent_tenure == __( 'Per Month', 'wprealestate' )) {?> selected="selected"<?php }?>><?php _e( 'Per Month', 'wprealestate' ); ?></option>
    <option <?php if ($et_er_rent_tenure == __( 'Per Year', 'wprealestate' )) {?> selected="selected"<?php }?>><?php _e( 'Per Year', 'wprealestate' ); ?></option>
  </select>

  <span class="admnotes"><?php _e( 'If available on rent also. Enter only numbers', 'wprealestate' ); ?></span>
</div>
<br style="clear:both;" />
<div class="AdmfrmLabel">
  <label for="et_er_bedroom"><?php _e( 'Bedroom', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
<input type="text" id="et_er_bedroom" name="et_er_bedroom" class="AdmFrmList" value="<?php echo $et_er_bedroom; ?>">  
</div>
<br style="clear:both;" />
<div class="AdmfrmLabel">
  <label for="et_er_bathroom"><?php _e( 'Bathroom', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
  <input type="text" id="et_er_bathroom" name="et_er_bathroom" class="AdmFrmList" value="<?php echo $et_er_bathroom; ?>">    
</div>
<br style="clear:both;" />
<div class="AdmfrmLabel">
  <label for="et_er_furnishing"><?php _e( 'Furnishing', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
  <select name="et_er_furnishing" id="et_er_furnishing" class="AdmFrmList">
    <option <?php if ($et_er_furnishing == __( 'Not Applicable', 'wprealestate' )) {?> selected="selected"<?php }?>><?php _e( 'Not Applicable', 'wprealestate' ); ?></option>
    <option <?php if ($et_er_furnishing == __( 'Unfurnished', 'wprealestate' )) {?> selected="selected"<?php }?>><?php _e( 'Unfurnished', 'wprealestate' ); ?></option>
    <option <?php if ($et_er_furnishing == __( 'Semi Furnished', 'wprealestate' )) {?> selected="selected"<?php }?>><?php _e( 'Semi Furnished', 'wprealestate' ); ?></option>
    <option <?php if ($et_er_furnishing == __( 'Fully Furnished', 'wprealestate' )) {?> selected="selected"<?php }?>><?php _e( 'Fully Furnished', 'wprealestate' ); ?></option>
  </select>
</div>
<br style="clear:both;" />
<div class="AdmfrmLabel">
  <label for="et_er_tenure"><?php _e( 'Tenure', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
  <select name="et_er_tenure" id="et_er_tenure" class="AdmFrmList">
    <option <?php if ($et_er_tenure == __( 'Not Applicable', 'wprealestate' )) {?> selected="selected"<?php }?>><?php _e( 'Not Applicable', 'wprealestate' ); ?></option>
    <option <?php if ($et_er_tenure == __( 'Freehold', 'wprealestate' )) {?> selected="selected"<?php }?>><?php _e( 'Freehold', 'wprealestate' ); ?></option>
    <option <?php if ($et_er_tenure == __( 'Leasehold', 'wprealestate' )) {?> selected="selected"<?php }?>><?php _e( 'Leasehold', 'wprealestate' ); ?></option>
  </select>
</div>
<br style="clear:both;" />
<div class="AdmfrmLabel">
  <label for="et_er_tenure"><?php _e( 'Cons. Year', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
  <select name="p_cons_year" class="cstm_s_big" id="p_cons_year">
    <option <?php if ($et_er_cons_year == __( 'Not Applicable', 'wprealestate' )) {?> selected="selected"<?php }?>><?php _e( 'Not Applicable', 'wprealestate' ); ?></option>
                    <?php 
					$yr = date('Y');
					for ($x=1960; $x<=$yr; $x++){ ?>
						<option value="<?php echo $x; ?>" <?php if ($et_er_cons_year == $x) { ?> selected="selected" <?php } ?>><?php echo $x; ?></option>
					<?php } ?>
                </select>
</div>
<br style="clear:both;" />
<div class="AdmfrmLabel">
  <label for="et_er_date_vacant"><?php _e( 'Date Available', 'wprealestate' ); ?></label>
</div>
<div class="AdmfrmFld">
  <input name="et_er_date_vacant" type="text" id="et_er_date_vacant" value="<?php echo $et_er_date_vacant; ?>" size="14" />
</div>
<br style="clear:both;" />

</div>    

<?php
}
add_action( 'save_post', 'SavePropertyInfo' );
function SavePropertyInfo($postID){
	global $wpdb;
	// called after a post or page is saved
	if($parent_id = wp_is_post_revision($postID))
	{
	$postID = $parent_id;
	}	
		if ($_POST['et_er_property_name']) {
		update_custom_meta($postID, addslashes($_POST['et_er_property_name']), 'et_er_property_name');
		}
		if ($_POST['et_er_adtype']) {
		update_custom_meta($postID, addslashes($_POST['et_er_adtype']), 'et_er_adtype');
		}
		if ($_POST['et_er_type']) {
		update_custom_meta($postID, addslashes($_POST['et_er_type']), 'et_er_type');
		}
		if ($_POST['et_er_built_size']) {
		update_custom_meta($postID, addslashes($_POST['et_er_built_size']), 'et_er_built_size');		
		} else {
		update_custom_meta($postID, '0', 'et_er_built_size');
		}
		if ($_POST['et_er_land_size']) {
		update_custom_meta($postID, addslashes($_POST['et_er_land_size']), 'et_er_land_size');		
		} else {
		update_custom_meta($postID, '0', 'et_er_land_size');
		}
		if ($_POST['et_er_price']) {
		update_custom_meta($postID, addslashes($_POST['et_er_price']), 'et_er_price');		
		} else {
		update_custom_meta($postID, '0', 'et_er_price');
		}
		
		if ($_POST['et_er_bedroom']) {
		update_custom_meta($postID, addslashes($_POST['et_er_bedroom']), 'et_er_bedroom');		
		} else {
		update_custom_meta($postID, '0', 'et_er_bedroom');
		}
		if ($_POST['et_er_bathroom']) {
		update_custom_meta($postID, $_POST['et_er_bathroom'], 'et_er_bathroom');		
		} else {
		update_custom_meta($postID, '0', 'et_er_bathroom');
		}
		if ($_POST['et_er_furnishing']) {
		update_custom_meta($postID, addslashes($_POST['et_er_furnishing']), 'et_er_furnishing');		
		}
		if ($_POST['et_er_tenure']) {
		update_custom_meta($postID, addslashes($_POST['et_er_tenure']), 'et_er_tenure');		
		}
		if ($_POST['et_er_date_vacant']) {
		update_custom_meta($postID, addslashes($_POST['et_er_date_vacant']), 'et_er_date_vacant');		
		} else {
		update_custom_meta($postID, '0', 'et_er_date_vacant');
		}
		if ($_POST['et_er_area_location']) {
		update_custom_meta($postID, addslashes($_POST['et_er_area_location']), 'et_er_area_location');		
		}
		if ($_POST['et_er_address']) {
		update_custom_meta($postID, addslashes($_POST['et_er_address']), 'et_er_address');		
		}
		if ($_POST['et_er_zipcode']) {
		update_custom_meta($postID, addslashes($_POST['et_er_zipcode']), 'et_er_zipcode');		
		}
		if ($_POST['et_er_city']) {
		update_custom_meta($postID, addslashes($_POST['et_er_city']), 'et_er_city');		
		}
		if ($_POST['p_cons_year']) {
		update_custom_meta($postID, addslashes($_POST['p_cons_year']), 'p_cons_year');		
		}
		if ($_POST['et_er_unit_num']) {
		update_custom_meta($postID, addslashes($_POST['et_er_unit_num']), 'et_er_unit_num');		
		}
		if ($_POST['et_er_state']) {
		update_custom_meta($postID, addslashes($_POST['et_er_state']), 'et_er_state');		
		}
		if ($_POST['et_er_rent_price']) {
		update_custom_meta($postID, $_POST['et_er_rent_price'], 'et_er_rent_price');
		} else {
		update_custom_meta($postID, '0', 'et_er_rent_price');
		}
		
		if ($_POST['et_er_rent_tenure']) {
		update_custom_meta($postID, addslashes($_POST['et_er_rent_tenure']), 'et_er_rent_tenure');		
		}		
}	
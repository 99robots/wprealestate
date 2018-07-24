<?php

function str_makerand($minlength, $maxlength, $useupper, $usespecial, $usenumbers) {
    $charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    if ($useupper)
        $charset .= "abcdefghijklmnopqrstuvwxyz";
    if ($usenumbers)
        $charset .= "0123456789";
    if ($usespecial)
        $charset .= "~@#$%^*()_+-={}|]["; // Note: using all special characters this reads: "~!@#$%^&*()_+`-={}|\\]?[\":;'><,./";
    if ($minlength > $maxlength)
        $length = mt_rand($maxlength, $minlength);
    else
        $length = mt_rand($minlength, $maxlength);
    for ($i = 0; $i < $length; $i++)
        $key .= $charset[(mt_rand(0, (strlen($charset) - 1)))];
    return $key;
}

function update_custom_meta($postID, $newvalue, $field_name) {
    global $PluginDirName, $PluginName, $wpdb, $FullPluginDirURL;
// To create new meta
    if (!get_post_meta($postID, $field_name)) {
        add_post_meta($postID, $field_name, $newvalue);
    } else {
// or to update existing meta
        update_post_meta($postID, $field_name, $newvalue);
    }
}

function sendmail($from_name, $to, $from, $subject, $msg) {
    global $wpdb;
    $et_re_sent_copy_email = get_option('et_re_sent_copy_email');
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $headers .= "From: " . $from . "<" . $from . ">" . "\r\n";
    $headers .= 'Bcc: ' . $et_re_sent_copy_email . '' . "\r\n";
    mail($to, $subject, $msg, $headers);
}

add_action('init', 'et_er_do_output_buffer');

function et_er_do_output_buffer() {
    ob_start();
}

function et_feed_request($qv) {
    if (isset($qv['feed']) && !isset($qv['post_type']))
        $qv['post_type'] = array('post', 'property');
    return $qv;
}

add_filter('request', 'et_feed_request');

function property_advanced_search_form($atts) {
    global $wpdb, $wp_query, $post, $wp_rewrite;
    $et_re_adv_flds = get_option('et_re_adv_flds');

    $frm_code = '<style>
.advnc_option {
	display:none;
}
.advnc {
	outline:none !important;
}
</style>
<div class="cstmsearch">
        <div class="cstmsearch_frm_c">

            <div class="cstmsearch_frm">';

    $et_re_pg_pro_list = get_option('et_re_pg_pro_list');

    if ($wp_rewrite->permalink_structure == '') {
        $frm_code .= '<form id="advncsrc" class="pfs frmshow" method="post" action="' . get_permalink($et_re_pg_pro_list) . '&frm=adv">';
    } else {
        $frm_code .= '<form id="advncsrc" class="pfs frmshow" method="post" action="' . get_permalink($et_re_pg_pro_list) . '?frm=adv">';
    }


    $frm_code .= ' <label>' . __("Keywords", "wprealestate") . '</label>
            	<input name="sbpn" placeholder="' . __("Search Property", "wprealestate") . '" class="cstm_f_large" id="sbpn" value="" />
                <div class="clr"></div>';

    if ($et_re_adv_flds != "") {
        if (in_array("p_list_type", $et_re_adv_flds)) {
            $frm_code .= '<label>' . __("Listing Type", "wprealestate") . '</label>
                <select name="p_list_type" class="cstm_s" id="p_list_type">
                  <option value="-1">' . __("All", "wprealestate") . '</option>
                  <option value="' . __("Sale", "wprealestate") . '">' . __("For Sale", "wprealestate") . '</option>
                  <option value="' . __("Rent", "wprealestate") . '">' . __("For Rent", "wprealestate") . '</option>
  </select>
                <div class="rspbreak"></div>';
        }
        if (in_array("p_type", $et_re_adv_flds)) {
            $frm_code .= '<label>' . __("Property Type", "wprealestate") . '</label>
                <select name="p_type" class="cstm_s" id="p_type">
                	<option value="">' . __("Any", "wprealestate") . '</option>';

            $get_property_type = get_option('et_re_property_type');
            if ($get_property_type != "") {
                if (strpos($get_property_type, ',') !== false) {
                    $arr_property_type_text1 = explode(',', $get_property_type);
                    $arr_property_type_text = array_reverse($arr_property_type_text1);
                    foreach ($arr_property_type_text as $propertytype) {

                        $frm_code .= '<option value="' . $propertytype . '">' . $propertytype . '</option>';
                    }
                } else {

                    $frm_code .= '<option value="' . $get_property_type . '">' . $get_property_type . '</option>';
                }
            }

            $frm_code .= '</select>
                <div class="rspbreak"></div>';
        }
        if (in_array("p_size", $et_re_adv_flds)) {
            $frm_code .= '<label class="labelbig">' . __("Floor Area (Built-in)", "wprealestate") . '</label>
                <select name="p_minsize" class="cstm_s_big" id="p_minsize" style="width:60px;">
                    <option selected="selected" value="">' . __("Min", "wprealestate") . '</option>
                    <option value="200">' . __("200 sqft (18 sqm)", "wprealestate") . '</option>
                    <option value="500">' . __("500 sqft (46 sqm)", "wprealestate") . '</option>
                    <option value="750">' . __("750 sqft (70 sqm)", "wprealestate") . '</option>
                    <option value="1000">' . __("1,000 sqft (93 sqm)", "wprealestate") . '</option>
                    <option value="1200">' . __("1,200 sqft (112 sqm)", "wprealestate") . '</option>
                    <option value="1500">' . __("1,500 sqft (139 sqm)", "wprealestate") . '</option>
                    <option value="2000">' . __("2,000 sqft (186 sqm)", "wprealestate") . '</option>
                    <option value="2500">' . __("2,500 sqft (232 sqm)", "wprealestate") . '</option>
                    <option value="3000">' . __("3,000 sqft (279 sqm)", "wprealestate") . '</option>
                    <option value="4000">' . __("4,000 sqft (372 sqm)", "wprealestate") . '</option>
                    <option value="5000">' . __("5,000 sqft (465 sqm)", "wprealestate") . '</option>
                    <option value="7500">' . __("7,500 sqft (697 sqm)", "wprealestate") . '</option>
                    <option value="10000">' . __("10,000 sqft (929 sqm)", "wprealestate") . '</option>
                </select>
                <select name="p_maxsize" class="cstm_s_big" id="p_maxsize" style="width:60px;">
                    <option selected="selected" value="">' . __("Max", "wprealestate") . '</option>
                    <option value="200">' . __("200 sqft (18 sqm)", "wprealestate") . '</option>
                    <option value="500">' . __("500 sqft (46 sqm)", "wprealestate") . '</option>
                    <option value="750">' . __("750 sqft (70 sqm)", "wprealestate") . '</option>
                    <option value="1000">' . __("1,000 sqft (93 sqm)", "wprealestate") . '</option>
                    <option value="1200">' . __("1,200 sqft (112 sqm)", "wprealestate") . '</option>
                    <option value="1500">' . __("1,500 sqft (139 sqm)", "wprealestate") . '</option>
                    <option value="2000">' . __("2,000 sqft (186 sqm)", "wprealestate") . '</option>
                    <option value="2500">' . __("2,500 sqft (232 sqm)", "wprealestate") . '</option>
                    <option value="3000">' . __("3,000 sqft (279 sqm)", "wprealestate") . '</option>
                    <option value="4000">' . __("4,000 sqft (372 sqm)", "wprealestate") . '</option>
                    <option value="5000">' . __("5,000 sqft (465 sqm)", "wprealestate") . '</option>
                    <option value="7500">' . __("7,500 sqft (697 sqm)", "wprealestate") . '</option>
                    <option value="10000">' . __("10,000 sqft (929 sqm)", "wprealestate") . '</option>
                </select>
                <div class="rspbreak"></div>';
        }
        if (in_array("p_location", $et_re_adv_flds)) {
            $frm_code .= '<label>' . __("Location", "wprealestate") . '</label>
                <select name="p_location" class="cstm_s" id="p_location">
                    <option selected="selected" value="">' . __("Any", "wprealestate") . '</option>';
            $frm_code .= '</select>
                <div class="rspbreak"></div>';
        }
        if (in_array("p_price", $et_re_adv_flds)) {
            $frm_code .= '<label class="labelbig">' . __("Price", "wprealestate") . '</label>
				<input style="width:50px;" type="text" name="p_minprice" id="p_minprice" maxlength="7" placeholder="' . __("Min", "wprealestate") . '" />
                <input style="width:50px;" type="text" name="p_maxprice" id="p_maxprice" maxlength="7" placeholder="' . __("Max", "wprealestate") . '" />
                <div class="rspbreak"></div>';
        }
        if (in_array("p_bedrooms", $et_re_adv_flds)) {
            $frm_code .= '<label>' . __("Bedrooms", "wprealestate") . '</label>
                <select name="p_bedrooms" class="cstm_s" id="p_bedrooms">
                    <option selected="selected" value="">' . __("Any", "wprealestate") . '</option>';
            $bd = 0;
            for ($bd = 1; $bd <= 20; $bd++) {
                $frm_code .= '<option ';
                if ($et_er_bedroom == $bd) {
                    $frm_code .= 'selected="selected"';
                }
                $frm_code .= ' >' . $bd . '</option>';
            }
            $frm_code .= '</select>
                <div class="rspbreak"></div>';
        }
        if (in_array("p_bathrooms", $et_re_adv_flds)) {
            $frm_code .= '<label>' . __("Bathrooms", "wprealestate") . '</label>
                <select name="p_bathrooms" class="cstm_s" id="p_bathrooms">
                    <option selected="selected" value="">' . __("Any", "wprealestate") . '</option>';
            $bt = 0;
            for ($bt = 1; $bt <= 20; $bt++) {
                $frm_code .= '<option';
                if ($et_er_bathroom == $bt) {
                    $frm_code .= ' selected="selected"';
                }
                $frm_code .= ' >' . $bt . '</option>';
            }
            $frm_code .= '</select>
                <div class="rspbreak"></div>';
        }
        if (in_array("p_furnishing", $et_re_adv_flds)) {
            $frm_code .= '<label>' . __("Furnishing", "wprealestate") . '</label>
                <select name="p_furnishing" class="cstm_s" id="p_furnishing">
                    <option selected="selected" value="">' . __("Not Applicable", "wprealestate") . '</option>
                    <option>' . __("Unfurnished", "wprealestate") . '</option>
                    <option>' . __("Semi Furnished", "wprealestate") . '</option>
                    <option>' . __("Fully Furnished", "wprealestate") . '</option>
            	</select>
                <div class="rspbreak"></div>';
        }
        if (in_array("p_cons_year", $et_re_adv_flds)) {
            $frm_code .= '<label class="labelbig">' . __("Year Constructed", "wprealestate") . '</label>
                <select name="p_constructed_min" class="cstm_s_big" id="p_constructed_min" style="width:60px;">
                    <option selected="selected" value="">' . __("Min", "wprealestate") . '</option>';

            $yr = date('Y');
            for ($x = 1960; $x <= $yr; $x++) {
                $frm_code .= '<option value="' . $x . '">' . $x . '</option>';
            }

            $frm_code .= '</select>
                <select name="p_constructed_max" class="cstm_s_big" id="p_constructed_max" style="width:60px;">
                    <option selected="selected" value="">' . __("Max", "wprealestate") . '</option>';

            $yr = date('Y');
            for ($x = 1980; $x <= $yr; $x++) {
                $frm_code .= '<option value="' . $x . '">' . $x . '</option>';
            }

            $frm_code .= '</select>
                <div class="rspbreak"></div>';
        }
        if (in_array("p_tenure", $et_re_adv_flds)) {
            $frm_code .= '<label>' . __("Tenure", "wprealestate") . '</label>
                <select name="p_tenure" class="cstm_s" id="p_tenure">
                    <option selected="selected" value="">' . __("Any", "wprealestate") . '</option>
                    <option>' . __("Freehold", "wprealestate") . '</option>
                    <option>' . __("Leasehold", "wprealestate") . '</option>';
            $frm_code .= '</select>
                <div class="rspbreak"></div>';
        }
        $args = array(
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => 0
        );
        $get_state_results = get_terms('state', $args);
        if (in_array("p_state", $et_re_adv_flds) && $get_state_results != "") {
            $frm_code .= '<label>' . __("State", "wprealestate") . '</label>
                <select id="p_state" name="p_state" class="cstm_s">
				  <option value="">Select States</option>';
            if ($get_state_results) {
                foreach ($get_state_results as $get_state_result) {
                    $frm_code .= '<option value="' . $get_state_result->term_id . '">' . $get_state_result->name . '</option>';
                }
            }
            $frm_code .= '</select>
                <div class="rspbreak"></div>';
        }
    }
    $frm_code .= '<input id="cstm_submit" type="submit" value="' . __("SEARCH", "wprealestate") . '" />
            <input name="adv_frm" type="hidden" id="adv_frm" value="1" />
<div style="clear:both;"></div>
            </form>
            </div>
        </div>
    </div>';
    return $frm_code;
}

add_shortcode('WP_RE_ADVANCED_SEARCH', 'property_advanced_search_form');
add_shortcode('WPRE_SEARCH', 'property_advanced_search_form');

function get_page_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

add_filter('widget_text', 'do_shortcode');

include 'shrtcd_property_list_filter.php';
include 'adm_pro_custom_details.php';
include 'wprealestate_vars.php';

if (file_exists(ET_RE_PATH . 'pro/pro_functions.php')) {
    include 'pro/pro_functions.php';
}
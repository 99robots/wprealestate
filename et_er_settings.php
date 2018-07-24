<div class="wrap">
    <h2>WP Real Estate - <?php _e('Settings', 'wprealestate'); ?></h2>
    <?php
    if (get_option('et_re_wg_bg_color') == '') {
        $et_re_wg_bg_color = '#ccc';
    } else {
        $et_re_wg_bg_color = get_option('et_re_wg_bg_color');
    }
    if (get_option('et_re_sent_copy_email') == '') {
        $et_re_sent_copy_email = get_option('admin_email');
    } else {
        $et_re_sent_copy_email = get_option('et_re_sent_copy_email');
    }
    if (get_option('et_re_pg_pro_list') <> '') {
        $et_re_pg_pro_list = get_option('et_re_pg_pro_list');
    }
    if (get_option('et_re_pp_listing') == '') {
        $et_re_pp_listing = '10';
    } else {
        $et_re_pp_listing = get_option('et_re_pp_listing');
    }
    if (get_option('et_re_adv_flds') == '') {
        $et_re_adv_flds = array('0' => 'p_list_type', '1' => 'p_type', '2' => 'p_bedrooms', '3' => 'p_bathrooms');
    } else {
        $et_re_adv_flds = get_option('et_re_adv_flds');
    }

    $p_pro_id_display = get_option('p_pro_id_display');
    $p_list_sidebar = get_option('p_list_sidebar');
    $p_detail_sidebar = get_option('p_detail_sidebar');
    $p_num_slider_pics = get_option('p_num_slider_pics');
    $p_share_buttons = get_option('p_share_buttons');
    $map_api_key = get_option('map_api_key');
    ?>

    <div class="ajxrsp" id="et_re_output_div"></div>
    <form id="form1" name="form1" method="POST" action="">
        <table width="600" border="0" cellspacing="1" cellpadding="2">
            <tr>
                <td width="250"><label for="ET_RE_Currency"><?php _e('Currency Symbol', 'wprealestate'); ?></label></td>
                <td width="339">
                    <input name="ET_RE_Currency" type="text" id="ET_RE_Currency" value="<?php echo get_option('ET_RE_Currency'); ?>"></td>
            </tr>
            <tr>
                <td><?php _e('Sent Copy Email', 'wprealestate'); ?></td>
                <td><input name="et_re_sent_copy_email" type="text" id="et_re_sent_copy_email" value="<?php echo $et_re_sent_copy_email; ?>" /></td>
            </tr>
            <tr>
                <td><?php _e('Search widget bg color', 'wprealestate'); ?></td>
                <td><input name="et_re_wg_bg_color" type="text" id="et_re_wg_bg_color" value="<?php echo $et_re_wg_bg_color; ?>" /></td>
            </tr>
            <tr>
                <td><?php _e('Property Listing Page', 'wprealestate'); ?></td>
                <td>
                    <select name="adv_page" id="adv_page">
                        <?php
                        $args_pages = array(
                            'posts_per_page' => -1,
                            'orderby' => 'post_date',
                            'order' => 'DESC',
                            'post_type' => 'page',
                            'post_status' => 'publish');

                        $myposts = get_posts($args_pages);
                        foreach ($myposts as $post) :
                            ?>
                            <option value="<?php echo $post->post_name; ?>" <?php if ($post->ID == $et_re_pg_pro_list) { ?> selected="selected"<?php } ?>><?php echo $post->post_title; ?></option>
                        <?php endforeach; ?>
                    </select></td>
            </tr>
            <?php
            if (file_exists(ET_RE_PATH . 'pro/pro_et_er_settings.php')) {
                include ET_RE_PATH . 'pro/pro_et_er_settings.php';
            }
            ?>
            <tr>
                <td><?php _e('Number of listing per page', 'wprealestate'); ?></td>
                <td><input name="et_re_pp_listing" type="text" id="et_re_pp_listing" value="<?php echo $et_re_pp_listing; ?>" /></td>
            </tr>
            <tr>
                <td><?php _e('Sidebar in property listing page?', 'wprealestate'); ?></td>
                <td><label for="p_list_sidebar"></label>
                    <select name="p_list_sidebar" id="p_list_sidebar">
                        <option value="1" <?php if ($p_list_sidebar == 1) { ?> selected="selected"<?php } ?>><?php _e('Yes', 'wprealestate'); ?></option>
                        <option value="0" <?php if ($p_list_sidebar == 0) { ?> selected="selected"<?php } ?>><?php _e('Full Width', 'wprealestate'); ?></option>
                    </select></td>
            </tr>
            <tr>
                <td><?php _e('Sidebar in property detail page?', 'wprealestate'); ?></td>
                <td><label for="p_detail_sidebar"></label>
                    <select name="p_detail_sidebar" id="p_detail_sidebar">
                        <option value="1" <?php if ($p_detail_sidebar == 1) { ?> selected="selected"<?php } ?>><?php _e('Yes', 'wprealestate'); ?></option>
                        <option value="0" <?php if ($p_detail_sidebar == 0) { ?> selected="selected"<?php } ?>><?php _e('Full Width', 'wprealestate'); ?></option>
                    </select></td>
            </tr>
            <tr>
                <td><?php _e('Display Property ID (in listing)', 'wprealestate'); ?></td>
                <td><select name="p_pro_id_display" id="p_pro_id_display">
                        <option value="1" <?php if ($p_pro_id_display == 1) { ?> selected="selected"<?php } ?>><?php _e('Yes', 'wprealestate'); ?></option>
                        <option value="0" <?php if ($p_pro_id_display == 0) { ?> selected="selected"<?php } ?>><?php _e('No', 'wprealestate'); ?></option>
                    </select></td>
            </tr>
            <tr>
                <td><?php _e('Max Property Photos', 'wprealestate'); ?></td>
                <td><input name="p_num_slider_pics" type="text" id="p_num_slider_pics" value="<?php echo $p_num_slider_pics; ?>" /></td>
            </tr>
            <tr>
                <td><?php _e('Display social share buttons', 'wprealestate'); ?></td>
                <td><select name="p_share_buttons" id="p_share_buttons">
                        <option value="1" <?php if ($p_share_buttons == 1) { ?> selected="selected"<?php } ?>><?php _e('Yes', 'wprealestate'); ?></option>
                        <option value="0" <?php if ($p_share_buttons == 0) { ?> selected="selected"<?php } ?>><?php _e('No', 'wprealestate'); ?></option>
                    </select></td>
            </tr>
            <tr>
                <td><?php _e('Google Map API Key', 'wprealestate'); ?></td>
                <td><input name="map_api_key" type="text" id="map_api_key" value="<?php echo $map_api_key; ?>" /><br />
                    <?php _e('To disable Google maps display, set API key empty.', 'wprealestate'); ?>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><?php _e('More options coming soon...', 'wprealestate'); ?></td>
                <td><input type="submit" name="button" id="et_re_submit" value="Save Options" class="button-primary">
                    <img src="<?php echo admin_url('/images/wpspin_light.gif'); ?>" class="waiting" style="display:none;" id="et_re_loading" />
                </td>
            </tr>
            <tr>
                <td><a href="http://www.etechy101.com/wp-real-estate-wordpress-plugin" target="_blank"><?php _e('Suggest us more features', 'wprealestate'); ?></a></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </form>
    <br />
    <div class="ajxrsp" id="et_re_output_div_2"></div>
    <form id="form2" name="form2" method="post" action="">
        <table width="465" border="0" cellspacing="1" cellpadding="2">
            <tr>
                <td><h3><?php _e('Customize Advanced Search <em>(Mark what you want to show)', 'wprealestate'); ?></em></h3></td>
            </tr>
            <tr>
                <td><strong><?php _e('Note', 'wprealestate'); ?></strong>: <em><?php _e('Please fill the fields in property details if you have enabled the fields to be searchable below.', 'wprealestate'); ?></em></td>
            </tr>
            <tr>
                <td width="459"><input type="checkbox" name="adv_fld3" id="adv_fld3" disabled="disabled" /><?php _e('Property Title', 'wprealestate'); ?> <em><?php _e('(Required)', 'wprealestate'); ?></em></td>
            </tr>
            <tr>
                <td>
                    <input name="adv_fld[]" type="checkbox" id="adv_fld[]" value="p_list_type" <?php if (in_array("p_list_type", $et_re_adv_flds)) { ?> checked="checked"<?php } ?> />
                    <label for="adv_fld"></label>
                    <?php _e('Listing Type (Sale/Rent)', 'wprealestate'); ?></td>
            </tr>
            <tr>
                <td>
                    <input name="adv_fld[]" type="checkbox" id="adv_fld[]" value="p_type" <?php if (in_array("p_type", $et_re_adv_flds)) { ?> checked="checked"<?php } ?> />
                    <?php _e('Property Type', 'wprealestate'); ?></td>
            </tr>
            <tr>
                <td>
                    <input name="adv_fld[]" type="checkbox" id="adv_fld[]" value="p_price" <?php if (in_array("p_price", $et_re_adv_flds)) { ?> checked="checked"<?php } ?> />
                    <?php _e('Price Range', 'wprealestate'); ?></td>
            </tr>
            <tr>
                <td><input name="adv_fld[]" type="checkbox" id="adv_fld[]" value="p_size" <?php if (in_array("p_size", $et_re_adv_flds)) { ?> checked="checked"<?php } ?> />
                    <?php _e('Size Range', 'wprealestate'); ?></td>
            </tr>
            <tr>
                <td><input name="adv_fld[]" type="checkbox" id="adv_fld[]" value="p_bedrooms" <?php if (in_array("p_bedrooms", $et_re_adv_flds)) { ?> checked="checked"<?php } ?> />
                    <?php _e('Bedrooms', 'wprealestate'); ?></td>
            </tr>
            <tr>
                <td><input name="adv_fld[]" type="checkbox" id="adv_fld[]" value="p_bathrooms" <?php if (in_array("p_bathrooms", $et_re_adv_flds)) { ?> checked="checked"<?php } ?> />
                    <?php _e('Bathrooms', 'wprealestate'); ?></td>
            </tr>
            <tr>
                <td><input name="adv_fld[]" type="checkbox" id="adv_fld[]" value="p_furnishing" <?php if (in_array("p_furnishing", $et_re_adv_flds)) { ?> checked="checked"<?php } ?> />
                    <?php _e('Furnishing', 'wprealestate'); ?>
                </td>
            </tr>
            <tr>
                <td><input name="adv_fld[]" type="checkbox" id="adv_fld[]" value="p_tenure" <?php if (in_array("p_tenure", $et_re_adv_flds)) { ?> checked="checked"<?php } ?> /><?php _e('Tenure', 'wprealestate'); ?> </td>
            </tr>
            <tr>
                <td>

                </td>
            </tr>
            <tr>
                <td><input name="adv_fld[]" type="checkbox" id="adv_fld[]" value="p_cons_year" <?php if (in_array("p_cons_year", $et_re_adv_flds)) { ?> checked="checked"<?php } ?> />
                    <?php _e('Construction Year', 'wprealestate'); ?></td>
            </tr>
            <tr>
                <td><input name="adv_fld[]" type="checkbox" id="adv_fld[]" value="p_state" <?php if (in_array("p_state", $et_re_adv_flds)) { ?> checked="checked"<?php } ?> />
                    <?php _e('State', 'wprealestate'); ?></td>
            </tr>
            <tr>
                <td><input type="submit" name="button2" id="et_re_sv_search" value="<?php _e('Save', 'wprealestate'); ?>" class="button-primary" /> <img src="<?php echo admin_url('/images/wpspin_light.gif'); ?>" class="waiting" style="display:none;" id="et_re_loading2" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input name="frm" type="hidden" id="frm" value="2" /></td>
            </tr>
        </table>
    </form>

</div>
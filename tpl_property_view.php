<?php
get_header();
$p_detail_sidebar = get_option('p_detail_sidebar');
if ($p_detail_sidebar == 1) {
    $divclass_j = 'prpmaindvleft'; // sidebar enabled
} else {
    $divclass_j = 'prpmaindvfull'; //sidebar disabled
}
global $post;
the_post();
if ($_POST) {

    $get_property_user = get_userdata($post->post_author);
    if (get_option('et_re_sent_copy_email') == '') {
        $et_re_sent_copy_email = get_option('admin_email');
    } else {
        $et_re_sent_copy_email = get_option('et_re_sent_copy_email');
    }

    if (file_exists(ET_RE_PATH . 'pro/pro_tpl_property_view.php')) {
        include ET_RE_PATH . 'pro/pro_tpl_property_view.php';
    }

    $inq_msg = __('An inquiry received from your site', 'wprealestate') . ' ' . bloginfo('name') . '<br /><br />';
    $inq_msg .= __('Property URL', 'wprealestate') . ': ' . get_permalink($post->ID) . '<br />';
    $inq_msg .= __('Name', 'wprealestate') . ': ' . $_REQUEST['inq_name'] . '<br />';
    $inq_msg .= __('Email', 'wprealestate') . ': ' . $_REQUEST['inq_email'] . '<br />';
    $inq_msg .= __('Phone', 'wprealestate') . ': ' . $_REQUEST['inq_phone'] . '<br />';
    $inq_msg .= __('Message', 'wprealestate') . ': ' . $_REQUEST['inq_message'] . '<br />';
    $inq_msg .= __('User IP', 'wprealestate') . ': ' . $_SERVER['REMOTE_ADDR'] . '<br />';

    sendmail($_REQUEST['inq_name'], $et_re_sent_copy_email, $_REQUEST['inq_email'], __('Message from', 'wprealestate') . ' ' . bloginfo('name'), $inq_msg);

    global $wp_rewrite;
    if ($wp_rewrite->permalink_structure == '') {
        wp_redirect(get_permalink($post->ID) . '&msg=1');
    } else {
        wp_redirect(get_permalink($post->ID) . '?msg=1');
    }
    exit;
}
?>
<script type="text/javascript">var switchTo5x = true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "72af30ed-8290-4178-b5d1-3fdb0b5c43a3", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script type="text/javascript">
    jQuery(window).load(function() {
        jQuery('#inq_form').submit(function() {
            if (jQuery('#inq_name').val() == "") {
                alert('<?php _e('Please enter your name', 'wprealestate'); ?>');
                jQuery('#inq_name').focus();
                return false;
            }
            if (jQuery('#inq_email').val() == "") {
                alert('<?php _e('Please enter your email', 'wprealestate'); ?>');
                jQuery('#inq_email').focus();
                return false;
            } else {
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                var emailaddressVal = jQuery('#inq_email').val();
                if (!emailReg.test(emailaddressVal)) {
                    alert("<?php _e('Invalid Email', 'wprealestate'); ?>");
                    jQuery('#inq_email').focus();
                    return false;
                }
            }
            if (jQuery('#inq_phone').val() == "") {
                alert('<?php _e('Please enter your phone number', 'wprealestate'); ?>');
                jQuery('#inq_phone').focus();
                return false;
            }
            if (jQuery('#inq_message').val() == "") {
                alert('<?php _e('Please enter your message', 'wprealestate'); ?>');
                jQuery('#inq_message').focus();
                return false;
            }
            return true;
        });

        // The slider being synced must be initialized first
        jQuery('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 210,
            itemMargin: 5,
            asNavFor: '#slider'
        });

        jQuery('#slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel"
        });
    });
</script>
<div class="<?php echo sanitize_html_class($divclass_j); ?>">
    <div id="PropertyMainDiv" <?php if ($p_detail_sidebar == 1) { ?> style="" <?php } ?>>
        <div class="wpreproprty_title">
            <h1><?php the_title(); ?></h1>
            <div class="prpty_detailpg_label"><p class="sale"><?php echo get_post_meta($post->ID, 'et_er_adtype', true) . '<br />'; ?></p>
            </div>
        </div>
        <?php /* ?><h3 class="address">
          <?php
          if (get_post_meta($post->ID, 'et_er_address', true)) {
          echo get_post_meta($post->ID, 'et_er_address', true).', ';
          }
          if (get_post_meta($post->ID, 'et_er_area_location', true)) {
          echo get_post_meta($post->ID, 'et_er_area_location', true).', ';
          }

          echo get_post_meta($post->ID, 'et_er_city', true).' '.get_post_meta($post->ID, 'et_er_zipcode', true); ?></h3><?php */ ?>
        <div class="SpacerDiv"></div>
        <?php
        $property_imgs = get_property_images_ids();
        if ($property_imgs == true) {
            ?>
            <div class="ProPhotos">
                <!-- Place somewhere in the <body> of your page -->
                <div id="slider" class="flexslider">
                    <ul class="slides">
                        <?php foreach ($property_imgs as $img_id) { ?>
                            <li>
                                <?php echo wp_get_attachment_image($img_id, 'full'); ?>
                            </li>
                        <?php } ?>

                        <!-- items mirrored twice, total of 12 -->
                    </ul>
                </div>
                <?php
                $property_arr_size = count($property_imgs);
                if ($property_arr_size > 1) {
                    ?>
                    <div id="carousel" class="flexslider">
                        <ul class="slides">
                            <?php foreach ($property_imgs as $img_id) { ?>
                                <li>
                                    <?php echo wp_get_attachment_image($img_id); ?>
                                </li>
                            <?php } ?>

                            <!-- items mirrored twice, total of 12 -->
                        </ul>
                    </div>
                <?php } ?>
            </div>

            <div class="prpsharebtns">
                <?php
            }
            if (get_option('p_share_buttons') == 1) {
                ?>
                <span class='st_fblike_hcount' displayText='<?php _e('Facebook Like', 'wprealestate'); ?>'></span>
                <span class='st_twitter_hcount' displayText='<?php _e('Tweet', 'wprealestate'); ?>'></span>
                <span class='st_googleplus_hcount' displayText='<?php _e('Google+', 'wprealestate'); ?>'></span>
                <span class='st_sharethis_hcount' displayText='<?php _e('ShareThis', 'wprealestate'); ?>'></span>
            <?php } ?>
        </div>

        <div id="    ProDescription">
            <div class="prptdesc">
                <?php the_content(); ?>
            </div>
            <div class="prpdheading"><?php _e('Property Details', 'wprealestate'); ?></div>
            <?php /* ?><div class=" SpecLabel">
              <?php _e( 'Property Name', 'wprealestate' ); ?>:<br>
              <?php _e( 'Property Address', 'wprealestate' ); ?>:
              </div>
              <div class="SpecInfo">
              <?php
              echo get_post_meta($post->ID, 'et_er_property_name', true).'<br>';
              echo get_post_meta($post->ID, 'et_er_address', true).', '.get_post_meta($post->ID, 'et_er_area_location', true).', '.get_post_meta($post->ID, 'et_er_city', true).' '.get_post_meta($post->ID, 'et_er_zipcode', true).' '.get_post_meta($post->ID, 'et_er_state', true); ?>
              </div><?php */ ?>

            <div>
                <ul class="prptyp_list">
                    <li><strong><?php _e('Property Type', 'wprealestate'); ?></strong>: <?php echo get_post_meta($post->ID, 'et_er_type', true) . '<br />'; ?></li>

                    <?php if (get_post_meta($post->ID, 'et_er_price', true) <> '0') { ?>
                        <li><strong><?php _e('Price', 'wprealestate'); ?></strong>: <?php echo ET_RE_Currency . get_post_meta($post->ID, 'et_er_price', true) . '<br />'; ?></li>
                    <?php } ?>
                    <?php if (get_post_meta($post->ID, 'et_er_rent_price', true) <> '0') { ?>
                        <li><strong><?php _e('Rent', 'wprealestate'); ?></strong>: <?php echo ET_RE_Currency . get_post_meta($post->ID, 'et_er_rent_price', true) . ' ' . get_post_meta($post->ID, 'et_er_rent_tenure', true) . '<br />'; ?></li>
                    <?php } ?>

                    <?php if (get_post_meta($post->ID, 'et_er_built_size', true) <> '0') { ?>
                        <li><strong><?php _e('Built up', 'wprealestate'); ?></strong>: <?php echo get_post_meta($post->ID, 'et_er_built_size', true) . '<br />'; ?></li>
                    <?php } ?>

                    <?php if (get_post_meta($post->ID, 'et_er_land_size', true) <> '0') { ?>
                        <li><strong><?php _e('Land area', 'wprealestate'); ?></strong>: <?php echo get_post_meta($post->ID, 'et_er_land_size', true) . '<br />'; ?></li>
                    <?php } ?>

                    <?php if (get_post_meta($post->ID, 'et_er_bedroom', true) <> '0') { ?>
                        <li><strong><?php _e('Bedroom', 'wprealestate'); ?></strong>: <?php echo get_post_meta($post->ID, 'et_er_bedroom', true) . '<br />'; ?></li>
                    <?php } ?>

                    <?php if (get_post_meta($post->ID, 'et_er_bathroom', true) <> '0') { ?>
                        <li><strong><?php _e('Bathroom', 'wprealestate'); ?></strong>: <?php echo get_post_meta($post->ID, 'et_er_bathroom', true) . '<br />'; ?></li>
                    <?php } ?>

                    <?php if (get_post_meta($post->ID, 'et_er_furnishing', true) <> '0') { ?>
                        <li><strong><?php _e('Furnishing', 'wprealestate'); ?></strong>: <?php echo get_post_meta($post->ID, 'et_er_furnishing', true) . '<br />'; ?></li>
                    <?php } ?>

                    <?php if (get_post_meta($post->ID, 'et_er_tenure', true) <> '0') { ?>
                        <li><strong><?php _e('Tenure', 'wprealestate'); ?></strong>: <?php echo get_post_meta($post->ID, 'et_er_tenure', true) . '<br />'; ?></li>
                    <?php } ?>

                    <?php if (get_post_meta($post->ID, 'et_er_date_vacant', true) <> '0') { ?>
                        <li><strong><?php _e('Date Available', 'wprealestate'); ?></strong>: <?php echo get_post_meta($post->ID, 'et_er_date_vacant', true) . '<br />'; ?></li>
                    <?php } ?>
                    <div class="clear"></div>
                </ul>

                <div class="prpdheading"><?php _e('Property Features', 'wprealestate'); ?></div>
                <?php
                $terms = get_the_terms($post->ID, 'facility');
                if ($terms && !is_wp_error($terms)) {
                    ?>
                    <?php echo get_the_term_list($post->ID, 'facility', '<ul class="prptfacility  "><li>', '</li><li>', '</li><div class="clear"></div></ul>'); ?>

                <?php } ?>
            </div>
            <?php
            $map_api_key = get_option('map_api_key');
            if ($map_api_key) {
                ?>
                <div class="prptlcation">
                    <div class="prpdheading"><?php _e('Location Map', 'wprealestate'); ?></div>
                    <?php
                    $property_state = get_post_meta(get_the_ID(), 'et_er_state', true);
                    $pro_state_name = get_term($property_state, 'state');


                    $full_gmap_address = get_post_meta(get_the_ID(), 'et_er_address', true) . ' ' . get_post_meta(get_the_ID(), 'et_er_city', true) . ' ' . $pro_state_name->name . ' ' . get_post_meta(get_the_ID(), 'et_er_zipcode', true);
                    ?>
                    <iframe class="wpmb-pro-details-map" src="https://www.google.com/maps/embed/v1/place?key=<?php echo $map_api_key; ?>&q=<?php echo $full_gmap_address;
                    ?>" style="width:100%; height:460px;" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            <?php } ?>

            <div class = "prptinqfrm">
                <?php if (isset($_REQUEST['msg']) && $_REQUEST['msg'] == 1) {?>
                    <div style="color:#060; font-weight:bold; margin:5px;"><?php _e('Inquiry has been sent to the Agent', 'wprealestate'); ?></div>
                <?php } ?>
                <form name="inq_form" id="inq_form" method="post">
                    <div class="prpdheading"><?php _e('Send An Inquiry To The Agent', 'wprealestate'); ?></div>

                    <label><?php _e('Your Name', 'wprealestate'); ?>*</label>
                    <input name="inq_name" id="inq_name" type="text" class="txtinqfrm1">

                    <label><?php _e('Your Email', 'wprealestate'); ?>*</label>
                    <input name="inq_email" id="inq_email" type="text" class="txtinqfrm1">

                    <label><?php _e('Your Phone', 'wprealestate'); ?>*</label>
                    <input name="inq_phone" id="inq_phone" type="text" class="txtinqfrm1">

                    <label><?php _e('Message', 'wprealestate'); ?>*</label>
                    <textarea name="inq_message" id="inq_message" class="txtinqfrm2"></textarea>

                    <input name="submit" type="submit" value="<?php _e('Send Inquiry', 'wprealestate'); ?>" class="txtinqfrm3">

                </form>
            </div>
            <div class="clear"></div>
        </div>


    </div>
    <div class="clear"></div>
</div>
<?php if ($p_detail_sidebar == 1) { ?>
    <div class="prpmaindvright prptysidbr">
        <?php get_sidebar(); ?>
    </div>
<?php } ?>

<div class="clear"></div>
<?php get_footer(); ?>
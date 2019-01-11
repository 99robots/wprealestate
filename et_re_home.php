<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<style>
.dflex{
  display: flex;
}
.mb10{
  margin-bottom: 10px !important;
}
.mr10{
  margin-right: 10px;
}
.pt3{
  padding-top: 3px;
}
.pull-right{
  float: right;
}
.pull-left{
  float: left;
}
.info-box{
  padding: 20px;
  background: #fff;
  display: inline-block;
  width: 40%;
  border: 1px solid #e5e5e5;
  box-shadow: 0 1px 1px rgba(0,0,0,.04);
  margin-bottom: 10px;
}
.bg-white{
  background: #f5f5f5;
}
.fs16{
  font-size: 16px;
}
.text-green{
  color: green;
}
@media only screen and (max-width: 768px){
  .info-box{
    width: auto;
    float: none !important;
  }
}
</style>
<div class="wrap">
  <h1>Dashboard</h1>
  <div id="welcome-panel" class="welcome-panel">
    <div class="welcome-panel-content">
      <h1>WP Real Estate - <?php _e('Home', 'wprealestate'); ?></h1>
      <p class="about-description">Here are some details to get you started:</p>
      <div class="welcome-panel-column-container">
        <div class="welcome-panel-column">
          <h3 class="">Get Familiar - </h3>
          <a class="button button-primary button-hero" href="http://www.youtube.com/watch?v=PDkLs5lj9G4" target="_blank"><i class="fab fa-youtube mr10"></i> Watch A Quick Tutorial</a>
        </div>
        <div class="welcome-panel-column">
          <h3>Quick Steps</h3>
          <ul>
            <li class="dflex"><i class="fas fa-plus pt3 mr10"></i> <a href="<?php echo admin_url('admin.php?page=WPRealEstatePropertyType');?>">To Create A Property Type, Click Here</a></li>
            <li class="dflex"><i class="far fa-edit pt3 mr10"></i> <a href="<?php echo admin_url('edit.php?post_type=property');?>">To Add / List A New Property, Click Here</a></li>
            <li class="dflex"><i class="fas fa-pencil-alt pt3 mr10"></i> <a href="<?php echo admin_url('admin.php?page=WPRealEstateSettings');?>">To View/Edit/Customize Settings, Click Here</a></li>
            <li class="dflex"></li>
            <li class="dflex"></li>
          </ul>
        </div>
        <div class="welcome-panel-column welcome-panel-last">
          <h3>Support</h3>
          <ul>
            <li class="dflex"><i class="far fa-smile-beam pt3 mr10"></i> <?php
                _e('Thank you for choosing WP Real Estate plugin. We hope you will like the plugin and enjoy using it. Please leave us a review if you like our plugin.', 'wp-jobs');
                ?>
            </li>
            <li class="dflex"><i class="far fa-question-circle pt3 mr10"></i> <a href="mailto:sales@intensewp.com"><?php _e('If you have any support query or your feedback, please feel free to send an email to sales@intensewp.com', 'wprealestate'); ?></a></li>
            <li class="dflex"><i class="fas fa-headset pt3 mr10"></i> <a href="http://support.intensewp.com/" target="_blank"><?php _e('You can also visit our Support Help Desk by clicking here', 'wp-jobs'); ?></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div> <!-- Welcome Panel -->
  <div class="info-box pull-left">
    <h3><?php _e('Advanced Property Search', 'wprealestate'); ?></h3>
    <p><?php _e('Add this shortcode <strong>[WPRE_SEARCH]</strong> anywhere in post, page or sidebar widget. It will display the advanced property search form.', 'wprealestate'); ?></p>
    <p><?php
    _e('<strong>NOTE</strong>: <em>If you face 404 page not found errors, please go to your <a href="options-permalink.php">wp-admin &gt; settings &gt; permalinks</a> and simply press the save button. It will reset your permalinks and make the plugins links active. Pressing the save button does not need to change the actual permalinks configuration.</em>', 'wprealestate');
    ?></p>
  </div>
  <div class="info-box pull-right">
    <h3><?php _e('What is new in WP Real Estate', 'wprealestate'); ?></h3>
    <ul style="list-style: disc inside none;">
        <li><?php _e('Beautiful Listing and Detailed View page designs', 'wprealestate'); ?></li>
        <li><?php _e('Flex slider for property images', 'wprealestate'); ?></li>
        <li><?php _e('Google Property Map (enter API Key in settings)', 'wprealestate'); ?></li>
        <li><?php _e('Separate rent and sale price', 'wprealestate'); ?></li>
        <li><?php _e('Unlimited property photos can be added', 'wprealestate'); ?></li>
        <li><?php _e('Advanced Property Search (Enable / Disable Fields from Settings page)', 'wprealestate'); ?></li>
        <li><?php _e('Enable/Disable social sharing', 'wprealestate'); ?></li>
        <li><?php _e('Custom property types have been added. You can add or manage your own <a href="admin.php?page=WPRealEstatePropertyType">custom property types from here</a>.', 'wprealestate'); ?></li>
        <li><?php _e('Advanced property search has been added. You can customize the form by selecting what fields you want to use for <a href="admin.php?page=WPRealEstateSettings">advanced search from here</a>.', 'wprealestate'); ?></li>
        <li><?php _e('Also make sure you have selected the correct property listing page.', 'wprealestate'); ?></li>
        <li><?php _e('Translation friendly. Contact me at hozyali@gmail.com if you can help with new translations or need help with existing translations.', 'wprealestate'); ?></li>
    </ul>
  </div>
  <div style="clear:both;"></div>
<hr />
<?php _e('<p>Would you like us to feature your website in our show case? Please send us your name, email and website address to <a href="mailto:sales@intensewp.com">sales@intensewp.com</a> and we will be glad to feature your website using WP Real Estate on our website\'s show case.</p>', 'wprealestate'); ?>

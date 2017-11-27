<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wp_Social_Pane
 * @subpackage Wp_Social_Pane/public/partials
 */

$options 	= get_option( $this->plugin_name . '_options' );
$social_icons = $options['social-option'];
$social_order = $options['display-order'];
$where = $options['where_option'];
$display_color = $options['social-btn-color']; ?>

<!-- Social Pane Start -->
<div class="social-pane-section <?php echo $where; ?>">
  <ul class="social-pane-list">
  <?php
  $url = urlencode( get_permalink() );

//  remove_filter('the_title','wptexturize');
  $title = urlencode(html_entity_decode(get_the_title()));
//  add_filter('the_title','wptexturize');

  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium' );
  $thumb_url = $thumb['0'];
  $social_image = $thumb_url;
  $social_image = urlencode($social_image);

  foreach ($social_order as $social) {
    if ( in_array($social, $social_icons) ) { ?>
      <li class="social-pane-list-item">
      <?php switch ($social) {
        case 'facebook': ?>
          <a rel="external nofollow" class="social-pane-item <?php echo $social; ?>" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>">
            <i class="fa fa-facebook-official"></i>
          </a>
          <?php break;
        case 'twitter': ?>
          <a rel="external nofollow" class="social-pane-item <?php echo $social; ?>" target="_blank" href="http://twitter.com/intent/tweet/?text=<?php echo $title; ?>&url=<?php echo $url; ?>">
            <i class="fa fa-twitter"></i>
          </a>
          <?php break;
        case 'pinterest': ?>
          <a rel="external nofollow" class="social-pane-item <?php echo $social; ?>" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo $url;?>&media=<?php echo $social_image;?>&description=<?php echo $title;?>">
            <i class="fa fa-pinterest"></i>
          </a>
          <?php break;
        case 'google': ?>
          <a rel="external nofollow" class="social-pane-item <?php echo $social; ?>" target="_blank" href="https://plus.google.com/share?url=<?php echo $url; ?>">
            <i class="fa fa-google-plus-official"></i>
          </a>
          <?php break;
        case 'linkedin': ?>
          <a rel="external nofollow" class="social-pane-item <?php echo $social; ?>" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo substr($url,0,1024);?>&title=<?php echo substr($title,0,200);?>">
            <i class="fa fa-linkedin-square"></i>
          </a>
          <?php break;
        case 'whatsapp': ?>
          <a rel="external nofollow" class="social-pane-item <?php echo $social; ?> wa_btn wa_btn_s" target="_blank" href="whatsapp://send?text=<?php echo $url; ?>" data-text="<?php echo $title; ?>">
            <i class="fa fa-whatsapp"></i>
          </a>
          <?php break;
      } ?>
      </li>
    <?php }
  } ?>
  </ul>
</div>
<!-- Social Pane End -->


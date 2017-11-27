<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wp_Social_Pane
 * @subpackage Wp_Social_Pane/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

    <form method="post" action="options.php">

        <?php
          settings_fields('wp_social_pane_options');

          do_settings_sections('wp_social_pane-options');

          submit_button('Save Settings');
        ?>

    </form>

</div>
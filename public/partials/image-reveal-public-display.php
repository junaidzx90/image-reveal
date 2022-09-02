<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Image_Reveal
 * @subpackage Image_Reveal/public/partials
 */
?>

<div class="image_reveal">
    <div class="reveal_images">
        <?php 
        global $wpdb;
        $revID = $atts['id'];
        $row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}image_reveal WHERE ID = $revID");
        if($row){
            $images = unserialize($row->data);
            $counts = 0;
            foreach($images as $image){
                ?>
                <div class="rev_img <?php echo (($counts === 0)?'active': '') ?>">
                    <img src="<?php echo $image ?>">
                </div>
                <?php
                $counts++;
            }
        }
        ?>
    </div>

    <button data-reveald="1" class="reveal_image_btn">Reveal</button>
</div>
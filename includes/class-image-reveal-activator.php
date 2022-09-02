<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Image_Reveal
 * @subpackage Image_Reveal/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Image_Reveal
 * @subpackage Image_Reveal/includes
 * @author     Developer Junayed <admin@easeare.com>
 */
class Image_Reveal_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		$image_reveal = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}image_reveal` (
			`ID` INT NOT NULL AUTO_INCREMENT,
			`title` VARCHAR(255) NOT NULL,
			`data` LONGTEXT NOT NULL,
			`date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`ID`)) ENGINE = InnoDB";
		dbDelta($image_reveal);
	}

}

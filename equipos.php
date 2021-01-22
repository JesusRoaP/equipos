<?php
/**
 * Plugin Name: Equipos
 * Plugin URI: 
 * Description: Crea un slider con equipos de trabajo.
 * Version: 1.0
 * Author: Jesus Mauricio Roa Polania
 * Author URI: 
 * Text Domain: equipos
 * License: GPL2
 */

/* Defines plugin's root folder. */
define( 'EQ_PATH', plugin_dir_path( __FILE__ ) );


/* Defines plugin's text domain. */
define( 'EQ_NAME', 'equipos' );


/* Scripts. */
require_once('inc/equipos-front-scripts.php');
require_once('inc/equipos-admin-scripts.php');


/* Teams. */
require_once('inc/equipos-post-type.php');


/* Shortcode. */
require_once('inc/equipos-shortcode-column.php');
require_once('inc/equipos-shortcode.php');


/* Registers metaboxes. */
require_once('inc/equipos-metaboxes-members.php');
require_once('inc/equipos-metaboxes-settings.php');
require_once('inc/equipos-metaboxes-help.php');


/* Saves metaboxes. */
require_once('inc/equipos-save-metaboxes.php');

?>
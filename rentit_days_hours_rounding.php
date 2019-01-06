<?php
/**
 * @package Rentit_Days_Hours_Rounding
 * @version 1.0
 */
/*
Plugin Name: Rentit Days Hours Rounding
Plugin URI: https://wordpress.org/plugins/hello-dolly/
Description: flooring or ceiling days or hours and how round it
Version: 1.0
Author URI: https://ma.tt/
Text Domain: Rentit_Days_Hours_Rounding
*/

/***LOAD THIS PLUGIN FIRStLY***/
/***to override original function of rentit_DateDiff***/
add_action( 'activated_plugin', 'my_plugin_load_first' );
function my_plugin_load_first()
{
    $path = str_replace( WP_PLUGIN_DIR . '/', '', __FILE__ );
    if ( $plugins = get_option( 'active_plugins' ) ) {
        if ( $key = array_search( $path, $plugins ) ) {
            array_splice( $plugins, $key, 1 );
            array_unshift( $plugins, $path );
            update_option( 'active_plugins', $plugins );
        }
    }
}
global $pagenow;
/**check to not define this function on pluging activating page because of conflic and falat error**/
if($pagenow != 'plugins.php'){
	function rentit_DateDiff( $interval, $date1, $date2 ) {
		// get seconds
		$timedifference = $date2 - $date1;

		switch ( $interval ) {
			case 'w':
				$retval = floor( $timedifference / 604800 );
				break;
			case 'd':
				$retval = floor( $timedifference / 86400 );
				break;
			case 'h':
				$retval = floor( $timedifference / 3600 );
				break;
			case 'n':
				$retval = bcdiv( $timedifference, 60 );
				break;
			case 's':
				$retval = $timedifference;
				break;

		}

		return $retval;

	}
}
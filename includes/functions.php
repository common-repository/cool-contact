<?php


    function stripslashes_array(&$arr) {
        foreach ($arr as $k => &$v) {
        $nk = stripslashes($k);
            if ($nk != $k) {
                $arr[$nk] = &$v;
                unset($arr[$k]);
            }
            if (is_array($v)) {
                stripslashes_array($v);
            } else {
                $arr[$nk] = stripslashes($v);
            }
        }
    }
/**
 * Get the absolute filesystem path to the root of the WordPress installation
 *
 * @since 1.5.0
 *
 * @uses get_option
 * @return string Full filesystem path to the root of the WordPress installation
 * from file.php in admin includes
 */
function ai_get_home_path() {
	$home = get_option( 'home' );
	$siteurl = get_option( 'siteurl' );
	if ( ! empty( $home ) && 0 !== strcasecmp( $home, $siteurl ) ) {
		$wp_path_rel_to_home = str_ireplace( $home, '', $siteurl ); /* $siteurl - $home */
		$pos = strripos( str_replace( '\\', '/', $_SERVER['SCRIPT_FILENAME'] ), trailingslashit( $wp_path_rel_to_home ) );
		$home_path = substr( $_SERVER['SCRIPT_FILENAME'], 0, $pos );
		$home_path = trailingslashit( $home_path );
	} else {
		$home_path = ABSPATH;
	}

	return str_replace( '\\', '/', $home_path );
}

?>
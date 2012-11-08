<?php

namespace Pixel418\Soliloque;


/* AUTOLOAD */
spl_autoload_register( function( $class ) {

	// is the asked namespace match mine ?
	$namespace_match = __NAMESPACE__ . '\\';
	$namespace_length = strlen( $namespace_match );
	if ( substr( $class, 0, $namespace_length ) == $namespace_match ) {

		// So, I tried to load one of my classes
		$relative_class = substr( $class, $namespace_length );
		$class_path = __DIR__ . '/class/' . str_replace( '\\', '/', $relative_class ) . '.php';
		if ( is_file( $class_path ) ) {
			require_once( $class_path );
		}
	}
} );


/* LIB */
require_once( __DIR__ . '/lib/php-markdown/markdown.php' );


/* UTILS */
function template_path( $class ) {
	$template_path_by_folder = function( $folder, $theme, $name ) {
		$path = $folder . '/theme/' . $theme . '/template/' . $name . '.php';
		if ( is_file( $path ) ) {
			return $path;
		}
		return FALSE;
	};

	$names = [ $class, 'Document' ];
	$themes    = defined( 'THEME' ) ? [ THEME ] : [ ];
	$themes[ ] = 'default';
	$folders   = [ '.', __DIR__ ];
	foreach ( $names as $name ) {
		foreach ( $themes as $theme ) {
			foreach ( $folders as $folder ) {
				if ( $path = $template_path_by_folder( $folder, $theme, $name ) ) {
					return $path;
				}
			}
		}
	}
	throw new \Exception ( 'No template found with the name of "' . $name . '".' );
}

?>
<?php

namespace Mug\Printable_Document;

class Document {



	/* ATTRIBUTES */
	protected $title;
	protected $author;
	protected $content;
	protected $subdocuments = [ ];



	/* PUBLIC */
	public static function instance( $path ) {
		$datas = self::get_datas( $path );
		$class_name = 'Document';
		if ( isset( $datas[ 'type' ] ) ) {
			$class_name = $datas[ 'type' ];
		}
		$class_name = __NAMESPACE__ . '\\' . $class_name;
		return new $class_name( $path, $datas );
	}
	public function __construct( $path, $datas = NULL ) {
		$this->init_content( $path );
		$this->init_datas( $path, $datas );
		$this->init_subdocuments( $path );
	}
	public function to_html( ) {
		ob_start();	
		require( $this->get_template_path( ) );
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
	public function to_print( $theme = 'default' ) {
		define( 'THEME', $theme );
		require( template_path( 'index' ) );
		die;
	}



	/* PROTECTED INITIALIZER */
	protected function init_content( $path ) {
		$this->content = $this->get_content( $path );
	}
	protected function init_subcontent( $path, $type ) {
		$attribute = 'content_' . $type;
		$this->$attribute = $this->get_content( $path . '-' . $type );
	}
	protected function init_subdocuments( $path ) {
		print_r( glob( $path . '/*.php' ) );
		foreach( glob( $path . '/*.php' ) as $subpath ) {
			$subpath = substr( $subpath, 0, strrpos( $subpath, '.' ) );
			$this->subdocuments[ ] = self::instance( $subpath );
		}
	}
	protected function init_datas( $path, $datas = NULL ) {
		$attributes = array_keys( get_object_vars( $this ) );
		if ( is_null( $datas ) ) {
			$datas = self::get_datas( $path );
		}
		if ( ! is_array( $datas ) ) {
			$datas = [ ];
		}
		foreach ( $datas as $key => $data ) {
			if ( in_array( $key, $attributes ) ) {
				$this->$key = $data;
			}
		}
	}


	/* PROTECTED GETTER */
	private function get_subdocuments_to_html( ) {
		$html = '';
		foreach ( $this->subdocuments as $document ) {
			$html .= $document->to_html( );
		}
		return $html;
	}
	protected function get_template_path( ) {
		return template_path( $this->get_class_name( ) );
	}
	protected function get_class_name( ) {
		return substr( get_class( $this ), strlen ( __NAMESPACE__ ) + 1 );
	}



	/* UTILS */
	protected function get_content( $path ) {
		$content_file = $path . '.md';
		if ( is_file( $content_file ) ) {
			return Markdown( file_get_contents( $content_file ) );
		}
		return '';
	}
	public static function get_datas( $path ) {
		$datas_file = $path . '.json';
		$banned = [ 'content', 'subdocuments' ];
		$datas = json_decode( file_get_contents( $datas_file ), TRUE );
		if ( ! is_array( $datas ) ) {
			$datas = [ ];
		}
		foreach ( array_keys( $datas ) as $key ) {
			if ( in_array( $key, $banned ) ) {
				unset( $datas[ $key ] );
			}
		}
		return $datas;
	}


}

?>
<?php

namespace Pixel418\Soliloq;

class Document {



	/* ATTRIBUTES */
	protected $id;
	protected $path;
	protected $doctype;
	protected $title;
	protected $author;
	protected $content;
	protected $subcontents = [ ];
	protected $subdocuments = [ ];



	/* PUBLIC */
	public static function instance( $path, &$parent = NULL ) {
		$datas = self::get_datas( $path );
		$metas = self::get_metas( array_shift( $datas ) ); 
		$class_name = 'Document';
		if ( isset( $metas[ 'doctype' ] ) ) {
			$class_name = $metas[ 'doctype' ];
		}
		$class_name = __NAMESPACE__ . '\\' . $class_name;
		return new $class_name( $path, $metas, array_shift( $datas ), $datas, $parent );
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
	protected function __construct( $path, $metas, $content, $subcontents, &$parent = NULL ) {
		$this->path = $path;
		$this->init_id( $parent );
		$this->init_content( $content );
		$this->init_subcontent( $subcontents );
		$this->init_metas( $metas );
		$this->init_subdocuments( );
	}
	protected function init_id( &$parent ) {
		if ( is_null( $parent ) ) {
			$id = 'top';
		} else {
			$relative_path = substr( $this->path, strlen( $parent->path ) );
			$id = str_replace( ' ', '_', trim( str_replace( [ '/', '.', '_', '-' ], ' ', $relative_path ) ) );
		}
		$this->id = $id;
	}
	protected function init_content( $content ) {
		$this->content = trim( Markdown( $content ) );
	}
	protected function init_subcontent( $subcontents ) {
		foreach ( $this->subcontents as $key => $type ) {
			if ( isset( $subcontents[ $key ] ) ) {
				$attribute = 'content_' . $type;
				$this->$attribute = trim( Markdown( $subcontents[ $key ] ) );
			}
		}
	}
	protected function init_subdocuments( ) {
		foreach( glob( $this->path . '/*.txt' ) as $subpath ) {
			$subpath = substr( $subpath, 0, strrpos( $subpath, '.' ) );
			$this->subdocuments[ ] = self::instance( $subpath, $this );
		}
	}
	protected function init_metas( $metas = NULL ) {
		$attributes = array_keys( get_object_vars( $this ) );
		foreach ( $metas as $key => $meta ) {
			if ( in_array( $key, $attributes ) ) {
				$this->$key = $meta;
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
	public static function get_datas( $path ) {
		$content_file = $path . '.txt';
		$datas = preg_split( '/[\n]+[_]+\n[\n]+/', file_get_contents( $content_file ) );
		return $datas;
	}
	public static function get_metas( $metas_string ) {
		$banned = [ 'path', 'content', 'subcontents', 'subdocuments' ];
		$metas = json_decode( $metas_string, TRUE );
		if ( ! is_array( $metas ) ) {
			$metas = [ ];
		}
		foreach ( array_keys( $metas ) as $key ) {
			if ( in_array( $key, $banned ) ) {
				unset( $metas[ $key ] );
			}
		}
		return $metas;
	}


}

?>
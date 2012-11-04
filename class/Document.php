<?php

namespace Mug\Printable_Document;

class Document {



	/* ATTRIBUTES */
	private $title;
	private $author;
	private $content;
	private $subdocuments = [ ];



	/* PUBLIC */
	public function __construct( $path ) {
		$this->init_content( $path );
		$this->init_datas( $path );
		// TODO: Parse subdocument
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
		$content_file = $path . '.md';
		if ( is_file( $content_file ) ) {
			$this->content = Markdown( file_get_contents( $content_file ) );
		}
	}
	protected function init_datas( $path ) {
		$attributes = array_keys( get_object_vars( $this ) );
		$datas_file = $path . '.json';
		$datas = json_decode( file_get_contents( $datas_file ), TRUE );
		foreach ( $datas as $key => $data ) {
			if ( $data != 'content' && $data != 'subdocuments' && in_array( $key, $attributes ) ) {
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
		return substr( __CLASS__, strlen ( __NAMESPACE__ ) + 1 );
	}


}

?>
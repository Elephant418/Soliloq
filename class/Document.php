<?php

namespace Mug\Printable_Document;

class Document {



	/* ATTRIBUTES */
	private $name;
	private $content;
	private $subdocuments = [ ];



	/* PUBLIC */
	public function __construct( $path ) {
		$this->init_content( $path );
		// TODO: Parse data
		// TODO: Parse subdocument
	}
	public function to_html( ) {
		ob_start();	
		require( $this->get_template_path( ) );
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}



	/* PROTECTED INITIALIZER */
	protected function init_content( $path ) {
		$content_file = $path . '.md';
		if ( is_file( $content_file ) ) {
			$this->content = Markdown( file_get_contents( $content_file ) );
		}
	}



	/* PROTECTED GETTER */
	protected function get_template_path( ) {
		return template_path( $this->get_class_name( ) );
	}
	protected function get_class_name( ) {
		return substr( __CLASS__, strlen ( __NAMESPACE__ ) + 1 );
	}


}

?>
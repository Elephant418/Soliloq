<?php

namespace Pixel418\Soliloq;

class Commercial_Proposal extends Cover_Page {



	/* ATTRIBUTES */
	protected $subdocuments_service = [ ];
	protected $subdocuments_option = [ ];



	/* PUBLIC */
	public function get_prefix( ) {
		if ( ! $this->is_optional ) {
			return '';
		}
		return 'Option ' . $this->option_number . ' : ';
	}



	/* HOOK TO OVERRIDE */
	protected function hook_initializer( $parent ) {
		foreach ( $this->subdocuments as $key => $document ) {			
			if ( $document->doctype == 'Service' ) {
				unset( $this->subdocuments[ $key ] );
				if ( $document->is_optional ) {
					$this->subdocuments_option[ ] = $document;
				} else {
					$this->subdocuments_service[ ] = $document;
				}
			}
		}
	}
	protected function get_subdocuments_to_html( ) {
		$html = '';
		foreach ( array_merge( $this->subdocuments_service, $this->subdocuments_option, $this->subdocuments ) as $document ) {
			$html .= $document->to_html( );
		}
		return $html;
	}
	
}

?>
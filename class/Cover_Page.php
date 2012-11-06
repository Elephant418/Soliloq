<?php

namespace Mug\Printable_Document;

class Cover_Page extends Document {



	/* ATTRIBUTES */
	protected $content_from;
	protected $content_to;



	/* PUBLIC */
	public function __construct( $path, $datas = NULL  ) {
		parent::__construct( $path );
		$this->init_subcontent( $path, 'from' );
		$this->init_subcontent( $path, 'to' );
	}
}

?>
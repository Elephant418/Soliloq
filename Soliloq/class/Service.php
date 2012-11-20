<?php

namespace Pixel418\Soliloq;

class Service extends Document {



	/* ATTRIBUTES */
	static public $count = 1;
	public $option_number;
	public $resume;
	public $quantity;
	public $unit = "jour(s)";
	public $unit_cost;
	public $currency = "€";
	public $is_optional = FALSE;



	/* PUBLIC */
	public function get_prefix( ) {
		if ( ! $this->is_optional ) {
			return '';
		}
		return 'Option ' . $this->option_number . ' : ';
	}



	/* HOOK TO OVERRIDE */
	protected function hook_initializer( $parent ) {
		if ( $this->is_optional ) {
			$this->option_number = self::$count;
			self::$count++;
		}
	}

}

?>
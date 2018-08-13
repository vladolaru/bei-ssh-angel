<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 11:24 AM
 */

class Field {
	protected $name;
	protected $type;
	protected $field;

	public function __construct( $type, $name ) {
		$this->field = "\r\n<br><input type=\"$type\"";
		$this->type  = $type;

		if ( $name === null ) {
			$this->field .= '>';
		} else {
			$this->name  = $name;
			$this->field .= "name=\"$name\">";
		}
	}

	protected function closeField() {
		$this->field .= "\r\n<br>";
	}

	public function showField() {
		$this->closeField();

		return $this->field;
	}

}
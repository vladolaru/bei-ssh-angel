<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 11:24 AM
 */

class Field {
	protected $field;

	public function __construct( $type, $name ,$optionalArgs ) {
		$this->field = "\r\n<br><input type=\"$type\"";

		if ($name !== null) {
			$name = str_replace(' ', '_', $name);
			$this->field .= ' name=' . $name;
		}

		foreach ($optionalArgs as $arg) {
			$this->field .= ' ' . $arg;
		}

		$this->field .= '>';
	}

	protected function closeField() {
		$this->field .= "\r\n<br>";
	}

	public function showField() {
		$this->closeField();

		return $this->field;
	}

}
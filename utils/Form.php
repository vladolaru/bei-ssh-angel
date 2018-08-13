<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 11:09 AM
 */

include "Field.php";

class Form {
	protected $form;
	protected $fields;

	public function __construct( $action, $method ) {
		$this->form = "\r\n<form action= \"$action\" method=\"$method\">";
	}

	protected function closeForm() {
		$this->form .= "\r\n</form>";
	}

	public function addField( $type, $name = null) {
		$newField = new Field( $type, $name );

		$this->fields["$name"] = $newField;
		$this->form .= "\r\n$name" . $newField->showField();
	}

	public function showForm() {
		$this->closeForm();
		echo $this->form;
	}

	public function getForm() {
		$this->closeForm();
		return $this->form;
	}
}
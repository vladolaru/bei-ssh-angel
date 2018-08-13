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

	public function __construct( $action, $method ) {
		$this->form = "\r\n<form action= \"$action\" method=\"$method\">";
	}

	protected function closeForm() {
		$this->form .= "\r\n</form>";
	}

	public function addField( $type, $name = null, $optionalArgs) {
		$newField = new Field( $type, $name, $optionalArgs );

		$this->form .= "\r\n$name" . $newField->showField();
	}

	public function addLink($action, $name) {
		$this->form .= "\r\n<a href='$action'>$name</a>";
	}

	public function addText ($text) {
		$this->form .= "\r\n<p>$text</p>";

	}

	public function addNewLine () {
		$this->form .= "<br>";
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
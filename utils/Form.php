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

	public function addTextarea ($title, $name, $rows, $cols) {
		$this->form .= "\r\n$title:<textarea name=$name rows=$rows rows=$cols></textarea>";
	}

	public function addSelect($name, $emails){
		$options = '';
		foreach ($emails as $email){
			$options .= "\r\n<option value=\"$email\">$email</option>";
		}
		$this->form .= "<div class=\"select is-multiple\">
  <select name='$name" . "[]'" ." multiple size=\"3\">" . $options . "</select>
</div>";
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
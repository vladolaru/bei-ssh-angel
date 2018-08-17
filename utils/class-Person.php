<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/16/2018
 * Time: 11:46 AM
 */

class Person {
	public $firstName;
	public $lastName;
	public $email;
	public $preferences;
	public $notes;

	public function __construct($firstName, $lastName, $email, $preferences, $notes) {
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->preferences = $preferences;
		$this->notes = $notes;
	}

	public function showPerson(){
		echo
			"<div class='person'>
				<div class='credentials'>" .
					$this->firstName . ' ' . $this->lastName . "&nbsp;&nbsp;&nbsp;&nbsp;" . "$this->email" .
				"</div>" .
				"<div>
					<a href='" . BASE_URL . "/?action=delete-person&email=" . "$this->email" . "' class=\"button person-button is-pulled-right\">
					    <span class=\"icon\">
					        <i class=\"fab fa-twitter\"></i>
					    </span>

	                </a>
					<a href='" . BASE_URL . "/?action=edit-person&email=" . "$this->email" . "' class=\"button person-button is-pulled-right\">
		                <span class=\"icon\">
		                    <i class=\"fab fa-github\"></i>
		                </span>
	                </a>
  				</div>
  			</div>";
	}
}
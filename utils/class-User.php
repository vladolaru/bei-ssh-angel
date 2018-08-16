<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 4:32 PM
 */

class User {
	protected $firstName;
	protected $lastName;
	protected $email;
	protected $password;

	/**
	 * User constructor.
	 *
	 * @param $firstName
	 * @param $lastName
	 * @param $email
	 * @param $password
	 */
	public function __construct( $firstName, $lastName, $email, $password ) {
		$this->setFirstName( $firstName );
		$this->setLastName( $lastName );
		$this->setEmail( $email );
		$this->setPassword( $password );
	}

	/**
	 * @return mixed
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * @param mixed $firstName
	 */
	private function setFirstName( $firstName ) {
		$this->firstName = $firstName;
	}

	/**
	 * @return mixed
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * @param mixed $lastName
	 */
	private function setLastName( $lastName ) {
		$this->lastName = $lastName;
	}

	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	private function setEmail( $email ) {
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param mixed $password
	 */
	private function setPassword( $password ) {
		$this->password = $password;
	}


}
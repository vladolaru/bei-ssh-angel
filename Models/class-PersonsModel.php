<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/16/2018
 * Time: 11:43 AM
 */
require_once SSH_ABSPATH . "/utils/class-Person.php";
require_once SSH_ABSPATH . "/utils/class-Database.php";

class PersonsModel {
	/**
	 * @var Person[]
	 */
	private $myPersons;

	public function __construct( $userEmail ) {
		$records = Database::getDB()->select( 'persons', [
			'first_name',
			'last_name',
			'email',
			'preferences',
			'notes'
		], [
			'user_email[=]' => $userEmail
		] );

		foreach ( $records as $record ) {
			$this->myPersons[ $record['email'] ] = new Person( $record['first_name'], $record['last_name'], $record['email'],
				$record['preferences'], $record['notes'] );
		}
	}

	/**
	 * @return Person[]
	 */
	public function getMyPersons() {
		return $this->myPersons;
	}

	/**
	 * @param $userEmail
	 * @param $personEmail
	 *
	 * @return bool|Person
	 */
	public static function getMyPersonByEmail( $userEmail, $personEmail ) {
		$record = Database::getDB()->select( 'persons', [
			'first_name',
			'last_name',
			'email',
			'preferences',
			'notes'
		], [
			'user_email[=]' => $userEmail,
			'email[=]'      => $personEmail
		] );

		if ( 1 !== count( $record ) ) {
			return false;
		}

		return new Person( $record[0]['first_name'], $record[0]['last_name'], $record[0]['email'],
			$record[0]['preferences'], $record[0]['notes'] );
	}

	public static function updatePersonForUser( $userEmail, $oldPersonEmail, $newData ) {
		Database::getDB()->update( 'persons', [
			'first_name'  => $newData['first_name'],
			'last_name'   => $newData['last_name'],
			'email'       => $newData['email'],
			'preferences' => $newData['preferences'],
			'notes'       => $newData['notes']
		], [
			'user_email[=]' => $userEmail,
			'email[=]'      => $oldPersonEmail
		] );
	}

	public static function addPersonForUser( $userEmail, $newData ) {
		Database::getDB()->insert( 'persons', [
			'user_email'  => $userEmail,
			'first_name'  => $newData['first_name'],
			'last_name'   => $newData['last_name'],
			'email'       => $newData['email'],
			'preferences' => $newData['preferences'],
			'notes'       => $newData['notes']
		] );
	}

	public static function deletePersonForUser ($userEmail, $personEmail) {
		Database::getDB()->delete('persons',[
			'AND' => [
				'user_email' => $userEmail,
				'email' => $personEmail
			]
		]);
	}

	public function getEmails() {
		$emails = array();
		foreach ($this->getMyPersons() as $person){
			$emails[] = $person->email;
		}

		return $emails;
	}

	public static function emailExists( $email ) {
		if ( empty( Database::getDB()->select( "persons", [
			"email"
		], [
			"email[=]" => $email
		] ) )
		) {
			return false;
		}

		return true;
	}
}
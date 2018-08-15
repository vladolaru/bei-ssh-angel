<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/15/2018
 * Time: 11:50 AM
 */
require_once SSH_ABSPATH . "/utils/class-Database.php";


class EmailTokenModel {
	public static function addRecordToDatabase( $email, $token ) {
		if (self::emailExists($email)){
			return false;
		}

		Database::getDB()->insert( 'email-token', [
			"email" => $email,
			"token"   => $token
		] );

		return true;
	}

	public static function emailExists($email) {
		if ( empty( Database::getDB()->select( "email-token", [
			"email"
		], [
			"email[=]" => $email
		] ) )
		) {
			return false;
		}

		return true;
	}

	public static function tokenExists( $token ) {
		if ( empty( Database::getDB()->select( "email-token", [
			"token"
		], [
			"token[=]" => $token
		] ) )
		) {
			return false;
		}

		return true;
	}

	public static function getEmailFromToken( $token ) {

		$record = Database::getDB()->select( 'email-token', [
			"email"
		], [
			"token[=]" => $token
		] );

		if ( empty( $record ) ) {
			return false;
		} else {
			return $record[0]['email'];
		}
	}

	public static function deleteTokenFromEmail( $email ) {
		Database::getDB()->delete( 'email-token', [ 'email[=]' => $email ] );
	}
}
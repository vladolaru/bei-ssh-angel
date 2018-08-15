<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/15/2018
 * Time: 11:47 AM
 */

require_once SSH_ABSPATH . "/utils/class-Database.php";

class UserModel {
	public static function userExists( $email, $password ) {

		if ( empty( Database::getDB()->select( "users", [
			"email"
		], [
			"email[=]"    => $email,
			"password[=]" => $password
		] ) )
		) {
			return false;
		}

		return true;
	}

	public static function emailExists( $email ) {

		if ( empty( Database::getDB()->select( "users", [
			"email"
		], [
			"email[=]" => $email
		] ) )
		) {
			return false;
		}

		return true;
	}

	public static function changeUserPass( $email, $newPass ) {
		require_once SSH_ABSPATH . "/Models/class-EmailTokenModel.php";
		Database::getDB()->update( 'users', [ 'password' => $newPass ], [ 'email[=]' => $email ] );
		EmailTokenModel::deleteTokenFromEmail( $email );
	}

	public static function addRecordToDatabase( $firstName, $lastName, $email, $password ) {
		Database::getDB()->insert( 'users', [
			"first name" => $firstName,
			"last name"  => $lastName,
			"email"      => $email,
			"password"   => $password
		] );
	}
}
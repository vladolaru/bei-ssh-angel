<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/13/2018
 * Time: 12:25 PM
 */

require_once SSH_ABSPATH . '/vendor/autoload.php';

use Medoo\Medoo;

function getDB() {
	if ( ! empty( $GLOBALS['DB'] ) ) {
		return $GLOBALS['DB'];
	}


	$database = new Medoo( [
		'database_type' => 'mysql',
		'database_name' => 'ssh_main',
		'server'        => 'localhost',
		'username'      => 'root',
		'password'      => 'root'
	] );

	$GLOBALS['DB'] = $database;

	return $database;
}

function userExists( $email, $password ) {

	$database = getDB();

	if ( empty( $database->select( "users", [
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

function emailExists( $email ) {
	$database = getDB();

	if ( empty( $database->select( "users", [
		"email"
	], [
		"email[=]" => $email
	] ) )
	) {
		return false;
	}

	return true;
}

function tokenExists ($token) {
	$database = getDB();

	if ( empty( $database->select( "email-token", [
		"token"
	], [
		"token[=]" => $token
	] ) )
	) {
		return false;
	}

	return true;
}

function getEmailFromToken($token) {
	$db = getDB();

	$record = $db->select('email-token',[
		"email"
	], [
		"token[=]" => $token
	]);

	if (empty($record)){
		return false;
	} else {
		return $record[0]['email'];
	}
}

function changeUserPass( $email, $newPass ) {
	$db = getDB();

	$db->update( 'users', [ 'password' => $newPass ], [ 'email[=]' => $email ] );
	$db->delete( 'email-token', [ 'email[=]' => $email ] );
}

function addUserToDatabase ($firstName, $lastName, $email, $password) {
	$db = getDB();

	$db->insert('users', [
		"first name" => $firstName,
		"last name" => $lastName,
		"email" => $email,
		"password" => $password
	] );
}
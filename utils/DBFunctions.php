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

function emailExists ( $email ) {
	$database = getDB();

	if ( empty( $database->select( "users", [
		"email"
	], [
		"email[=]"    => $email,
	] ) )
	) {
		return false;
	}

	return true;
}

function checkEmailToken ($email, $token) {
	$database = getDB();

	$user = $database->select('users',[
		"email",
		"token"
	], [
		"email[=]"    => $email,
	] );

	if ($user[0]['email'] === $email && $user[0]['token'] === $token){

		return true;
	}
	return false;
}

function changeUserPass ($email, $newPass) {
	$db = getDB();

	$db->update('users', ['password' => $newPass], ['email[=]' => $email]);
	$db->update('users', ['token' => null], ['email[=]' => $email]);
}
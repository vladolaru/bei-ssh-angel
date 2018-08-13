<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 12:37 PM
 */

require_once "DBFunctions.php";
require_once "utilFunctions.php";

function RedirectToView( $view ) {
	header( "Location: $view" );
}

function CheckUserCredentials( $email, $password ) {
	if ( ! userExists( $email, $password ) ) {
		return false;
	}

	setcookie( 'email', $email );
	setcookie( 'password', password_hash( $password, PASSWORD_DEFAULT ) );

	return true;
}

function sendPasswordResetEmail( $email ) {
	if ( ! emailExists( $email ) ) {
		return false;
	}

	$randomString = generateRandomString();

	if (
	mail( $email, 'Reset Email', 'Your reset email is: 
	' . BASE_URL . '/?action=pass-reset-link&email=' . $email . '&token=' . $randomString, 'From: SSH_angel' )
	) {
		$db = getDB();

		$db->update( 'users', [ 'token' => $randomString ], [ 'email[=]' => $email ] );

		return true;
	}

	return false;

}

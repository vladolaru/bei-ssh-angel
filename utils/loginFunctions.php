<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 12:37 PM
 */

require_once "DBFunctions.php";


function addUserCookie( $email, $password ) {
	setcookie( 'email', $email, time() + 60 * 60 * 24 * 7 );
	setcookie( 'password', password_hash( $password, PASSWORD_DEFAULT ), time() + 60 * 60 * 24 * 7 );
}

function CheckUserCredentials( $email, $password ) {
	if ( ! userExists( $email, $password ) ) {
		return false;
	}

	addUserCookie( $email, $password );

	return true;
}

function sendPasswordResetEmail( $email ) {
	require_once "utilFunctions.php";
	if ( ! emailExists( $email ) ) {
		return false;
	}

	$randomString = generateRandomString();
	while (tokenExists($randomString)) {
		$randomString = generateRandomString();
	}

	if (
	mail( $email, 'Reset Email', 'Your reset email is: 
	' . BASE_URL . '/?action=pass-reset-link&token=' . $randomString, 'From: SSH_angel' )
	) {
		$db = getDB();

		$db->insert( 'email-token', [
				'email' => $email,
				'token' => $randomString
			]
		);

		return true;
	}

	return false;

}

<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 12:37 PM
 */

require_once "DBFunctions.php";

function RedirectToView( $view ) {
	header( "Location: $view" );
}

function CheckUserCredentials( $email, $password ) {
	if (!userExists($email,$password)) {
		return false;
	}

	setcookie( 'email', $email );
	setcookie( 'password', password_hash( $password, PASSWORD_DEFAULT ) );

	return true;
}

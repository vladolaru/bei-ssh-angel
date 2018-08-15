<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 12:37 PM
 */

function addUserCookie( $email, $password ) {
	require_once SSH_ABSPATH . "/Models/class-UserModel.php";
	setcookie( 'email', $email, time() + 60 * 60 * 24 * 7 );
	setcookie( 'password', password_hash( $password, PASSWORD_DEFAULT ), time() + 60 * 60 * 24 * 7 );
	setcookie( 'first_name', UserModel::getFirstNameFromEmail($email) , time() + 60 * 60 * 24 * 7 );
	setcookie( 'last_name', UserModel::getLastNameFromEmail($email), time() + 60 * 60 * 24 * 7 );
}

function removerUserCookie(){
	unset($_COOKIE['email']);
	setcookie('email', null,-1);
	unset($_COOKIE['password']);
	setcookie('password', null, -1);
	unset($_COOKIE['first_name']);
	setcookie('first_name', null, -1);
	unset($_COOKIE['last_name']);
	setcookie('last_name', null, -1);
}

function CheckUserCredentials( $email, $password ) {
	require_once SSH_ABSPATH . "/Models/class-UserModel.php";

	if ( ! UserModel::userExists($email, $password)  ) {
		return false;
	}

	addUserCookie( $email, $password );

	return true;
}

function sendPasswordResetEmail( $email ) {
	require_once SSH_ABSPATH . "/Models/class-UserModel.php";
	require_once SSH_ABSPATH . "/Models/class-EmailTokenModel.php";
	require_once SSH_ABSPATH . "/utils/utilFunctions.php";
	if ( ! UserModel::emailExists( $email ) ) {
		return false;
	}

	$randomString = generateRandomString();
	while (EmailTokenModel::tokenExists( ($randomString))) {
		$randomString = generateRandomString();
	}

	if (EmailTokenModel::addRecordToDatabase( $email, $randomString ) ) {
		mail( $email, 'Reset Email', 'Your reset email is: 
	' . BASE_URL . '/?action=pass-reset-link&token=' . $randomString, 'From: SSH_angel' );

		return true;
	}

	return false;

}

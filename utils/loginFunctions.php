<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 12:37 PM
 */

function addUserCookie( $email, $password ) {
	setcookie( 'email', $email, time() + 60 * 60 * 24 * 7 );
	setcookie( 'password', password_hash( $password, PASSWORD_DEFAULT ), time() + 60 * 60 * 24 * 7 );
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

<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/15/2018
 * Time: 2:51 PM
 */

function checkName( &$message, $name ){
	if ( ! ctype_alpha( $name ) ) {
		if ( ! empty( $message ) ) {
			$message .= "\r\n";
		}
		$message .= 'Names must consist only of letters';
	}

	if ( strlen( $name ) > 20 || strlen( $name ) < 1 ) {
		if ( ! empty( $message ) ) {
			$message .= "\r\n";
		}
		$message .= 'Names must consist of 1 to 20 characters';
	}
}

function checkPass( &$message, $pass) {
	if ( strlen( $pass ) < 4 || strlen( $pass ) > 20 ) {
		if ( ! empty( $message ) ) {
			$message .= "\r\n";
		}
		$message .= 'Password must consist of 4 to 20 characters';
	}
}

function checkEmail (&$message, $email) {
	require_once SSH_ABSPATH . "/Models/class-UserModel.php";
	if ( strlen( $email ) > 30 || strlen( $email ) < 3 ) {
		if ( ! empty( $message ) ) {
			$message .= "\r\n";
		}
		$message .= 'Email must consist of 3 to 20 characters';
	}

	if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
		if ( ! empty( $message ) ) {
			$message .= "\r\n";
		}
		$message .= 'Invalid email';
	}

	if (UserModel::emailExists($email)){
		if ( ! empty( $message ) ) {
			$message .= "\r\n";
		}
		$message .= 'Unavailable email';
	}
}
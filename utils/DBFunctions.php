<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/13/2018
 * Time: 12:25 PM
 */

require_once 'vendor/autoload.php';
use Medoo\Medoo;



function userExists ($email , $password) {
	if (empty( $database-> select("users", [
		"email"
	], [
		"email[=]" => $email,
		"password[=]" => $password
	]))
	) {
		return false;
	}

	return true;
}
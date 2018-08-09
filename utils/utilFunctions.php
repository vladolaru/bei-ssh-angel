<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 4:23 PM
 */

include "../Models/class-User.php";

function check_session() {
	session_start();
	/*if ( empty($_SESSION['currentUser']) ) {
		return false;
	}*/
	$currentUser = new User('anggabard','ceapa123', 'angel@me.com');

	//get data from cookie

	$_SESSION['currentUser'] = $currentUser;
	return true;
}
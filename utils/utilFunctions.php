<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 4:23 PM
 */

session_start();
include "Models/class-User.php";

function check_session() {
	//get data from cookie
	if ( isset($_SESSION['currentUser']) ) {
		return true;
	} else {
		$currentUser = new User('anggabard','ceapa123', 'angel@me.com');
		$_SESSION['currentUser'] = $currentUser;
		return true;//will be false after making cookie
	}
}
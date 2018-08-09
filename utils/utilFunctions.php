<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 4:23 PM
 */

require_once "../Models/class-User.php";

function get_current_user() {
	$currentUser = new User;

	//get data from cookie

	$currentUser->setUsername('anggabard');
	$currentUser->setPassword('ceapa123');
	$currentUser->setEmail('angel@me.com');
}
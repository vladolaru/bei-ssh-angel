<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 4:23 PM
 */

include "../Models/class-User.php";

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

function get_header_ssh() {
	echo '<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title is-bold">
        SSH
      </h1>
      <h2 class="subtitle">
        Santa\'s secret helptser
      </h2>
    </div>
  </div>
</section>';
}
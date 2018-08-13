<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 4:23 PM
 */

require_once SSH_ABSPATH . "/Models/class-User.php";

function check_session() {
	//get data from cookie
	if ( isset( $_SESSION['currentUser'] ) ) {
		return true;
	} else {
		$currentUser             = new User( 'anggabard', 'ceapa123', 'angel@me.com' );
		$_SESSION['currentUser'] = $currentUser;

		return true;//will be false after making cookie
	}
}

function get_header_ssh( $title ) {
	echo '<head>
<meta charset="UTF-8">
<title>' . $title . '</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
</head>
<section class="hero has-background-danger">
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

function generateRandomString( $length = 10 ) {
	$characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen( $characters );
	$randomString     = '';
	for ( $i = 0; $i < $length; $i ++ ) {
		$randomString .= $characters[ rand( 0, $charactersLength - 1 ) ];
	}

	return $randomString;
}
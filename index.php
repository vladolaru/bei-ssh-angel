<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/8/2018
 * Time: 4:14 PM
 */

defined('SSH_ABSPATH' ) || define( 'SSH_ABSPATH', dirname( __FILE__ ) );

if ( isset($_GET['query'])) {
	if ( 0 === strpos( $_GET['query'], 'login/' ) ) {
		echo 'Suntem pe login.';
	}

	$fragments = explode('/', $_GET['query']  );
	if ( in_array( 'reset', $fragments ) ) {
		echo 'Ar fi cazul sa resetam.';
	}

}

print_r($_GET);
die;

//include_once "utils/utilFunctions.php";
//
//session_start();
//if ( !check_session() ) {
//	header( 'Location: Views/loginView.php' );
//} else {
//	header( 'Location: Views/homeView.php' );
//}

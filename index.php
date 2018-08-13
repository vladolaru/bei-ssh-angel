<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/8/2018
 * Time: 4:14 PM
 */

defined( 'SSH_ABSPATH' ) || define( 'SSH_ABSPATH', dirname( __FILE__ ) );

define('BASE_URL', 'http://ceapa.local/bei-ssh-angel');



/*if ( isset( $_GET['query'] ) ) {
	if ( 0 === strpos( $_GET['query'], 'action' ) ) {
		echo 'Suntem pe login.';
	}

	$fragments = explode( '/', $_GET['query'] );
	if ( in_array( 'reset', $fragments ) ) {
		echo 'Ar fi cazul sa resetam.';
	}

}*/

if ( ! isset( $_GET['action'] ) ) {
	$_GET['action'] = 'login';
}

switch ( $_GET['action'] ) {
	case 'login':
		require_once SSH_ABSPATH . "/Views/loginView.php";
		break;
	case 'log-user-in':
		require_once SSH_ABSPATH . "/utils/loginFunctions.php";
		if ( checkUserCredentials ($_POST['email'], $_POST['password'] ) ) {
			header('Location: ' . BASE_URL . '/?action=home' );
			exit();
		} else {
			$error_message = 'Login details were invalid!';
			require_once SSH_ABSPATH . "/Views/loginView.php";
		}
		break;
    case 'home':
            require_once SSH_ABSPATH . "/Views/homeView.php";
            break;
}
print_r( $_GET );
print_r( $_POST );

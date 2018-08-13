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

if ( isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
	$_GET['action'] = 'home';
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
			$message = 'Login details were invalid!';
			require_once SSH_ABSPATH . "/Views/loginView.php";
		}
		break;
    case 'home':
            require_once SSH_ABSPATH . "/Views/homeView.php";
            break;
	case 'ForgotPass':
			require_once SSH_ABSPATH . "/Views/ForgotPassView.php";
			break;
	case 'send-reset-email':
			require_once SSH_ABSPATH . "/utils/loginFunctions.php";
			if (sendPasswordResetEmail($_POST['Your_email_address'])){
				$success_message = 'Check your mail!';
				require_once SSH_ABSPATH . "/Views/ForgotPassView.php";
			} else {
				$error_message = 'Email was not sent!';
				require_once SSH_ABSPATH . "/Views/ForgotPassView.php";
			}
			break;
	case 'pass-reset-link':
		require_once "utils/DBFunctions.php";
		if( !checkEmailToken ($_GET['email'] , $_GET['token']) ){
			echo 'GTFO';
			exit();
		}
		require_once SSH_ABSPATH . '/Views/resetPasswordView.php';

		break;
	case 'reset-pass':
		require_once "utils/DBFunctions.php";
		if($_POST['New_password'] === $_POST['Confirm_new_password']) {
			changeUserPass( $_POST['email'], $_POST['New_password'] );

			$message = 'Password was changed!';
			header('Location: ' . BASE_URL . '/?action=login' );
			exit();
		} else {
			$message = 'Passwords do not match!';
			require_once SSH_ABSPATH . "/Views/resetPasswordView.php";
		}

		break;

}
print_r( $_GET );
print_r( $_POST );

<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/8/2018
 * Time: 4:14 PM
 */

defined( 'SSH_ABSPATH' ) || define( 'SSH_ABSPATH', dirname( __FILE__ ) );

define( 'BASE_URL', 'http://ceapa.local/bei-ssh-angel' );


/*if ( isset( $_GET['query'] ) ) {
	if ( 0 === strpos( $_GET['query'], 'action' ) ) {
		echo 'Suntem pe login.';
	}

	$fragments = explode( '/', $_GET['query'] );
	if ( in_array( 'reset', $fragments ) ) {
		echo 'Ar fi cazul sa resetam.';
	}

}*/



if ( isset( $_COOKIE['email'] ) && isset( $_COOKIE['password'] ) ) {
	$_GET['action'] = 'home';
} else {
	if ( ! isset( $_GET['action'] ) ) {//home is accesible
		$_GET['action'] = 'login';
	}
}

switch ( $_GET['action'] ) {
	case 'login':
		require_once SSH_ABSPATH . "/Views/loginView.php";
		break;
	case 'log-user-in':
		require_once SSH_ABSPATH . "/utils/loginFunctions.php";
		if ( checkUserCredentials( $_POST['email'], $_POST['password'] ) ) {
			header( 'Location: ' . BASE_URL . '/?action=home' );
			exit();
		} else {
			$message = 'Login details were invalid!';
			require_once SSH_ABSPATH . "/Views/loginView.php";
		}
		break;
	case 'home':
		if ( isset( $_COOKIE['email'] ) && isset( $_COOKIE['password'] ) ) {
			require_once SSH_ABSPATH . "/Views/homeView.php";
			break;
		}
		header( 'Location: ' . BASE_URL . '/?action=login' );
		exit();

	case 'forgotPass':
		require_once SSH_ABSPATH . "/Views/ForgotPassView.php";
		break;
	case 'send-reset-email':
		require_once SSH_ABSPATH . "/utils/loginFunctions.php";
		if ( sendPasswordResetEmail( $_POST['Your_email_address'] ) ) {
			$message = 'Check your mail!';
			require_once SSH_ABSPATH . "/Views/ForgotPassView.php";
		} else {
			$message = 'Email was not sent!';
			require_once SSH_ABSPATH . "/Views/ForgotPassView.php";
		}
		break;
	case 'pass-reset-link':
		require_once "utils/DBFunctions.php";
		if ( ! checkEmailToken( $_GET['email'], $_GET['token'] ) ) {
			echo 'GTFO';
			exit();
		}
		require_once SSH_ABSPATH . '/Views/resetPasswordView.php';

		break;
	case 'reset-pass':
		require_once "utils/DBFunctions.php";
		if ( $_POST['New_password'] === $_POST['Confirm_new_password'] ) {
			changeUserPass( $_POST['email'], $_POST['New_password'] );

			$message = 'Password was changed!';
			header( 'Location: ' . BASE_URL . '/?action=login' );
			exit();
		} else {
			$message = 'Passwords do not match!';
			require_once SSH_ABSPATH . "/Views/resetPasswordView.php";
		}

		break;
	case 'register':
		require_once SSH_ABSPATH . "/Views/RegisterView.php";
		break;
	case 'register-user':
		if(!ctype_alpha($_POST['First_Name']) || !ctype_alpha($_POST['Last_Name'])){
			$message = 'Names must consist only of letters';
		}
		if (strlen($_POST['First_Name']) > 20 || strlen($_POST['First_Name']) < 1 || strlen($_POST['Last_Name']) > 20 || strlen($_POST['Last_Name']) < 1){
			if(!empty($message)){
				$message .= "\r\n";
			}
			$message = 'Names must consist of 1 to 20 characters';
		}
		if(strlen($_POST['Your_password']) < 4 || strlen($_POST['Your_password']) > 20) {
			if(!empty($message)){
				$message .= "\r\n";
			}
			$message = 'Password must consist of 4 to 20 characters';
		}
		if (!empty($message)){
			require_once SSH_ABSPATH . "/Views/RegisterView.php";
			break;
		}
		require_once "utils/DBFunctions.php";
		addUserToDatabase($_POST['First_Name'], $_POST['Last_Name'], $_POST['Your_email_address'], $_POST['Your_password']);
		require_once SSH_ABSPATH . "/utils/loginFunctions.php";
		addUserCookie($_POST['Your_email_address'], $_POST['Your_password']);
		header( 'Location: ' . BASE_URL . '/?action=home' );
		exit();
		break;
}
print_r( $_GET );
print_r( $_POST );

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
	if ( ! isset( $_GET['action'] ) ) {
		$_GET['action'] = 'home';
	}
	switch ( $_GET['action'] ) {
		case 'log-out':
			require_once SSH_ABSPATH . "/utils/loginFunctions.php";
			removerUserCookie();
			header( 'Location: ' . BASE_URL . '/?action=login' );
			exit();
		default:
			if ( isset( $_COOKIE['email'] ) && isset( $_COOKIE['password'] ) ) {
				require_once SSH_ABSPATH . "/Views/homeView.php";
				break;
			}
			header( 'Location: ' . BASE_URL . '/?action=login' );
			exit();//home
	}
} else {

	if ( ! isset( $_GET['action'] ) ) {
		$_GET['action'] = 'login';
	}

	switch ( $_GET['action'] ) {
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
		case 'forgot-pass':
			require_once SSH_ABSPATH . "/Views/ForgotPassView.php";
			break;
		case 'send-reset-email':
			require_once SSH_ABSPATH . "/utils/loginFunctions.php";
			if ( sendPasswordResetEmail( $_POST['Your_email_address'] ) ) {
				$message = 'Check your mail!';
				require_once SSH_ABSPATH . "/Views/ForgotPassView.php";
			} else {
				$message = 'This email already has a reset link!';
				require_once SSH_ABSPATH . "/Views/ForgotPassView.php";
			}
			break;
		case 'pass-reset-link':
			require_once SSH_ABSPATH . "/Models/class-EmailTokenModel.php";

			if ( EmailTokenModel::getEmailFromToken( $_GET['token'] ) === false ) {
				echo 'GTFO';
				exit();
			}
			require_once SSH_ABSPATH . '/Views/resetPasswordView.php';

			break;
		case 'reset-pass':
			require_once SSH_ABSPATH . "/Models/class-UserModel.php";
			require_once SSH_ABSPATH . "/Models/class-EmailTokenModel.php";
			require_once SSH_ABSPATH . "/utils/registerFunctions.php";
			$message = '';
			if ( ! ( $_POST['New_password'] === $_POST['Confirm_new_password'] ) ) {
				$message = 'Passwords do not match!';
				require_once SSH_ABSPATH . "/Views/resetPasswordView.php";
				break;
			}
			checkPass( $message, $_POST['New_password'] );
			if ( empty( $message ) ) {
				checkPass( $message, $_POST['Confirm_new_password'] );
			}
			if ( empty( $message ) ) {
				UserModel::changeUserPass( EmailTokenModel::getEmailFromToken( $_GET['token'] ), $_POST['New_password'] );
				header( 'Location: ' . BASE_URL . '/?action=login' );
				exit();
			} else {
				require_once SSH_ABSPATH . "/Views/resetPasswordView.php";
			}
			break;
		case 'register':
			require_once SSH_ABSPATH . "/Views/RegisterView.php";
			break;
		case 'register-user':
			require_once SSH_ABSPATH . "/Models/class-UserModel.php";
			require_once SSH_ABSPATH . "/utils/registerFunctions.php";
			$message = '';
			checkName( $message, $_POST['First_Name'] );
			checkName( $message, $_POST['Last_Name'] );
			checkPass( $message, $_POST['Your_password'] );
			checkEmail( $message, $_POST['Your_email_address'] );

			if ( ! empty( $message ) ) {
				require_once SSH_ABSPATH . "/Views/RegisterView.php";
				break;
			}
			UserModel::addRecordToDatabase( $_POST['First_Name'], $_POST['Last_Name'], $_POST['Your_email_address'], $_POST['Your_password'] );
			require_once SSH_ABSPATH . "/utils/loginFunctions.php";
			addUserCookie( $_POST['Your_email_address'], $_POST['Your_password'] );
			header( 'Location: ' . BASE_URL . '/?action=home' );
			exit();
		default:
			require_once SSH_ABSPATH . "/Views/loginView.php";
			break;//login
	}
}
print_r( $_GET );
print_r( $_POST );

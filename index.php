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
		case 'add-person':
			require_once SSH_ABSPATH . "/Views/add-editPersonView.php";
			break;
		case 'edit-person':
			if ( ! isset( $_GET['email'] ) ) {
				header( 'Location: ' . BASE_URL . '/?action=home' );
				exit();
			}
			require_once SSH_ABSPATH . "/utils/class-Person.php";
			require_once SSH_ABSPATH . "/Models/class-PersonsModel.php";

			$thePersonToEdit = PersonsModel::getMyPersonByEmail($_COOKIE['email'], $_GET['email']);

			if ( false === $thePersonToEdit) {
				header( 'Location: ' . BASE_URL . '/?action=home' );
				exit();
			}
			require_once SSH_ABSPATH . "/Views/add-editPersonView.php";
			break;
		case 'update-person':
			require_once SSH_ABSPATH . "/utils/registerFunctions.php";
			require_once SSH_ABSPATH . "/Models/class-PersonsModel.php";
			$message = '';
			checkName( $message, $_POST['First_Name'] );
			checkName( $message, $_POST['Last_Name'] );
			checkEmail( $message, $_POST['Email_address'] );
			checkText( $message, $_POST['Personal_preferences'] );
			checkText( $message, $_POST['Private_notes'] );

			if ( PersonsModel::emailExists( $_POST['Email_address'] ) && $_POST['Email_address'] !== $_POST['emailOfThePerson'] ) {
				if ( ! empty( $message ) ) {
					$message .= "\r\n";
				}
				$message .= 'Email already in use';
			}

			if ( ! empty( $message ) ) {
				if ( $_GET['type'] === 'edit-person' ) {
					header( 'Location: ' . BASE_URL . '/?action=' . $_GET['type'] . '&email=' . $_POST['emailOfThePerson'] );
				} else if ( $_GET['type'] === 'add-person' ) {
					header( 'Location: ' . BASE_URL . '/?action=' . $_GET['type'] );
				} else {
					echo "GTFO";
				}
				exit();
			}

			if ( $_GET['type'] === 'edit-person' ) {
				PersonsModel::updatePersonForUser( $_COOKIE['email'], $_POST['emailOfThePerson'], [
					'first_name'  => $_POST['First_Name'],
					'last_name'   => $_POST['Last_Name'],
					'email'       => $_POST['Email_address'],
					'preferences' => $_POST['Personal_preferences'],
					'notes'       => $_POST['Private_notes']
				] );
			} else {
				PersonsModel::addPersonForUser( $_COOKIE['email'], [
					'first_name'  => $_POST['First_Name'],
					'last_name'   => $_POST['Last_Name'],
					'email'       => $_POST['Email_address'],
					'preferences' => $_POST['Personal_preferences'],
					'notes'       => $_POST['Private_notes']
				] );
			}
			header( 'Location: ' . BASE_URL . '/?action=home' );
			break;
		case 'delete-person':
			if (!isset($_GET['email'])){
				echo "GTFO";
				die();
			}
			require_once SSH_ABSPATH . "/Models/class-PersonsModel.php";

			PersonsModel::deletePersonForUser($_COOKIE['email'], $_GET['email']);
			header( 'Location: ' . BASE_URL . '/?action=home' );
			break;
		case 'rounds':
			require_once SSH_ABSPATH . "/utils/utilFunctions.php";
			require_once SSH_ABSPATH . "/Models/class-RoundsModel.php";
			$myRounds = new RoundsModel($_COOKIE['email']);
			require_once SSH_ABSPATH . "/Views/RoundsView.php";
			break;
		case 'add-round':
			require_once SSH_ABSPATH . "/Models/class-PersonsModel.php";
			$PersonsModel = new PersonsModel($_COOKIE['email']);
			$myPersonsEmails = $PersonsModel->getEmails();
			require_once SSH_ABSPATH . "/Views/addRoundView.php";
			break;
		case 'create-new-round':
			require_once SSH_ABSPATH . "/utils/class-SecretSantaCore.php";
			$santa = new SecretSantaCoreAngel();
			$message = '';
			$newLine = "\r\n";
			if(!$santa->setEmailFrom($_POST['Email_from'])){
				if (!empty($message)){
					$message .= $newLine;
				}
				$message .= 'From email is invalid';
			}

			if(!$santa->setEmailTitle($_POST['Email_title'])){
				if (!empty($message)){
					$message .= $newLine;
				}
				$message .= 'Title is invalid';
			}

			if(!$santa->setRecommendedExpenses($_POST['Recommended_budget'])){
				if (!empty($message)){
					$message .= $newLine;
				}
				$message .= 'Budget is invalid';
			}

			require_once SSH_ABSPATH . "/Models/class-PersonsModel.php";

			$users = array();
			$userPos = 0;
			foreach ($_POST['emails'] as $email){
				$users[$userPos]['email'] = $email;
				$users[$userPos]['name'] = PersonsModel::getMyPersonByEmail($_COOKIE['email'], $email)->firstName . ' ' . PersonsModel::getMyPersonByEmail($_COOKIE['email'], $email)->lastName;
				$userPos++;
			}
			$addedUsers = $santa->addUsers($users);
			if ($addedUsers < $userPos){
				if (!empty($message)){
					$message .= $newLine;
				}
				$message .= $userPos - $addedUsers . ' weren\'t added';
			}

			if (!empty($message)){
				require_once SSH_ABSPATH . "/Views/addRoundView.php";
				break;
			}

			require_once SSH_ABSPATH . "/Models/class-RoundsModel.php";
			require_once SSH_ABSPATH . "/utils/class-Round.php";

			$round = new Round($userPos,$_POST['Recommended_budget']);
			RoundsModel::insertRound($round, $_COOKIE['email']);

			header("Location:" . BASE_URL . "\?action=home");
			break;
		default:
			require_once SSH_ABSPATH . "/Models/class-PersonsModel.php";
			$myPersons = new PersonsModel($_COOKIE['email']);
			require_once SSH_ABSPATH . "/Views/homeView.php";
			break;//home
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

<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/8/2018
 * Time: 4:14 PM
 */

defined( 'SSH_ABSPATH' ) || define( 'SSH_ABSPATH', dirname( __FILE__ ) );

/*if ( isset( $_GET['query'] ) ) {
	if ( 0 === strpos( $_GET['query'], 'action' ) ) {
		echo 'Suntem pe login.';
	}

	$fragments = explode( '/', $_GET['query'] );
	if ( in_array( 'reset', $fragments ) ) {
		echo 'Ar fi cazul sa resetam.';
	}

}*/

if ( isset( $_GET['action'] ) ) {
	switch ( $_GET['action'] ) {
		case 'login':
			{
				require_once SSH_ABSPATH . "/Views/loginView.php";
				break;
			}
        case 'home':
            {
                require_once SSH_ABSPATH . "/Views/homeView.php";
                break;
            }
	}
} else {
	require_once SSH_ABSPATH . "/Views/loginView.php";
}
print_r( $_GET );

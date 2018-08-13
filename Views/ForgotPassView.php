<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/13/2018
 * Time: 2:26 PM
 */

if ( ! defined( 'SSH_ABSPATH' ) ) {
	die;
}

require_once SSH_ABSPATH . "/utils/Form.php";
require_once SSH_ABSPATH . "/utils/utilFunctions.php";

get_header_ssh( 'Password Recovery' );
?>
    <html>
    <style>
        .max-width-154 {
            max-width: 154px;
        }
    </style>
    <section class='section'>
        <div class='container max-width-154'>
            <div class='columns'>
                <div class="column is-flex is-horizontal-center">
					<?php

					$form = new Form( BASE_URL . '/?action=send-reset-email', 'post' );

					$form->addText( 'Password Reset Email' );
					$form->addNewLine();

					$form->addText( 'We will send you an email to the address below with the information needed for you to change your password.' );
					$form->addNewLine();

					$form->addField( 'email', 'Your email address', [] );
					$form->addField( 'submit',null , []);
					$form->addNewLine();

					$form->addText( 'or...' );
					$form->addNewLine();

					$form->addLink( BASE_URL . '/?action=login', 'log into your account' );
					$form->showForm();
					if ( ! empty( $error_message ) ) {
						echo "<script type='text/javascript'>alert(\"$error_message\");</script>";
					}
					if ( ! empty( $success_message ) ) {
						echo "<script type='text/javascript'>alert(\"$success_message\");</script>";
					}

					?>
                </div>
            </div>
        </div>
    </section>
    </html>
<?php


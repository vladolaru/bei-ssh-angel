<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/13/2018
 * Time: 4:01 PM
 */

if ( ! defined( 'SSH_ABSPATH' ) ) {
	die;
}

require_once SSH_ABSPATH . "/utils/Form.php";
require_once SSH_ABSPATH . "/utils/utilFunctions.php";
require_once SSH_ABSPATH . "/Models/class-EmailTokenModel.php";

get_header_ssh( 'Reset Pass' );
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
					$form = new Form( BASE_URL . '/?action=reset-pass&token=' . $_GET['token'], 'post' );

					$form->addText( 'Reset your password' );
					$form->addNewLine();
					$form->addField( 'password', 'New password', [] );
					$form->addField( 'password', 'Confirm new password', [] );
					$form->addField( 'submit', null, [] );
					$form->addText( 'or...' );
					$form->addLink( BASE_URL . '/?action=login', 'Log into your account' );
					$form->showForm();
					if ( ! empty( $message ) ) {
						$test = "<script type='text/javascript'>alert(\"" . str_replace( "\r\n", '\\n',$message)  ."\");</script>";
						echo $test;
					}
					?>
                </div>
            </div>
        </div>
    </section>
    </html>
<?php


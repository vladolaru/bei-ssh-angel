<?php
if ( ! defined( 'SSH_ABSPATH' ) ) {
	die;
}

require_once SSH_ABSPATH . "/utils/Form.php";
require_once SSH_ABSPATH . "/utils/utilFunctions.php";

get_header_ssh( 'LogIn' );
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
					if ( ! empty( $message ) ) {
						echo "<script type='text/javascript'>alert(\"$message\");</script>";
					}
					$form = new Form( BASE_URL . '/?action=log-user-in', 'post' );
                    $form->addText('Get that Santa going..');
					$form->addField( 'email', 'email', [] );
					$form->addField( 'password', 'password', [] );
					$form->addField( 'submit', null, [] );
					$form->addLink( BASE_URL . '/?action=forgot-pass', 'forgot Password?' );
					$form->addLink( BASE_URL . '/?action=register', 'Register a new account' );
					$form->showForm();

					?>
                </div>
            </div>
        </div>
    </section>
    </html>
<?php


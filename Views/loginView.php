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
					$form = new Form( '../Controllers/LoginController.php', 'post' );

					$form->addField( 'intput', 'email' );
					$form->addField( 'password', 'password' );
					$form->showForm();

					?>
                    <html
                </div>
            </div>
        </div>
    </section>
    </html>
<?php


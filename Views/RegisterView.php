<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/14/2018
 * Time: 11:28 AM
 */

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
					$form = new Form( BASE_URL . '/?action=register-user', 'post' );

					$form->addText('You are just one step away..');
					$form->addNewLine();

					$form->addField('input', 'First Name', []);
					$form->addField('input', 'Last Name', []);

					$form->addField( 'email', 'Your email address', [] );
					$form->addField( 'password', 'Your password', [] );
					$form->addField( 'submit', null, [] );

					$form->addText('or..');
					$form->addLink( BASE_URL . '/?action=Register', 'Log into your account' );
					$form->showForm();

					?>
				</div>
			</div>
		</div>
	</section>
	</html>
<?php


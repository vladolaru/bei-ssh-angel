<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/17/2018
 * Time: 12:05 PM
 */

if ( ! defined( 'SSH_ABSPATH' ) ) {
	die;
}
/** @var array $myPersonsEmails */
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
					$form = new Form( BASE_URL . '/?action=create-new-round', 'post' );
					$form->addText('Let\'s get this going..');
					$form->addNewLine();
					$form->addSelect('emails',$myPersonsEmails);
					//$form->addTextarea('Chose your participants', 'participants', 10, 50);
					$form->addNewLine();
					$form->addField('input','Recommended budget',[]);
					$form->addNewLine();
					$form->addField('input', 'Email title',[]);
					$form->addNewLine();
					$form->addField( 'email', 'Email from', [] );
					$form->addNewLine();
					$form->addField( 'submit', null, [] );
					$form->addText('or..');
					$form->addLink( BASE_URL . '/?action=home', 'Cancel' );
					$form->showForm();
					?>
				</div>
			</div>
		</div>
	</section>
	</html>
<?php


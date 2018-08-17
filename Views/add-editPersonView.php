<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/16/2018
 * Time: 12:25 PM
 */

if ( ! defined( 'SSH_ABSPATH' ) ) {
	die;
}
require_once SSH_ABSPATH . "/utils/utilFunctions.php";
require_once SSH_ABSPATH . "/Models/class-PersonsModel.php"
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
</head>
<?php get_Home_header_ssh(); ?>
<body>
<style>
    .max-width-300 {
        max-width: 300px;
    }
</style>
<section class='section'>
    <div class='container max-width-300'>
        <div class='columns'>
            <div class="column is-flex is-horizontal-center">
				<?php
				require_once SSH_ABSPATH . "/utils/Form.php";
				require_once SSH_ABSPATH . "/utils/class-Person.php";

				if ( ! isset( $thePersonToEdit ) ) {
					$thePersonToEdit = new Person( '', '', '', '', '' );
				}

				$form = new Form( BASE_URL . '/?action=update-person&type=' . $_GET['action'], 'post' );
				$form->addText( 'What is this person all about?' );
				$form->addNewLine();
				if ($thePersonToEdit->email !== '') {
					$form->addField( 'hidden', null, [ 'name=emailOfThePerson', 'value=' . $thePersonToEdit->email ] );
				}
				$form->addField( 'input', 'First Name', [ 'value=' . $thePersonToEdit->firstName ] );
				$form->addField( 'input', 'Last Name', [ 'value=' . $thePersonToEdit->lastName ] );
				$form->addField( 'email', 'Email address', [ 'value=' . $thePersonToEdit->email ] );
				$form->addField( 'input', 'Personal preferences', [ 'value="' . $thePersonToEdit->preferences . '"' ] );
				$form->addField( 'input', 'Private notes', [ 'value="' . $thePersonToEdit->notes . '"' ] );
				$form->addField( 'submit', null, [] );
				$form->addNewLine();
				$form->addText( 'or..' );
				$form->addLink( BASE_URL . '/?action=home', 'Cancel' );
				$form->showForm();

				if ( ! empty( $message ) ) {
					$test = "<script type='text/javascript'>alert(\"" . str_replace( "\r\n", '\\n', $message ) . "\");</script>";
				}
				?>


            </div>
        </div>
    </div>
</section>
</body>
</html>
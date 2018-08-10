<?php
if ( ! defined('SSH_ABSPATH' ) ) {
	die;
}

include "../utils/Form.php";

$form = new Form('../Controllers/LoginController.php', 'post');

$form->addField('intput', 'email');
$form->addField('password', 'password');

$form->showForm();


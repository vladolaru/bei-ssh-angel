<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 11:47 AM
 */

require_once "../utils/Form.php";

$login = insertHeader();

$form = new Form('test.php', 'post');
$form->addField('input', 'Your Email Address');
$form->addField('password', 'Your Password');

$login .= $form->getForm();

$loginView = fopen("../Views/loginView.php", "w");
fwrite($loginView, $login);

header("Location: ../Views/loginView.php");

function insertHeader(){
	return "<head>
	<title>Login</title>
</head>";
}
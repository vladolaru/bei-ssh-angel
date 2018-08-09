<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 11:47 AM
 */

require_once "../utils/Form.php";
require_once "../utils/loginFunctions.php";

$login = insertHeader();

$form = new Form('test.php', 'post');
$form->addField('input', 'Your Email Address');
$form->addField('password', 'Your Password');

$login .= $form->getForm();

writeToView("../Views/loginView.php", "w", $login);

GoToView('../Views/loginView.php');
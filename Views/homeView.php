<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 4:57 PM
 */
include "../utils/Form.php";
include "../Models/class-User.php";
session_start();
?>
<html>
<?php
$form = new Form('test', 'get');
$form->addField('input', 'name');
$form->showForm();

$curUser = $_SESSION['currentUser'];

echo $curUser->getUsername();
?>
 </html>
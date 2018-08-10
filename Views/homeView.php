<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 4:57 PM
 */

if ( ! defined('SSH_ABSPATH' ) ) {
    die;
}

include "../utils/Form.php";
include "../utils/utilFunctions.php";

session_start();
?>
<html>
<?php
get_header_ssh();
$form = new Form('test', 'get');
$form->addField('input', 'name');
$form->showForm();

$curUser = $_SESSION['currentUser'];

echo $curUser->getUsername();
?>
 </html>
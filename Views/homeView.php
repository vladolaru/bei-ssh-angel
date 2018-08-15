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
require_once SSH_ABSPATH . "/utils/utilFunctions.php";
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
</head>
<body>
<?php
get_Home_header_ssh();
// implement home
?>
</body>
 </html>
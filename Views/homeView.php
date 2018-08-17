<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 4:57 PM
 */

if ( ! defined( 'SSH_ABSPATH' ) ) {
	die;
}
require_once SSH_ABSPATH . "/utils/utilFunctions.php";

/** @var PersonsModel $myPersons */
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
    .credentials {
        width: 80%;
    }

    .person {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 10px;
        border-style: solid;
    }

    .person-button {
        bottom: 30px;
       margin-left: 10px;
    }
</style>
<section class='section is-centered'>
            <div class="columns is-centered">
                <div class="column is-horizontal-centered is-half">
				<?php
				if ( ! isset( $myPersons ) ) {
					exit();
				}
				foreach ( $myPersons->getMyPersons() as $onePerson ) {
					$onePerson->showPerson();
				}
				?>
            </div>
    </div>
        <div class="has-text-centered">
            <a href="/bei-ssh-angel/?action=add-person">
                <button>Add a new one</button>
            </a>
        </div>
</section>
<?php


?>
</body>
</html>
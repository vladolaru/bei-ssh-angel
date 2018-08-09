<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 12:37 PM
 */
function insertHeader(){
	return "<head>
	<title>Login</title>
</head>";
}

function writeToView($path, $mode, $stringToWrite) {
	$View = fopen($path, $mode);
	fwrite($View, $stringToWrite);
}

function GoToView ($view) {
	header("Location: $view");
}

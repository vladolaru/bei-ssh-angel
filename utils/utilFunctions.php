<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/9/2018
 * Time: 4:23 PM
 */

function get_header_ssh( $title ) {
	echo '<head>
<meta charset="UTF-8">
<title>' . $title . '</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
</head>
<section class="hero has-background-danger">
  <div class="hero-body">
    <div class="container">
      <h1 class="title is-bold">
        SSH
      </h1>
      <h2 class="subtitle">
        Santa\'s secret helptser
      </h2>
    </div>
  </div>
</section>';
}

function get_Home_header_ssh() {
	echo "
    <style>
        .tabs a {
            padding: 0;
        }
    </style>
<section class=\"hero has-background-danger\">
  <!-- Hero head: will stick at the top -->
  <div class=\"hero-head\">
    <nav class=\"navbar\">
      <div class=\"container\">
        <div class=\"navbar-brand\">
          <span class=\"navbar-burger burger\" data-target=\"navbarMenuHeroA\">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </div>
        <div id=\"navbarMenuHeroA\" class=\"navbar-menu\">
          <div class=\"navbar-end\">
            Wellcome back, ". $_COOKIE['first_name'] . "!
              <a href=\"" . BASE_URL . "/?action=log-out" . "\">&nbsp;&nbsp;&nbsp;&nbsp;(Logout)</a>
          </div>
        </div>
      </div>
    </nav>
  </div>

  <!-- Hero content: will be in the middle -->
  <div class=\"hero-body\">
    <div class=\"container\">
      <h1 class=\"title\">
        SSH
      </h1>
      <h2 class=\"subtitle\">
        Santa's secret helptser
      </h2>
    </div>
  </div>

  <!-- Hero footer: will stick at the bottom -->
  <div class=\"hero-foot\">
    <nav class=\"tabs\">
      <div class=\"container\">
        <ul class='is-pulled-right'>
          <li class='button'><a href=". BASE_URL . "/?action=home" . " >Persons</a></li>
          &nbsp;
          &nbsp;
          <li class='button'><a href=". BASE_URL . "/?action=rounds" . " >Rounds</a></li>
        </ul>
      </div>
    </nav>
  </div>
</section>";
}

function generateRandomString( $length = 10 ) {
	$characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen( $characters );
	$randomString     = '';
	for ( $i = 0; $i < $length; $i ++ ) {
		$randomString .= $characters[ rand( 0, $charactersLength - 1 ) ];
	}

	return $randomString;
}
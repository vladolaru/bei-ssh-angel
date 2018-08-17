<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/17/2018
 * Time: 11:47 AM
 */
/** @var RoundsModel $myRounds */
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

	.round {
		padding-top: 10px;
		padding-bottom: 10px;
		padding-left: 10px;
		border-style: solid;
	}

</style>
<section class='section is-centered'>
	<div class="columns is-centered">
		<div class="column is-horizontal-centered is-half">
			<?php
			if ( ! isset( $myRounds ) ) {
				exit();
			}
			if ( count($myRounds->getMyRounds()) > 0)
			foreach ( $myRounds->getMyRounds() as $oneRound ) {
				$oneRound->showRound();
			}
			?>
		</div>
	</div>
	<div class="has-text-centered">
		<a href="/bei-ssh-angel/?action=add-round">
			<button>Start new round</button>
		</a>
	</div>
</section>
</body>
</html>
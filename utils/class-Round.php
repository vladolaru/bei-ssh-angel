<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/17/2018
 * Time: 11:24 AM
 */

class Round {
	public $date;
	public $participantsNo;
	public $budget;

	public function __construct( $participantsNo ,$budget) {
		$this->date = date ( "Y-m-d H:i:s", time());
		$this->participantsNo = $participantsNo;
		$this->budget = $budget;
	}

	public function showRound() {
		$time = strtotime($this->date);
		echo "<div class='round'>" .
		        date ( 'jS F Y', $time) . "&nbsp;&nbsp;" . $this->participantsNo . " participants&nbsp;&nbsp;" .
		     "$$this->budget budget".
  			"</div>";
	}
}
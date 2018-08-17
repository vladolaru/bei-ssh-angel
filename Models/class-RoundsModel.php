<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/17/2018
 * Time: 11:24 AM
 */

require_once SSH_ABSPATH . "/utils/class-Round.php";
require_once SSH_ABSPATH . "/utils/class-Database.php";

class RoundsModel {
	/**
	 * @var Round[]
	 */
	private $myRounds;

	public function __construct( $userEmail ) {
		$records = Database::getDB()->select( 'rounds', [
			'date',
			'participants_no',
			'budget'
		], [
			'user_email[=]' => $userEmail
		] );

		foreach ( $records as $record ) {
			$this->myRounds[] = new Round( $record['participants_no'], $record['budget']);
		}
	}

	/**
	 * @return Round[]
	 */
	public function getMyRounds() {
		return $this->myRounds;
	}

	/**
	 * @param Round $round
	 * @param string $userEmail
	 */
	public static function insertRound ($round , $userEmail){
		Database::getDB()->insert('rounds',[
			'user_email' => $userEmail,
			'date' => $round->date,
			'participants_no' => $round->participantsNo,
			'budget' => $round->budget
		]);
}

}
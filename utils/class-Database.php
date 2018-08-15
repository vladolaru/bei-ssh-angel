<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 8/15/2018
 * Time: 10:50 AM
 */
require_once SSH_ABSPATH . '/vendor/autoload.php';

use  Medoo\Medoo;

class Database {
	private static $instance = null;
	/**
	 * @var Medoo
	 */
	private static $DB;

	private function __construct() {
		 self::$DB = new Medoo( [
			'database_type' => 'mysql',
			'database_name' => 'ssh_main',
			'server'        => 'localhost',
			'username'      => 'root',
			'password'      => 'root'
		] );
	}

	public static function getDB()
	{
		if (self::$instance == null)
		{
			self::$instance = new Database();
		}

		return self::$DB;
	}

}
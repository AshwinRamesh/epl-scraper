<?php
	/* Given a json file with player data. This file will write the data to the database. */

	// Config items
	const DB_HOST = "localhost";
	const DB_USER = "ashwin";
	const DB_PASSWORD = "password";

	function write_player_to_db($player) {
		echo($player->second_name."\n");
		return true;
	}

	function process_data_file($datafile) {
		$f = fopen($datafile, "r");
		$data = fread($f, filesize($datafile));
		$data = json_decode($data);
		foreach ($data as $player) {
			write_player_to_db($player);
		}
		echo "Completed database write";
	}

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (!$link) {
	die('Could not connect: ' . mysql_error());
}
echo("Connected");
mysql_close($link);

	//process_data_file("data.json");

?>

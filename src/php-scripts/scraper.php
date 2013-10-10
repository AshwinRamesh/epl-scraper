<?php

/* Scrape all player data and store it */

const PLAYER_API_URL = "http://fantasy.premierleague.com/web/api/elements/"; // remember to add id and '/' after url

// player url - http://fantasy.premierleague.com/web/api/elements/<id>

function get_json_by_id($id) {
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, PLAYER_API_URL."{$id}/");
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($curl);
	curl_close($curl);
	$data = json_decode($data);
	if (!$data) {
		return False;
	}
	return $data;
}

var_dump(get_json_by_id(-1));
?>

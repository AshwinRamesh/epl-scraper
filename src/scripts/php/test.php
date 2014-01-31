<?php

include_once(__DIR__."/../../classes/playerfixture/DataPlayerFixture.php");


$round = 1;
$date = "17 Aug 15:00";
$team = "AVL(H) 1-3";

var_dump(DataPlayerFixture::get_fixture_id($round, $date, $team));


 ?>

<?php

$datafile = "fixtures.json";
$f = fopen($datafile,"r");
$data = fread($f, filesize($datafile));
$data = json_decode($data);
$i = 0;
$lastdate = "";
foreach ($data as $fixture) {
	if ($lastdate != $fixture->Date) {
		$i = $i + 1;
		$lastdate = $fixture->Date;
	}
	$fixture->round = $i;
}
fclose($f);

$writefile = "fixtures-output.csv";
$f = fopen($writefile, "a+");
fwrite($f, json_encode($data));
fclose($f);
?>

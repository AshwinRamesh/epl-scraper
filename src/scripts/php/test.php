<?php

$a = array(1, 2);
$b = array(3, 4);

var_dump(array_merge($a, $b));

var_dump(array_merge(array($a), array($b)));

 ?>

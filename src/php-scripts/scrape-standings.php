<?php
    require_once("../../public/lib/scraper/simple_html_dom.php");
    include_once("../../public/config/config.php");

    $html = file_get_html('espn.html');
    $table = $html->find("table.tablehead tbody", 0);
    $i = 0;
    foreach ($table->find("tr") as $row) {
        $i = $i + 1;
        var_dump($i);
        $rowArray = array();
        foreach ($row->find("td") as $cell) {
            array_push($rowArray, $cell->innertext);
        }
        var_dump($rowArray);
    }
    var_dump(gettype($table));



?>

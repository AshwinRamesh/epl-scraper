<?php
    require_once("../../public/lib/scraper/simple_html_dom.php");
    include_once("../../public/config/config.php");

    $html = file_get_html('espn.html');
    $table = $html->find("table.tablehead tbody[id=Live_false_tableBody_1]", 0);
    $i = 0;
    foreach (array_slice($table->find("tr"), 3, 20) as $row) {
        $i = $i + 1;
        var_dump($i);
        $rowArray = array();
        foreach ($row->find("td") as $cell) {
            array_push($rowArray, $cell->innertext);
        }
        $teamname = explode(">", $rowArray[2]);
        $teamname = explode("<", $teamname[1]);
        $teamname = $teamname[0];
        var_dump($teamname);
        $standingsArray = array(
            "position" => intval($rowArray[0]),
            "played" => intval($rowArray[3]),
            "wins" => intval($rowArray[4]),
            "draws" => intval($rowArray[5]),
            "losses" => intval($rowArray[6]),
            "goals_for" => intval($rowArray[7]),
            "goals_against" => intval($rowArray[8]),
            "home_wins" => intval($rowArray[10]),
            "home_draws" => intval($rowArray[11]),
            "home_losses" => intval($rowArray[12]),
            "home_goals_for" => intval($rowArray[13]),
            "home_goals_against" => intval($rowArray[14]),
            "away_wins" => intval($rowArray[16]),
            "away_draws" => intval($rowArray[17]),
            "away_losses" => intval($rowArray[18]),
            "away_goals_for" => intval($rowArray[19]),
            "away_goals_against" => intval($rowArray[20]),
            "goal_difference" => intval($rowArray[22]),
            "points" => intval($rowArray[23])
        );
        //var_dump($standingsArray);
    }
    var_dump(gettype($table));



?>

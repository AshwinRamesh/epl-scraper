<?php

include_once(__DIR__."/base.php");
include_once("Fixture.php");

class DataFixture extends Fixture {

    function __construct($dataArray) {
        if ($dataArray) {
            $this->parseDataToObject($dataArray);
        }
    }

    public function parseDataToObject($data) {
        try {

        } catch (Exception $e) {
            echo "Exception occured";
        }
    }

    public function save() {
        return true;
        //TODO stub
    }

}

?>

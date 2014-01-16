<?php

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

}

?>

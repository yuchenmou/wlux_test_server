<?php

// Logs page transitions on a weblabux study site.

// In the final implementation, this will obviously write data to
// a database instead of a text file.

$type = $_POST["type"];  // the type of action we're logging

$data_arr = array();

if ($type == "open") {
    $data_arr = array("OPEN",
                      "\tSESSION:\t" . $_POST["wlux_session"],
                      "\tLOCATION:\t" . $_POST["location"],
                      "\tTIME:\t" . date('m/d/Y h:i:s a', time()));
} else if ($type == "transition") {
    $data_arr = array("TRANSITION",
                      "\tSESSION:\t" . $_POST["wlux_session"],
                      "\tFROM:\t" . $_POST["from"],
                      "\tTO:\t\t" . $_POST["to"],
                      "\tTIME:\t" . date('m/d/Y h:i:s a', time()));

}

$data = implode("\n", $data_arr) . "\n\n";
file_put_contents("log.txt", $data, FILE_APPEND);

?>

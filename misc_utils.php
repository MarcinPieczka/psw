<?php

function redirect($url) {
    header('Location: ' . $url);
}
function session_load() {
    if(!isset($_SESSION)){
        session_start();
    }
}
function break_into_lines($text, $max_line_length) {
    $lines_broken = 0;
    $line_length = 0;
    $last_space_index = 0;
    $nl = '
';
    $text = str_split($text);
    $nl_indexes = array();
    foreach($text as $i => $char) {
        if($line_length == $max_line_length) {
            if($last_space_index != 0) {
                array_push($nl_indexes, $i - $line_length + $last_space_index);
                $line_length -= $last_space_index;
                $last_space_index = 0;
            } else {
                array_push($nl_indexes, $i);
                $line_length = 0;
            }
        }
        if($char != $nl) {
            $line_length += 1;
            if($char == ' ') {
                $last_space_index = $line_length;
            }
        } else {
            $line_length = 0;
        }
    }
    foreach($nl_indexes as $count => $index) {
        array_splice($text, $index + $count, 0, $nl);
    }
    return join('', $text);
}
?>

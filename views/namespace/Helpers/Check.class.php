<?php


class Check {
    public static function var_dump_json ($Array) {
        echo json_encode($Array);
        die();
    }
}
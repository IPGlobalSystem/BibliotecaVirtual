<?php

class Database{
    public static function connect(){
        $db = new mysqli('localhost','root','root','bibliotecavirtual','3307');
        $db->query("SET NAMES 'utf-8'");

        return $db;
    }
}

?>
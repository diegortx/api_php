<?php
/**
 * This class is using to connect in BD
 * @method function connect()
 */
class DB
{
    /**
     * Using for to call conection with BD, check if all information are correct to connect
     */
    public static function connect()
    {
        $host = "127.0.0.1";
        $user = "root";
        $pass = "";
        $db_database = "api_php";

        #Using PDO to connect
        return new PDO("mysql:host={$host};dbname={$db_database};charset=UTF8;", $user, $pass);
    }
}
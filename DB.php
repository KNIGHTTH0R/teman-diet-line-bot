<?php

/**
 * Created by VSCode.
 * User: luqman
 * Date: 10/06/17
 * Time: 8:49 PM
 */
class DB
{
    public static $db;

    public static function getDB(){
        if(! isset(self::$db)){
            $config = [
                'host' => getenv('DB_HOST'),
                'user' => getenv('DB_USER'),
                'password' => getenv('DB_PASSWORD'),
                'dbname' => getenv('DB_NAME')
            ];
            $type = getenv('SQL_TYPE');
            self::$db = new PDO("{$type}:host=".$config['host'].";dbname=".$config['dbname'].";port=".getenv('DB_PORT'), $config['user'], $config['password']);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        return self::$db;
    }
}
<?php
class Connection
{
    private static ?PDO $pdo = null;
    public static function getConnection() : PDO {
        if (self::$pdo){
            return self::$pdo;
        }
        $host = 'db';
        $dbName = 'db';
        $userName = 'db';
        $password = 'db';

        self::$pdo = new PDO("mysql:host=$host;dbname=$dbName", $userName, $password);
        return self::$pdo;
    }
    
}
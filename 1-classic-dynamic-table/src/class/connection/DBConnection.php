<?php
namespace App\class\connection;

use PDO;
use App\class\auth\Auth;

class DBConnection {

    public static $pdo;
    public static $auth;

    public static function PDOConnection(): PDO
    {

        if(!self::$pdo) {
            self::$pdo = new PDO('sqlite: ../../../data.sqlite', null, null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }
        return self::$pdo;
    }

    public static function getAuth(): Auth
    {
        if(!self::$auth) {
            self::$auth = new Auth(self::PDOConnection());
        }
        return self::$auth;
    }
    
}
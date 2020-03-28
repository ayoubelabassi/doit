<?php
/**
 * Created by PhpStorm.
 * User: AYOUB
 * Date: 11/03/2020
 * Time: 19:59
 */
require_once __DIR__ . "/AppConstants.php";

class DbUtils
{
    public static function getConnection()
    {
        $con = new PDO("mysql:host=" . AppConstants::$host . ";" . "dbname=" . AppConstants::$database, AppConstants::$username, AppConstants::$password);
        return $con;
    }

    public function executeUpdate($query, $params)
    {
        $con = self::getConnection();
        $q = $con->prepare($query);
        $q->execute($params);
        return true;
    }

    public function executeQuery($query)
    {
        $pdo = self::getConnection();
        return $pdo->query($query);
    }
}

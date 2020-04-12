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

    /**
     * Méthode pour inserer, modifier et supprimer les données à partir de base de données
     * @param $query
     * @param $params
     * @return bool
     */
    public function executeUpdate($query, $params)
    {
        $con = self::getConnection();
        $q = $con->prepare($query);
        $res = $q->execute($params);
        return $res;
    }

    /**
     * Fonction pour récupérer les données à partir de la base de données utilisant une réquet SQL
     * @param $query
     * @return false|PDOStatement
     */
    public function executeQuery($query)
    {
        $pdo = self::getConnection();
        return $pdo->query($query);
    }
}

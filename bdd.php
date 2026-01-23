<?php
function connectToSql($dbname)
{
    try {
        // Connexion à MySQL
        $mysqlClient = new PDO(
            "mysql:host=localhost;dbname=$dbname;charset=utf8",
            "root",
            ""
        );

        return $mysqlClient;

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

?>


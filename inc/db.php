<?php
/* Connexion à une base ODBC avec l'invocation de pilote */
$dsn = "mysql:dbname={$config['DB_database']};host={$config['DB_host']};charset=UTF8";
$dsn = 'mysql:dbname='.$config['DB_database'].';host='.$config['DB_host'].';charset=UTF8';

try {
    $pdo = new PDO($dsn, $config['DB_username'], $config['DB_password']);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    exit;
}
  // echo 'Connexion OK: ';
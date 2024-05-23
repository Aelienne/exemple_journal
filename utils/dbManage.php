<?php
// Nous n'avons pas besoin de filldata car nous n'utilisons pas de données API
function dbManage()
{

    try {

        $host = "localhost";
        $databaseName = "bdd_journal";
        $user = "root";
        $password = "";

        $pdo = new PDO("mysql:host=" . $host . ";port=3306;dbname=" . $databaseName . ";charset=utf8", $user, $password);

        configPdo($pdo);

        return $pdo;
    } catch (Exception $e) {

        //Lancer l'erreur
        //throw $e;

        echo ("Cela ne fonctinne pas... : " .  $e->getMessage());

        exit();
    }
}

function configPdo(PDO $pdo)
{
    // Recevoir les erreurs PDO ( coté SQL )
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Choisir les indices dans les fetchs
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
function findAnnonceById(PDO $pdo, int $id): array
{
    $query = $pdo->prepare('SELECT * FROM annonce WHERE id = :id');
    $query->execute([
        ":id" => $id
    ]);
    return $query->fetch();
}
function findAllAnnonce(PDO $pdo): array
{
    $reponse = $pdo->query('SELECT * FROM annonce');
    return $reponse->fetchAll();
}

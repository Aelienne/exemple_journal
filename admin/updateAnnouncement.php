<?php

include_once("./blockadmin/header.php");
if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
}

require_once("../utils/dbManage.php");
$title = "Mettre à jour une annonce";
$pdo = dbManage();
$id = $_GET["id"];
$idannonce = findAnnonceById($pdo, $_GET["id"]);
include_once("./blockadmin/navbar.php");

if (
    // Je fais les verifs des données de la page pour les modifications
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST["image"], $_POST["contenu"], $_POST["titre"], $_POST["auteur"])
) {

    // La requête pour update dans le tableau bdd
    $response = $pdo->prepare("UPDATE annonce SET imageUrl = :imageUrl, contenu = :contenu, titre = :titre, auteur = :auteur, datePublication = NOW() WHERE id = :id");
    $response->execute([
        ":imageUrl" => $_POST["image"],
        ":contenu" => $_POST["contenu"],
        ":titre" => $_POST["titre"],
        ":auteur" => $_POST["auteur"],
        ":id" => $idannonce["id"]
    ]);
    header("location:index.php");
}
?>
<div class="modif">
    <div>

        <h2><?php echo ($title ?? "Default Title") ?></h2>

    </div>
    <form class="modif" method="POST" action="updateAnnouncement.php?id=<?php echo ($_GET["id"]); ?>">
        <label for="imageUrl">ImageUrl</label>
        <input type="file" name="image" id="image" value=""></input>
        <label for="contenu">Contenu<br></label>
        <textarea name="contenu"><?php echo ($idannonce["contenu"]) ?></textarea>
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre" value="<?php echo ($idannonce["titre"]) ?>"></input>
        <label for="auteur">Auteur</label>
        <input type="text" name="auteur" id="auteur" value="<?php echo ($idannonce["auteur"]) ?>"></input>
        <input type="submit" value="Valider"></input>
    </form>
</div>

<?php
include_once("../block/footer.php");
?>
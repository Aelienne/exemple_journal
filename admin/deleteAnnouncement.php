<?php
include_once("./blockadmin/header.php");
if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
}

require_once("../utils/dbManage.php");
$title = "Supprimer une annonce";
$pdo = dbManage();
$id = $_GET["id"];

include_once("./blockadmin/navbar.php");

if (
    // Je fais les verifs des données de la page pour l'envoi
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST["valider"])
) {

    $pdo = dbManage();
    // La requête pour effacer une annonce avec son id dans le tableau bdd
    $response = $pdo->prepare("DELETE FROM annonce WHERE id = :id");
    $response->execute([
        "id" => $id
    ]);
    header("location:index.php");
}

if (
    // Je fais les verifs des données de la page pour l'envoi
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST["annuler"])
) {
    header("location:index.php");
}
?>

<div class="warning">

    <h2><?php echo ($title ?? "Default Title") ?></h2>
    <h2>Es-tu sur de vouloir supprimer l'annonce ? Si Oui, clique sur valider ! Sinon annule VITE.</h2>

</div>
<form method="POST" action="deleteAnnouncement.php?id=<?php echo ($_GET["id"]); ?>">
    <button type="submit" name="valider">Valider</button>
    <button type="submit" name="annuler">Annuler</button>
</form>

<?php
include_once("./blockadmin/footer.php");
?>
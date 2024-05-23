<?php
include_once("./blockadmin/header.php");
// cela permet de rediriger si ce n'est pas un compte, le but et de n'accepter que les comptes admins pour les modifs.
if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
}
$title = "Admin";

include_once("./blockadmin/navbar.php");
require_once("../utils/dbManage.php");
// connexion base de données
$pdo = dbManage();
// requête SQL
$reponse = $pdo->query('SELECT * FROM annonce');
// resultats de la réponse dans une variable
$annonce = $reponse->fetchAll();
?>
<div>
    <div>

        <h1><?php echo ($title ?? "Default Title") ?></h1>

    </div>
    <div class="cards">
        <?php
        foreach ($annonce as $annonce) {
        ?>
            <div class="card">
                <h2> <?php echo ($annonce["titre"]) ?></h2>
                <img src="<?php echo "./uploads/" . ($annonce["imageUrl"]) ?>" class="img-fluid">
                <p> Description : <?php echo ($annonce["contenu"]) ?></p>
                <p> Auteur : <?php echo ($annonce["auteur"]) ?></p>
                <p> Publiée le <?php echo ($annonce["datePublication"]) ?></p>
                <a href="./deleteAnnouncement.php?id=<?php echo ($annonce['id']) ?>">Supprimer</a>
                <a href="./updateAnnouncement.php?id=<?php echo ($annonce['id']) ?>">Modifier</a>
            </div>
        <?php
        }
        ?>
    </div>

    <?php
    include_once("./blockadmin/footer.php");
    ?>
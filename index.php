<?php
$title = "Dauphine";

include_once("block/header.php");
include_once("block/navbar.php");
require_once("utils/dbManage.php");

$pdo = dbManage();

$reponse = $pdo->query('SELECT * FROM annonce');

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
                <h1> <?php echo ($annonce["titre"]) ?></h1>
                <img src="<?php echo "admin/uploads/" . ($annonce["imageUrl"]) ?>" class="img-fluid">
                <p> Description : <?php echo ($annonce["contenu"]) ?></p>
                <p> Auteur : <?php echo ($annonce["auteur"]) ?></p>
                <p> Publiée le <?php echo ($annonce["datePublication"]) ?></p>
            </div>
        <?php
        }
        ?>
    </div>

    <?php
    include_once("block/footer.php");
    ?>
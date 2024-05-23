<?php
include_once("./blockadmin/header.php");
if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
}
include_once("./blockadmin/navbar.php");
require_once("../utils/dbManage.php");
$title = "Nouvelle annonce";



if (
    // Je fais les verifs des données de la page pour l'envoi
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_FILES["image"], $_POST["contenu"], $_POST["titre"], $_POST["auteur"])
) {
    // je tente de faire l'envoi d'un fichier
    if ($_FILES["image"]["error"] == 0) {
        if ($_FILES["image"]["size"] < 1000000) {
            // je mets dans un variable le type de mon image (extension)
            $typeMime = $_FILES["image"]["type"];
            // je donne les conditions d'extensions que j'accepte
            $extensions_autorisees = array("image/jpeg", "image/png", "image/gif", "image/jpg");
            $extension = explode('/', $_FILES["image"]["type"])[1];
            $imageUrl = uniqid('', true) . '.' . $extension;

            if (in_array($typeMime, $extensions_autorisees)) {
                move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/' . $imageUrl);
                $pdo = dbManage();
                // La requête pour insérer dans le tableau bdd
                $response = $pdo->prepare("INSERT INTO annonce (imageUrl, contenu, titre, auteur, datePublication)
                VALUES (:imageUrl, :contenu, :titre, :auteur, NOW())");
                $response->execute([
                    ":imageUrl" => $imageUrl,
                    ":contenu" => $_POST["contenu"],
                    ":titre" => $_POST["titre"],
                    ":auteur" => $_POST["auteur"]
                ]);
                header("location:index.php");
            } else {
                echo ("je n'accepte que les images");
            }
        }
    } else {
        echo ("Le fichier est trop volumineux");
    }
}
?>
<div class="new">
    <div>

        <h2><?php echo ($title ?? "Default Title") ?></h2>

    </div>
    <form class="new" method="POST" action="addAnnouncement.php" enctype="multipart/form-data">
        <label for="imageUrl">ImageUrl</label>
        <input type="file" name="image" id="image"></input>
        <label for="contenu">Contenu<br></label>
        <textarea name="contenu"></textarea>
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre"></input>
        <label for="auteur">Auteur</label>
        <input type="text" name="auteur" id="auteur"></input>
        <input type="submit" value="Valider"></input>
    </form>
</div>
<?php
include_once("../block/footer.php");
?>
<?php
require_once("utils/dbManage.php");
$title = "Login";

$errors = [];

// est ce que j'ai validé le form
if (
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST["username"], $_POST["password"])
) {
    //Validation des données

    //Verifier si les identifiants
    $pdo = dbManage();
    // Je récupère avec une requête les données username et mdp pour la connection dans la base de donné
    $response = $pdo->prepare("SELECT username, password FROM utilisateur WHERE username = :username");
    $response->execute([
        ":username" => $_POST["username"]
    ]);

    $user = $response->fetch();
    // fetch renvoie false si il n'y a pas de resultat ou erreur
    if ($user !== false) {
        if (password_verify($_POST["password"], $user["password"])) {
            //Connexion réussie 
            session_start();

            $_SESSION["username"] = $_POST["username"];

            header("Location: ./admin/index.php");
        } else {
            $errors["global"] = "Identifiants invalides";
        }
    }
} else {
    $errors["global"] = "Identifiants manquants";
}
include_once("block/header.php");
?>


<div class="container">

    <h1><?php echo ($title) ?></h1>

    <form method="POST" action="login.php">

        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <label for="password">Password</label>
        <input type="text" name="password" id="password">

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($errors["global"])) {
            echo ("<p class='text-danger'>" .
                $errors["global"] . "</p>");
        }
        ?>

        <input type="submit" value="Valider">
    </form>

</div>



<?php
include_once("block/footer.php");
?>
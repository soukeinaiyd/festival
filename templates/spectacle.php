<?php
   require_once './config/connexion.php';
   require_once './config/global.php';


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $req = $pdo->prepare('SELECT * FROM spectacle WHERE id =:id');
    $req->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $req->execute();
    $spectacle = $req->fetch();
} else {
    include_once './templates/accueil.php';
}

if ($spectacle) {
?>

<h1><?= $spectacle['nom'] ?></h1>

<!-- reste de l'affichage -->

<?php
} else {
    include_once './templates/accueil.php';
}
?>





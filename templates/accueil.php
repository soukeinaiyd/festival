

<?php


require_once './config/connexion.php';
require_once './config/global.php';

?>
<?php

// on soumet une requete sql à PDO
$requete = $pdo->query('SELECT * FROM spectacle');
// fetchAll correspond au résultat de la requete passé à query
$Spectacles = $requete->fetchAll(PDO::FETCH_ASSOC);
?>
<div id="spectacles">

            <?php foreach($Spectacles as $spectacle) { ?>
                <div class="spectacle">
                    <img src="assets/img/<?php echo $spectacle['image']; ?>">
                    <h5><?php echo $spectacle['nom']; ?></h5>
                    <p><?php echo $spectacle['prix']; ?></p>
                    <p><?php echo $spectacle['description']; ?></p>
                    <button>ajouter au panier</button>
                    
                </div>
                <?php } ?>

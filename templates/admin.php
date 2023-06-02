<?php
     require_once './config/connexion.php';
     require_once './config/global.php';
// récupération des données
    $reqSpectacles = $pdo->query('SELECT spectacle.id, prix, salle.nom AS salle FROM spectacle INNER JOIN salle ON spectacle.salle_id = salle.id ORDER BY salle.id DESC');
    $spectacles = $reqSpectacles->fetchALL();
    $reqSalles = $pdo->query('SELECT * FROM salle');
    $salles   = $reqSalles->fetchALL();
?>

<h1>Espace administrateur</h1>

<h2>$spectacles</h2>

<table class="table table-hover">
    <thead>
        <tr>
        <    <th>NUMERO</th>
            <th>NOM</th>
            <th>PRIX</th>
            <th>SALLE</th>
            <th>ACTIONS</th>
        </tr>
    </thead>
    <tbody>
    <?php
            if (!empty($spectacles)) {
                 foreach($spectacles as $spectacle):
     ?>
         <tr>
                 <td><?= $spectacle['id'] ?></td>
                 <td><?= $spectacle['nom'] ?></td>
                 <td><?= $spectacle['prix'] ?></td>
                 <td><?= $spectacle['salle'] ?></td>
                 <td>
                   <a href="#"><i class="bi bi-pencil-square"></i></a>
                   <a href="./functions/traitement.php?action=spectacle-delete&id=<?= $spectacle['id'] ?>" class="text-danger"><i class="bi bi-trash"></i></a>
                 </td>
         </tr>
        <?php 
             endforeach;          
            } else {
                echo '
                    <tr>
                        <td colspan=5>Aucun spectacle trouvé</td>
                    </tr>
                ';
            }
            
       ?>
      
    </tbody>
</table>

<div  class="text-end">
    <a href="index.php?page=spectacle-form" class="btn
    btn-primary">trouver un spectacle </a>
        </div>
<h2>salles</h2>

<table class="table table-hover text-center my-5">
    <thead>
        <tr>
            <th>NUMERO</th>
            <th>NOM</th>
            <th>ACTIONS</th>
        </tr>
    </thead>
    <tbody>
     <?php foreach ($salles as $salle):?>
        <tr>
           <td><?= $salle['id']?></td>
           <td><?= $salle['nom']?></td>
           <td>
              <a href="#"><i class="bi bi-pencil-square"></i></a>
              <a href="./functions/traitement.php?action=salle-delete&id=<?= $salle['id'] ?>"><i class="bi bi-trash"></a>
           </td>  
        </tr>
      <?php endforeach ?>

        
    </tbody>
</table>

<form action="./functions/traitement.php?
action=salle-create" method="POST">
    <label for="title">nom</label>
    <input type="text" name="title" maxlength="100" required>
    <input type="submit" value=" crééer une salle ">
</form>
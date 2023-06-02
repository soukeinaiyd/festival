<?php
    // base de données
    require_once './config/connexion.php';
    require_once './config/global.php';

    // récupération des données
    $reqSalles = $pdo->query('SELECT * FROM salle');
    $salles = $reqSalles->fetchAll();
?>

<h1>trouver un spectacle </h1>

<form action="./functions/traitement.php?action=spectacle-create" method="POST" enctype="multipart/form-data" class="my-5">

    <div class="row">
        <div class="col-4 offset-2">
            <div class="form-group mb-3">
                <label for="title">Nom</label>
                <input type="text" name="title" mawlength="100" required class="form-control">
            </div>
        </div>
        <div class="row">
        <div class="col-4 offset-2">
            <div class="form-group mb-3">
                <label for="prix">prix</label>
                <input type="text" name="prix" mawlength="30" required class="form-control">
            </div>
        </div>
       
     


        <div class="col-4">
            <div class="form-group mb-3">
                <label for="des">description</label>
                <input type="text" name="des" mawlength="255" required class="form-control">
            </div>
        </div>
    </div>

   

    <div class="row">
        <div class="col-4 offset-2">
            <div class="form-group mb-3">
                <label for="image">Image</label>
                <input type="file" name="image" accept="image/*" class="form-control">
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-4 offset-2">
            <div class="form-group mb-3">
                <label for="published">il y a une salle</label>
                <select name="published" required class="form-control">
                    <option value="">-- choisir --</option>
                    <option value="true">oui</option>
                    <option value="false">non</option>
                </select>
            </div>
        </div>

   
                <label for="salle">salle</label>
                <select name="salle" required class="form-control">
                    <option value="">-- choisir --</option>
                    <?php foreach ($salles as $salle): ?>
                        <option value="<?= $salle['id'] ?>"><?= $salle['nom'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group text-end">
        <div class="col-8 offset-2">
            <input type="submit" value="Valider" class="btn btn-success">
        </div>
    </div>

</form>

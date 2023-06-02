<?php
session_start();// initialise la session
require_once '../config/connexion.php';
require_once '../config/global.php';
//nettoyage des variables


/***************************************salle************************************ */
/*********************create************************* */ 
if (isset($_GET['action']) && $_GET['action'] ==
 'salle-create'){

    $name=strip_tags(trim($_POST['name']));

    if (!empty($name) && strlen($name)<=45){
     $req = $pdo->prepare('INSERT INTO salle (nom) VALUES (:name)');// prépare une requete sql
    $req->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $req->execute();
    $_SESSION['notification']=[
        'type' => 'succes',
        'message' =>'la salle est bien créée'
    ];
    //message succes 
    }else{
        //message d'erreur
        $_SESSION['notification']=[
            'type' => 'danger',
            'message' =>'Une erreur est survenue lors de la création de la salle'
        ]; 
    }
    header('location:../index.php?page=admin');
}
/*********************update************************* */ 
if (isset($_GET['action']) && $_GET['action'] ==
 'salle-update'){
    
}
/*********************delate************************* */ 
if (isset($_GET['action']) && $_GET['action'] ==
 'salle-delete') {
    $req = $pdo->prepare('DELETE FROM salle WHERE id = :id');// prépare une requete sql
    $req->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $req->execute();
    
    // message de succes
    header('location:../index.php?page=admin');
}

/***************************************article************************************ */
if (isset($_GET['action']) && $_GET['action'] ==
 'spectacle-create'){
//nettoyage des données
$title=strip_tags(trim($_POST['nom']));
$des=strip_tags(trim($_POST['description']));
$prix=strip_tags(trim($_POST['prix']));


$salle = (INT)$_POST['salle'];

$errorMessage ='<p>Merci de vérifier les points suivants:</p>';
$validation=true;
//vérification du titre
if (empty($title) ||  strlen($title) > 100){
    $errorMessage .='<p>- le champ nom est obligatoire est doit comporter moins de 100 caratères.</p>';
    $validation=false;
}
if (empty($des) ||  strlen($des) > 255){
    $errorMessage .='<p>- le champ description est obligatoire est doit comporter moins de 255 caratères.</p>';
    $validation=false;
}

if (empty($prix) ||  strlen($prix) > 11){
    $errorMessage .='<p>- le champ "prix" est obligatoire est doit comporter moins de 11 caratères.</p>';
    $validation=false;
}




if (empty($salle) || !is_int($salle) ){
    $errorMessage .='<p>- problème de salle.</p>';
    $validation=false;
}

$authorizedFormats = [
'image/png',
'image/jpg',
'image/jpeg',
'image/jp2',
'image/webp',
'image/gif',
];

if(empty($_FILES['image']['name']) || $_FILES['image']['size']> 2000000 || !in_array($_FILES['image']['type'],$authorizedFormats))  {
    $errorMessage .='<p>- l\'image ne doit pas  dépasser 2 Mo et doit etre en format PNG,JPG,JPEG,JP2,WEBP,GIF.</p>';
    $validation = false;
    echo 'pb img';
}


if($validation == true){
   //requete 
$timestamp = time();
$format = strstr($_FILES['image']['name'],'.');
$imgName = $timestamp . $format;
move_uploaded_file($_FILES['image']['tmp_name'],'../assets/img/' . $imgName);

// requete
$req = $pdo->prepare('INSERT INTO spectacle (image, nom, description , prix,  salle_id) VALUES (:image, :nom, :description, :prix, :salle_id)');
$req->bindParam(':nom', $title, PDO::PARAM_STR);
$req->bindParam(':description', $des, PDO::PARAM_STR);
$req->bindParam(':image', $imgName, PDO::PARAM_STR);
$req->bindParam(':prix', $prix, PDO::PARAM_STR);
$req->bindParam(':salle_id', $salle, PDO::PARAM_INT);
$req->execute();
// message de succes
$_SESSION['notification'] = [
 'type' => 'success',
 'message' => "le spectacle a bien été créé"

];



}else{
    $_SESSION['notification'] = [
        'type' => 'danger',
        'message' => $errorMessage
       
    ];
   header('Location:../index.php?page=spectacle-form');
}
}

// modification d'un article
if (isset($_GET['action']) && $_GET['action'] ==
 'spectacle-update'){
    
}

// suppression d'un article
if (isset($_GET['action']) && $_GET['action'] == 
'spectacle-delete'){

    if (isset($_GET['id']) && !empty($_GET['id'])){
        // traitement

        $reqImage = $pdo->prepare('SELECT image FROM spectacle WHERE id=:id');
        $reqImage->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $reqImage->execute();
        $nomImage = $reqImage->fetch();

       $localisationImage = '../assets/img/' .$nomImage['image'];
       if(file_exists($localisationImage)){
        unlink($localisationImage);
       }
       // suppression de l'article en base de données
         $reqSuppression = $bdd->prepare('DELETE FROM spectacle WHERE id=:id');
         $reqSuppression->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
         $reqSuppression->execute();

// message de succès
        $_SESSION['notification'] = [
    'type' => 'success',
    'message' => 'Le spectacle a bien été supprimé'
        ];
    } else{
        $_SESSION['notification'] = [
        'type' => 'danger',
        'message' => 'Une erreur est survenue lors de la supression de spectacle'
        ];
    }
    
    header('Location:../index.php?page=admin');
}



/*----------------------------------contact---------------------------------------*/
if (isset($_GET['action']) && $_GET['action'] == 'contact') {

    $firstName = strip_tags(trim($_POST['first_name']));
    $lastName = strip_tags(trim($_POST['last_name']));
    $email= strip_tags(trim($_POST['email']));
    $object= strip_tags(trim($_POST['object']));
    $message = strip_tags(trim($_POST['message']));
    
    $errorMessage .='<p>-Merci de vérifier les points suivants :</p>';
    $validation = true;
 
     if (empty($firstName) ||  strlen($firstName) > 45){
         $errorMessage .='<p>- le prenom est obligatoire est doit comporter moins de 45 caratères.</p>';
         $validation=false;
     }
 
     if (empty($lastName) ||  strlen($lastName) > 45){
         $errorMessage .='<p>- le nom est obligatoire est doit comporter moins de 45 caratères.</p>';
         $validation=false;
     }
 
     if (empty($email) ||  strlen($email) > 100){
         $errorMessage .='<p>- L\'email est obligatoire est doit comporter moins de 45 caratères.</p>';
         $validation=false;
     }
 
     if (empty($object) ||  strlen($object) > 6){
         $errorMessage .='<p>- l\'objet est obligatoire .</p>';
         $validation=false;
     }
 
     if (empty($message) ||  strlen($message) > 1000){
         $errorMessage .='<p>- le message est obligatoire est doit comporter moins de 1000 caratères.</p>';
         $validation=false;
     }
 
     if ($validation == true){
         
         $destinataire = '';
         $emetteur = '';
         $titre = '';
         $contenu= '';
         $entetes= '';
 
         if( $object == 'emploi'){
             $destinataire = 'techno.souka@gmail.com';
         }else if  ($object == 'bug'){
             $destinataire = 'techno.souka@gmail.com';
         }else if  ($object == 'info'){
             $destinataire = 'techno.souka@gmail.com';
         }else   {
             $destinataire = 'techno.souka@gmail.com';
         }
 
         $emetteur = $email;
         $titre = 'Nouvelle demande de contact - ' . $object;
         $contenu = $message;
 
         $entetes = 'MIME-Version: 1.0' . "\r\n" .
         'Content-type: text/html; charset=utf-8' . "\r\n" .
         'From: ' . $emetteur ."\r\n";
  
         if (mail($destinataire, $titre, $contenu , $entetes)) {
             $_SESSION['notification'] = [
                 'type' => 'success',
                 'message' => 'Votre demande a bien prise en compte.Nous vous répondrons dans les plus bref délais'
             ];
         } else {
             $_SESSION['notification'] = [
                 'type' => 'danger',
                 'message' => 'une erreur est survenue lors de l\'envoi  de  votre message'
             ];
         }
     } else {
         $_SESSION['notification'] = [
             'type' => 'danger',
             'message' => $errorMessage
         ];
     }
            
     header('Location:../index.php?page=contact');
 }
 
 ?>

?>



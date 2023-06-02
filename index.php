<!DOCTYPE html>
<html lang="fr">
<head>
  <?php require_once "./templates/_partials/head.php";?>
</head>
<body>
  <header>
  <?php require_once "./templates/_partials/header.php";?>
  </header>
  <main>

  <?php 
  if (isset($_GET['page'])&&!empty($_GET['page'])){
   if (file_exists("./templates/". $_GET['page'].".php")){
    include_once "./templates/". $_GET['page'].".php";
}else{
    include_once "./templates/accueil.php";
  }
  }
?>
  </main>
  <footer>
  <?php require_once "./templates/_partials/footer.php";?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src=".assets/js/script.js"></qcript>

</body>
</html>


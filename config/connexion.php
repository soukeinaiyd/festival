<?php 
include 'global.php';

$dbuser = DB_USER;
$dbname  = DB_NAME;
$dbpassword =  DB_PASSWORD;
// crée une connexion pour accéder à mysql
$pdo = new PDO("mysql:host=localhost;dbname=$dbname",$dbuser,$dbpassword);

<?php
session_start();
$nom_server = "localhost";
$nom_base_de_donne = "gestion_stock";
$utilisateur = "root";
$motpass = "";

try{
    $connexion = new PDO("mysql:host=$nom_server;dbname=$nom_base_de_donne",$utilisateur,$motpass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connexion;
}catch (Exception $e){
    die("Error de connexion: ".$e->getMessage());
}

?>
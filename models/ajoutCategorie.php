<?php
 include('connexion.php'); 
 
 if( !empty($_POST["libelle"])){

    $sql = "INSERT INTO categorie (libelle) VALUES(?)";
    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST["libelle"]
    ));
    if ($req->rowCount() != 0) {
       $_SESSION["message"]["text"] = "La categorie a été ajouter avec success";
       $_SESSION["message"]["type"] = "success";
    }else{
      $_SESSION["message"]["text"] = "Une erreur s'est produite lors de l'ajout de la categorie";
       $_SESSION["message"]["type"] = "warning";
    }
 }else{
      $_SESSION["message"]["text"] = "Une information obligatoire n'est pas renseignée";
       $_SESSION["message"]["type"] = "danger";
 }

 header('Location:../vue/categorie.php');
 
 ?>
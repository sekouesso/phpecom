<?php
 include('connexion.php'); 
 
 if( !empty($_POST["nom"]) 
    && !empty($_POST["prenom"])
    && !empty($_POST["telephone"])
    && !empty($_POST["adresse"])
 ){

    $sql = "INSERT INTO client (nom,prenom,telephone,adresse)
            VALUES(?,?,?,?)";
    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST["nom"],
        $_POST["prenom"],
        $_POST["telephone"],
        $_POST["adresse"]
    ));
    if ($req->rowCount() != 0) {
       $_SESSION["message"]["text"] = "L'client a été ajouter avec success";
       $_SESSION["message"]["type"] = "success";
    }else{
      $_SESSION["message"]["text"] = "Une erreur s'est produite lors de l'ajout de l'client";
       $_SESSION["message"]["type"] = "warning";
    }
 }else{
      $_SESSION["message"]["text"] = "Une information obligatoire n'est pas renseignée";
       $_SESSION["message"]["type"] = "danger";
 }

 header('Location:../vue/client.php');
 
 ?>
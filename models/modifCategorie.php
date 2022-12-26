<?php
 include('connexion.php'); 
 
 if( !empty($_POST["libelle"]) && !empty($_POST["id"])){
    $sql = "UPDATE categorie SET libelle = ?
            WHERE id =?";
    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST["libelle"],
        $_POST["id"]
    )
    );
    if ($req->rowCount() != 0) {
       $_SESSION["message"]["text"] = "La categorie a été modifier avec success";
       $_SESSION["message"]["type"] = "success";
    }else{
      $_SESSION["message"]["text"] = "Une erreur s'est produite lors de la modification de la categorie";
       $_SESSION["message"]["type"] = "warning";
    }
 }else{
      $_SESSION["message"]["text"] = "Une information obligatoire n'est pas renseignée";
       $_SESSION["message"]["type"] = "danger";
 }

 header('Location:../vue/categorie.php');
 
 ?>
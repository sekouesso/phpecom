<?php
//  include('connexion.php'); 
 include('../models/fonctions.php');

 
 if( !empty($_POST["id_article"]) 
    && !empty($_POST["id_fournisseur"])
    && !empty($_POST["quantite"])
    && !empty($_POST["prix"])
 ){
         
         $sql = "INSERT INTO commande (id_article,id_fournisseur,quantite,prix)
         VALUES(?,?,?,?)";
         $req = $connexion->prepare($sql);
         $req->execute(array(
               $_POST["id_article"],
               $_POST["id_fournisseur"],
               $_POST["quantite"],
               $_POST["prix"]
         ));
         if ($req->rowCount() != 0) {
            $sql = "UPDATE article SET quantite = quantite+? WHERE id =?";
            $req = $connexion->prepare($sql);
            $req->execute(array(
               $_POST["quantite"],
               $_POST["id_article"]
            ));
         if ($req->rowCount() != 0) {
            $_SESSION["message"]["text"] = "La commande a été effectuer avec success";
            $_SESSION["message"]["type"] = "success";
         }else{
            $_SESSION["message"]["text"] = "Impossible de faire cette commande";
            $_SESSION["message"]["type"] = "warning";
         }
      }
      }else{
      $_SESSION["message"]["text"] = "Une information obligatoire n'est pas renseignée";
       $_SESSION["message"]["type"] = "danger";
 }

 header('Location:../vue/commande.php');
 
 ?>
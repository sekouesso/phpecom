<?php
 include('connexion.php'); 
 
 if( !empty($_POST["nom_article"]) 
    && !empty($_POST["id_categorie"])
    && !empty($_POST["quantite"])
    && !empty($_POST["prix_unitaire"])
    && !empty($_POST["date_fabrication"])
    && !empty($_POST["date_expiration"])
 ){
   print_r($_POST);
    $sql = "INSERT INTO article (nom_article,id_categorie,quantite,prix_unitaire,date_fabrication,date_expiration)
            VALUES(?,?,?,?,?,?)";
    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST["nom_article"],
        $_POST["id_categorie"],
        $_POST["quantite"],
        $_POST["prix_unitaire"],
        $_POST["date_fabrication"],
        $_POST["date_expiration"]
    ));
    if ($req->rowCount() != 0) {
       $_SESSION["message"]["text"] = "L'article a été ajouter avec success";
       $_SESSION["message"]["type"] = "success";
    }else{
      $_SESSION["message"]["text"] = "Une erreur s'est produite lors de l'ajout de l'article";
       $_SESSION["message"]["type"] = "warning";
    }
 }else{
      $_SESSION["message"]["text"] = "Une information obligatoire n'est pas renseignée";
       $_SESSION["message"]["type"] = "danger";
 }

 header('Location:../vue/article.php');
 
 ?>
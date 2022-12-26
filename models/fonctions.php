<?php
 include('connexion.php');

 function getArticles($id=null) {
    if (!empty($id)) {
        $sql = "SELECT a.id, nom_article, libelle, quantite, prix_unitaire,date_fabrication,date_expiration,id_categorie
                FROM article as a, categorie as c WHERE a.id_categorie = c.id AND a.id=?";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute([$id]);
        return $req->fetch();
    } else {
        $sql = "SELECT a.id, nom_article, libelle, quantite, prix_unitaire,date_fabrication,date_expiration,id_categorie
                FROM article as a, categorie as c WHERE a.id_categorie = c.id ";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
    
 }

 function getCategories($id=null) {
    if (!empty($id)) {
        $sql = "SELECT * FROM categorie WHERE id=?";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute([$id]);
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM categorie ";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
    
 }

 function getClient($id=null) {
    if (!empty($id)) {
        $sql = "SELECT * FROM client WHERE id=?";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute([$id]);
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM client ";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
    
 }

 function getFournisseur($id=null) {
    if (!empty($id)) {
        $sql = "SELECT * FROM fournisseur WHERE id=?";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute([$id]);
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM fournisseur ";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
    
 }

 function getVentes($id=null) {
    if (!empty($id)) {
        $sql = "SELECT v.id, nom_article, nom, prenom, v.quantite, prix, date_vente, prix_unitaire,adresse,telephone FROM client as c,vente as v, article as a 
                WHERE v.id_article = a.id AND v.id_client = c.id AND  v.id=? AND etat=?";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute([$id,1]);
        return $req->fetch();
    } else {
        $sql = "SELECT v.id, nom_article, nom, prenom, v.quantite, prix, date_vente, a.id as idArticle FROM client as c,vente as v, article as a 
                WHERE v.id_article = a.id AND v.id_client = c.id AND etat=?";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute([1]);
        return $req->fetchAll();
    }
    
 }

 function getCommandes($id=null) {
    if (!empty($id)) {
        $sql = "SELECT c.id, nom_article, nom, prenom, c.quantite, prix, date_commande, prix_unitaire,adresse,telephone 
                FROM fournisseur as f,commande as c, article as a 
                WHERE c.id_article = a.id AND c.id_fournisseur = f.id AND  c.id=? AND etat=?";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute([$id,1]);
        return $req->fetch();
    } else {
        $sql = "SELECT c.id, nom_article, nom, prenom, c.quantite, prix, date_commande, a.id as idArticle FROM fournisseur as f,commande as c, article as a 
                WHERE c.id_article = a.id AND c.id_fournisseur = f.id AND etat=?";
        $req = $GLOBALS["connexion"]->prepare($sql);
        $req->execute([1]);
        return $req->fetchAll();
    }
    
 }
 function getAllCommande(){
    $sql = "SELECT COUNT(*) as nbre FROM commande";
    $req = $GLOBALS["connexion"]->prepare($sql);
    $req->execute();
    return $req->fetch();
 }

  function getAllVente(){
    $sql = "SELECT COUNT(*) as nbre FROM vente WHERE etat =?";
    $req = $GLOBALS["connexion"]->prepare($sql);
    $req->execute([1]);
    return $req->fetch();
 }

  function getAllArticle(){
    $sql = "SELECT COUNT(*) as nbre FROM article";
    $req = $GLOBALS["connexion"]->prepare($sql);
    $req->execute();
    return $req->fetch();
 }

  function getCA(){
    $sql = "SELECT SUM(prix) as prix FROM vente";
    $req = $GLOBALS["connexion"]->prepare($sql);
    $req->execute();
    return $req->fetch();
 }

 function getLastVentes() {
    $sql = "SELECT v.id, nom_article, nom, prenom, v.quantite, prix, date_vente, a.id as idArticle FROM client as c,vente as v, article as a 
            WHERE v.id_article = a.id AND v.id_client = c.id AND etat=? 
            ORDER BY date_vente DESC LIMIT 10";
    $req = $GLOBALS["connexion"]->prepare($sql);
    $req->execute([1]);
    return $req->fetchAll();
}

function getMostVentes() {
    $sql = "SELECT nom_article, prix FROM client as c,vente as v, article as a 
            WHERE v.id_article = a.id AND v.id_client = c.id AND etat=?
            GROUP BY a.id 
            ORDER BY SUM(prix) DESC LIMIT 10";
    $req = $GLOBALS["connexion"]->prepare($sql);
    $req->execute([1]);
    return $req->fetchAll();
}
    

 ?>
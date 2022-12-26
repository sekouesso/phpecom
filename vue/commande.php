<?php include('entete.php');
session_start();
if(!empty($_GET["id"])){
    $article = getArticles($_GET["id"]);
    $client = getClient($_GET["id"]);
    $commande = getcommandes($_GET["id"]);
}else{
    $articles = getArticles();
    $clients = getClient();
    $commande = getcommandes();

}
?>
     <div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <form action="<?= !empty($_GET['id'])? "../models/modifCommande.php":"../models/ajoutCommande.php";?>" method="post">
                <input value="<?= !empty($_GET['id'])? $article["id"]:"";?>" type="hidden" name="id" id="id" >
                <label for="id_article">Article</label>
                <select onchange="setPrix()" name="id_article" id="id_article" >
                <?php 
                    $articles = getArticles();
                    if (!empty($articles) && is_array($articles)) {
                        foreach($articles as $ar) {
                            ?>
                            <option data-prix="<?= $ar['prix_unitaire'];?>" value="<?= $ar['id'];?>"> <?= $ar['nom_article'] . " - ". $ar['quantite']. " diponibles";?> </option>
                            <?php   
                        }
                    }

                ?>
                </select >

                <label for="id_fournisseur">Fournisseur</label>
                <select name="id_fournisseur" id="id_fournisseur" >
                <?php 
                    $fournisseurs = getFournisseur();
                    if (!empty($fournisseurs) && is_array($fournisseurs)) {
                        foreach($fournisseurs as $fournisseur) {
                            ?>
                            <option  value="<?= $fournisseur['id'];?>"> <?= $fournisseur['nom'] . " ". $fournisseur['prenom'];?> </option>
                            <?php   
                        }
                    }

                ?>
                </select >

                <label for="quantite">Quantite</label>
                <input onkeyup="setPrix()" value="<?= !empty($_GET['id'])? $article["quantite"]:"";?>" type="text" name="quantite" id="quantite" placeholder="Quantite">
                
                <label for="prix">Prix</label>
                <input  value="<?= !empty($_GET['id'])? $article["prix"]:"";?>" type="number" name="prix" id="prix" placeholder="prix">
                <button type="submit">valider</button>
                <?php 
                    if (!empty($_SESSION['message']['text'])) {
                ?>
                        <div class="alert <?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                        </div>
                <?php
                    }
                
                ?>
                </form>
            </div>
            <div class="box">
                <table class="mtable">
                    <tr>
                        <th>Article </th>
                        <th>Fournisseur</th>
                        <th>Quantite</th>
                        <th>Prix</th>
                        <th>Date </th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                     $commandes = getCommandes();
                    if (!empty($commandes) && is_array($commandes)) {
                        foreach ($commandes as $commande) {
                    ?>
                    <tr>
                        <td><?= $commande["nom_article"];?></td>
                        <td><?= $commande["nom"]." ".$commande["prenom"];?></td>
                        <td><?= $commande["quantite"];?></td>
                        <td><?= $commande["prix"];?></td>
                        <td><?= date('d/m/Y H:i:s', strtotime($commande["date_commande"]));?></td>
                        <td>
                            <a href="recuVente.php?id= <?= $commande["id"];?>"><i class="bx bx-receipt"></i></a>
                            <a onclick="annulerVente(<?= $commande['id'];?>,<?= $commande['idArticle'];?>,<?= $commande['quantite'];?>)" style="color: red;"><i class="bx bx-stop-circle"></i></a>
                        </td>
                    </tr>
                    <?php
                    }
                }
                ?>
                </table>
            </div>
        </div>
      </div>
</section>
<?php include('pied.php'); ?>

<script>
    function setPrix() {
        var article = document.querySelector("#id_article");
        var quantite = document.querySelector("#quantite");
        var prix = document.querySelector("#prix");
        var prixunitaire = article.options[article.selectedIndex].getAttribute("data-prix");
        prix.value = Number(quantite.value)*Number(prixunitaire);
    }
   function annulerVente(idCommande,idArticle,quantite){
        if(confirm("Voulez-vous vraiment annuler cette co$commande?")){
            window.location.href = "../models/annulerVente.php?idVente="+idCommande+"&idArticle="+idArticle+"&quantite="+quantite
        }
    }
</script>
<?php include('entete.php');
session_start();
if(!empty($_GET["id"])){
    $article = getArticles($_GET["id"]);
    $client = getClient($_GET["id"]);
    $vente = getVentes($_GET["id"]);
}else{
    $articles = getArticles();
    $clients = getClient();
    $vente = getVentes();

}
?>
     <div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <form action="<?= !empty($_GET['id'])? "../models/modifVente.php":"../models/ajoutVente.php";?>" method="post">
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

                <label for="id_client">Client</label>
                <select name="id_client" id="id_client" >
                <?php 
                    $clients = getClient();
                    if (!empty($clients) && is_array($clients)) {
                        foreach($clients as $client) {
                            ?>
                            <option  value="<?= $client['id'];?>"> <?= $client['nom'] . " ". $client['prenom'];?> </option>
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
                        <th>Client</th>
                        <th>Quantite</th>
                        <th>Prix</th>
                        <th>Date </th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                     $ventes = getVentes();
                    if (!empty($ventes) && is_array($ventes)) {
                        foreach ($ventes as $vente) {
                    ?>
                    <tr>
                        <td><?= $vente["nom_article"];?></td>
                        <td><?= $vente["nom"]." ".$vente["prenom"];?></td>
                        <td><?= $vente["quantite"];?></td>
                        <td><?= $vente["prix"];?></td>
                        <td><?= date('d/m/Y H:i:s', strtotime($vente["date_vente"]));?></td>
                        <td>
                            <a href="recuVente.php?id= <?= $vente["id"];?>"><i class="bx bx-receipt"></i></a>
                            <a onclick="annulerVente(<?= $vente['id'];?>,<?= $vente['idArticle'];?>,<?= $vente['quantite'];?>)" style="color: red;"><i class="bx bx-stop-circle"></i></a>
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
   function annulerVente(idVente,idArticle,quantite){
        if(confirm("Voulez-vous vraiment annuler cette vente?")){
            window.location.href = "../models/annulerVente.php?idVente="+idVente+"&idArticle="+idArticle+"&quantite="+quantite
        }
    }
</script>
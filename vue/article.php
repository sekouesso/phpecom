<?php include('entete.php');
session_start();
if(!empty($_GET["id"])){
    $article = getArticles($_GET["id"]);
}else{
    $articles = getArticles();
}
?>
     <div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <form action="<?= !empty($_GET['id'])? "../models/modifArticle.php":"../models/ajoutArticle.php";?>" method="post">
                <label for="nom_article">Nom article</label>
                <input value="<?= !empty($_GET['id'])? $article["nom_article"]:"";?>" type="text" name="nom_article" id="nom_article" placeholder="nom de l'article">
                <input value="<?= !empty($_GET['id'])? $article["id"]:"";?>" type="hidden" name="id" id="id" >
                <label for="id_categorie">Categorie</label>
                <select name="id_categorie" id="id_categorie" >
                    <?php
                    $categories = getCategories();
                    foreach ($categories as $cat){

                    ?>
                         <option <?= !empty($_GET['id']) && $article["id_categorie"]== $cat['id']? "selected":"";?> value="<?= $cat['id'] ?>"> <?= $cat['libelle'] ?></option>
                    <?php
                    }
                    ?>
                </select >
                <label for="quantite">Quantite</label>
                <input value="<?= !empty($_GET['id'])? $article["quantite"]:"";?>" type="text" name="quantite" id="quantite" placeholder="Quantite">
                <label for="prix_unitaire">Prix unitaire</label>
                <input value="<?= !empty($_GET['id'])? $article["prix_unitaire"]:"";?>" type="number" name="prix_unitaire" id="prix_unitaire" placeholder="prix_unitaire">
                <label for="date_fabrication">date de fabrication</label>
                <input value="<?= !empty($_GET['id'])? $article["date_fabrication"]:"";?>" type="datetime-local" name="date_fabrication" id="date_fabrication" >
                <label for="date_expiration">date d'expiration</label>
                <input value="<?= !empty($_GET['id'])? $article["date_expiration"]:"";?>" type="datetime-local" name="date_expiration" id="date_expiration" >
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
                        <th>Nom article</th>
                        <th>Categorie</th>
                        <th>Prix unitaire</th>
                        <th>Quantite</th>
                        <th>Date de fabrication</th>
                        <th>Date d'expiration</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                     $articles = getArticles();
                    if (!empty($articles) && is_array($articles)) {
                        foreach ($articles as $art) {
                    ?>
                    <tr>
                        <td><?= $art["nom_article"];?></td>
                        <td><?= $art["libelle"];?></td>
                        <td><?= $art["prix_unitaire"];?></td>
                        <td><?= $art["quantite"];?></td>
                        <td><?= date('d/m/Y H:i:s', strtotime($art["date_fabrication"]));?></td>
                        <td><?= date('d/m/Y H:i:s', strtotime($art["date_expiration"]));?></td>
                        <td>
                            <a href="?id= <?= $art["id"];?>"><i class="bx bx-edit-alt"></i></a>
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
<?php include('entete.php');
session_start();
if(!empty($_GET["id"])){
    $categorie = getCategories($_GET["id"]);
}else{
    $Categories = getCategories();
}
?>
     <div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <form action="<?= !empty($_GET['id'])? "../models/modifCategorie.php":"../models/ajoutCategorie.php";?>" method="post">
                <label for="libelle">Nom categorie</label>
                <input value="<?= !empty($_GET['id'])? $categorie["libelle"]:"";?>" type="text" name="libelle" id="libelle" placeholder="libelle de la categorie">
                <input value="<?= !empty($_GET['id'])? $categorie["id"]:"";?>" type="hidden" name="id" id="id" >
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
                        <th>Libelle </th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                     $categories = getCategories();
                    if (!empty($categories) && is_array($categories)) {
                        foreach ($categories as $cat) {
                    ?>
                    <tr>
                        <td><?= $cat["libelle"];?></td>
                        <td>
                            <a href="?id= <?= $cat["id"];?>"><i class="bx bx-edit-alt"></i></a>
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
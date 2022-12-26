<?php include('entete.php');
session_start();
if(!empty($_GET["id"])){
    $fournisseur = getFournisseur($_GET["id"]);
}else{
    $fournisseurs = getFournisseur();
}
?>
     <div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <form action="<?= !empty($_GET['id'])? "../models/modifFournisseur.php":"../models/ajoutFournisseur.php";?>" method="post">
                <label for="nom">Nom </label>
                <input value="<?= !empty($_GET['id'])? $fournisseur["nom"]:"";?>" type="text" name="nom" id="nom" placeholder="nom du fournisseur">
                <input value="<?= !empty($_GET['id'])? $fournisseur["id"]:"";?>" type="hidden" name="id" id="id" >
                <label for="prenom">Prenom </label>
                <input value="<?= !empty($_GET['id'])? $fournisseur["prenom"]:"";?>" type="text" name="prenom" id="prenom" placeholder="prenom du fournisseur">
                <label for="telephone">Telephone </label>
                <input value="<?= !empty($_GET['id'])? $fournisseur["telephone"]:"";?>" type="text" name="telephone" id="telephone" placeholder="telephone du fournisseur">
                <label for="adresse">Adresse </label>
                <input value="<?= !empty($_GET['id'])? $fournisseur["adresse"]:"";?>" type="text" name="adresse" id="adresse" placeholder="adresse du fournisseur">
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
                        <th>Nom fournisseur</th>
                        <th>Prenom</th>
                        <th>Telephone</th>
                        <th>Adresse</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                     $fournisseurs = getFournisseur();
                    if (!empty($fournisseurs) && is_array($fournisseurs)) {
                        foreach ($fournisseurs as $cli) {
                    ?>
                    <tr>
                        <td><?= $cli["nom"];?></td>
                        <td><?= $cli["prenom"];?></td>
                        <td><?= $cli["telephone"];?></td>
                        <td><?= $cli["adresse"];?></td>
                        <td>
                            <a href="?id= <?= $cli["id"];?>"><i class="bx bx-edit-alt"></i></a>
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
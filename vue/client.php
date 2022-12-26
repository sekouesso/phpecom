<?php include('entete.php');
session_start();
if(!empty($_GET["id"])){
    $client = getClient($_GET["id"]);
}else{
    $clients = getClient();
}
?>
     <div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <form action="<?= !empty($_GET['id'])? "../models/modifClient.php":"../models/ajoutClient.php";?>" method="post">
                <label for="nom">Nom </label>
                <input value="<?= !empty($_GET['id'])? $client["nom"]:"";?>" type="text" name="nom" id="nom" placeholder="nom du client">
                <input value="<?= !empty($_GET['id'])? $client["id"]:"";?>" type="hidden" name="id" id="id" >
                <label for="prenom">Prenom </label>
                <input value="<?= !empty($_GET['id'])? $client["prenom"]:"";?>" type="text" name="prenom" id="prenom" placeholder="prenom du client">
                <label for="telephone">Telephone </label>
                <input value="<?= !empty($_GET['id'])? $client["telephone"]:"";?>" type="text" name="telephone" id="telephone" placeholder="telephone du client">
                <label for="adresse">Adresse </label>
                <input value="<?= !empty($_GET['id'])? $client["adresse"]:"";?>" type="text" name="adresse" id="adresse" placeholder="adresse du client">
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
                        <th>Nom client</th>
                        <th>Prenom</th>
                        <th>Telephone</th>
                        <th>Adresse</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                     $clients = getClient();
                    if (!empty($clients) && is_array($clients)) {
                        foreach ($clients as $cli) {
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
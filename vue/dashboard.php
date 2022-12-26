<?php include('entete.php'); ?>
<div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Commande</div>
              <div class="number"><?= getAllCommande()["nbre"];?></div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Depuis hier</span>
              </div>
            </div>
            <i class="bx bx-cart-alt cart"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Vente</div>
              <div class="number"><?= getAllVente()["nbre"];?></div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Depuis hier</span>
              </div>
            </div>
            <i class="bx bxs-cart-add cart two"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Article</div>
              <div class="number"><?= getAllArticle()["nbre"];?></div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Depuis hier</span>
              </div>
            </div>
            <i class="bx bx-cart cart three"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">CA</div>
              <div class="number"><?= number_format(getCA()["prix"],0,"."," ");?></div>
              <div class="indicator">
                <i class="bx bx-down-arrow-alt down"></i>
                <span class="text">Aujourd'hui</span>
              </div>
            </div>
            <i class="bx bxs-cart-download cart four"></i>
          </div>
        </div>

        <div class="sales-boxes">
          <div class="recent-sales box">
            <div class="title">Vente recentes</div>
            <?php $ventes = getLastVentes();?>
            <div class="sales-details">
              <ul class="details">
                <li class="topic">Date</li>
                <?php
                  foreach($ventes as $vente){
                ?>
                <li><a href="#"><?= date('d/m/Y H:i:s', strtotime($vente["date_vente"]));?></a></li>
                <?php 
              }
              ?>
              </ul>
              <ul class="details">
                <li class="topic">Client</li>
                <?php
                  foreach($ventes as $vente){
                ?>
                <li><a href="#"><?= $vente["nom"]." ".$vente["prenom"];?></a></li>
                <?php 
              }
              ?>
                
              </ul>
              <ul class="details">
                <li class="topic">Article</li>
                <?php
                  foreach($ventes as $vente){
                ?>
                <li><a href="#"><?= $vente["nom_article"];?></a></li>
                <?php 
              }
              ?>
              </ul>
              <ul class="details">
                <li class="topic">Prix</li>
                <?php
                  foreach($ventes as $vente){
                ?>
                <li><a href="#"><?= number_format($vente["prix"],0,"."," ");?></a></li>
                <?php 
              }
              ?>
              </ul>
            </div>
            <div class="button">
              <a href="#">Voir Tout</a>
            </div>
          </div>
          <div class="top-sales box">
            <div class="title">Article le plus vendu</div>
            <ul class="top-sales-details">
            <?php $articles = getMostVentes();?>
            <?php
                foreach($ventes as $vente){
            ?>
              <li>
              <a href="#">
                <!--<img src="images/sunglasses.jpg" alt="">-->
                <span class="product"><?= $vente["nom_article"];?></span>
              </a>
                <span class="price"><?= $vente["prix"];?> F</span>
              </li>
            <?php 
                }
            ?>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <?php include('pied.php'); ?>
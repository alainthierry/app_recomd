<?php $data = $patient->fetch(PDO::FETCH_ASSOC); ?>

<style type="text/css">
    * {
        font-family: serif;
    }
     #image_pat img {

        width: 130px;
        height: 125px;
        border: 1px solid sienna;
        border-radius: 70%;
    }

    .identite, .justify-content{
        box-shadow: 0px 0px 3px 0px;
        background-color: #fff;
        border-radius: 3px;
    }


</style>

<div class="row identite" style="display: flex; flex-direction: column;">
    <div class="text-center">
        <h4>Rendez-vous de</h4>
    </div>
    
    <div id="image_pat" class="text-center">
        <?php
        if ($data['url'] === '') 
        {
        ?>
        <img src="./public/images/patient.jpg" alt="Photo d'identité">
        <?php 
        }
        else
        {
        ?>
        <img src="./public/images/<?=$data['url'];?>" alt="Photo d'identité">
        <?php
        }
        ?>
    </div>
    <div class="text-center">
        <p style="font-family: serif;font-size: 1em;">
            <?=$data['nom_pat'];?> <?=$data['pre_pat'];?>,habitant à <?=$data['ville_pat'];?>, <?="<br>".$data['ad_pat'];?>, Cordonnées<br>(Tel : <?=$data['tel_pat'];?> et <a href="mailto:<?=$data['email_pat'];?>">email </a>)
        </p>
    </div>
</div>

<?php  $patient->closeCursor(); ?> 

<!-- #0275d8 -->
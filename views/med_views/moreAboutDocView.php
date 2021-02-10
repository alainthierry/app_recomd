<!-- View when patient click on more about doctor -->
<?php  $data = $medecin->fetch(PDO::FETCH_ASSOC); //var_dump($data);?>

<div class="col identite">
    <p id="image_med">
        <?php
		if ($data['url'] === '' || $data['url'] === '0') 
		{
		?>
        <img class="identite" src="./public/images/medecin.png" alt="Photo d'identité">
        <?php 
		}
		else
		{
		?>
        <img class="identite" src="./public/images/<?=$data['url'];?>" alt="Photo d'identité">
        <?php
		}
		?>
    </p>
    <p>
        Dr <?=$data['n_med'];?> <?=$data['pre_med'];?>, spécialiste en <?=$data['spe_med'];?> Travaillant au <?=$data['ste_med'];?>, <?=$data['ad_med'] ;?>
        Cordonnées (Tel : <?=$data['tel_med'];?> et <a href="mailto:<?=$data['email_med'];?>">email </a>)
    </p>
</div>

<?php  $medecin->closeCursor(); ?>

<style type="text/css" media="screen">

    #image_med img {

        width: 130px;
        height: 125px;
        border: 1px solid sienna;
        border-radius: 70%;
    }
    .identite {
        box-shadow: 0px 0px 3px 0px;
        background-color: #fff;
        border-radius: 3px;
        padding: 10px;
        font-family: serif;
        font-size: 1.1em;
    }
    
</style>
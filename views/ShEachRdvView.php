<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous du <?= date('d-m-Y', strtotime($_GET['rdv_d'])); ?> à <?= date('H:i', strtotime($_GET['rdv_h']));?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <!-- StartMain block -->

    <div class="container main_block">
        
        <!-- Header -->
        <?php require_once('headerViewApart.php'); ?>
        <!-- Header -->

        <!-- Start Row -->
        <div class="row justify-content-center mt-5">

            <div class="col-md-4 col-lg-5 col-sm-5 rounded border rdv_container">
                <p>Rendez-vous pour <?= lcfirst($_GET['motf']); ?>, pris le <?= date('d-m-Y', strtotime($_GET['priseDate'])); ?> pour le <?= date('d-m-Y', strtotime($_GET['rdv_d'])); ?> à <?= date('H:i', strtotime($_GET['rdv_h']));?>
                    <em class="text-center">avec le Docteur</em>
                </p>
                <div class="float-left m-4">
                    <?php 
                    if ($data['url'] === "")
                    {
                    ?><img src="./public/images/medecin.png" class="rounded-circle">
                    <?php 
                    }
                    else
                    {
                    ?>
                    <img src="./public/images/<?=$data['url'];?>" class="rounded-circle">
                    <?php
                    }
                    ?>
                </div>
                <div class="col">
                    <p><?= "Dr ".$data['n_med'].' '.$data['pre_med'];?></p>
                    <p><?=' Exerçant au centre de santé<br>'.$data['ste_med'].'<br>et spécialiste en '.$data['spe_med'];?>.<br>
                        Téléphone : <strong><?= $data['tel_med']; ?></strong></p>
                    <a id="mailtoDoc" href="mailto:<?=$data['email_med'] ;?>">Courier éléctronique(email)</a>
                    <p><em><?= $data['ad_med']; ?></em></p>
                </div>

            </div>


        </div>
        <!-- Start Row -->

    </div>
    <!-- EndMain block -->

    <style type="text/css">
        .container {
            background-image: url('public/images/l.png');
            /*background-repeat: none;*/
            background-size: cover;
            color: black;
            font-weight: bold;
            font-family: serif;
        }

        .rdv_container {
            margin-top: 15px;
            font-size: 1.2em;
        }

        img {
            width: 140px;
            height: 150px;
            background-color: #fff0;
            box-shadow: 0px 0px 5px 0px;
            margin-bottom: 10px;
            border: 1px solid white !important;
        }

        a:hover {
            text-decoration: none;
            color: red;
        }

        #mailtoDoc:hover {
            color: sienna !important;
        }
    </style>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
<?php $data = $patient->fetch(PDO::FETCH_ASSOC); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Social buttons -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <!-- Parsley CSS -->
    <link rel="stylesheet" type="text/css" href="https://parsleyjs.org/src/parsley.css">

    <title><?="Rendez-vous de ".$data['nom_pat']."_".$data['pre_pat'];?></title>
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
           /* padding: 10px;*/
            font-family: serif;
        }
        .justify-content label {
            font-size: 1.2em;
        }
    </style>
</head>

<body>

    <!-- Container -->
    <div class="container">

        <?php require_once('views/headerView.php'); ?>
        <!-- /header -->

        <!-- Row -->
        <div class="row justify-content-center ml-3">

            <div class="row mr-3 w-50 identite" style="display: flex; flex-direction: column;">
                <div class="text-center">
                    <h4><?="Rendez-vous de ".$data['nom_pat']." ".$data['pre_pat'];?></h4>
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
                    <p style="font-family: serif;font-size: 1.3em;">
                        <?=$data['nom_pat'];?> <?=$data['pre_pat'];?>,habitant à <?=$data['ville_pat'];?>, <?="<br>".$data['ad_pat'];?>, Cordonnées<br>(Tel : <?=$data['tel_pat'];?> et <a href="mailto:<?=$data['email_pat'];?>">email </a>)
                    </p>
                </div>
            </div>

            <?php  $patient->closeCursor(); ?> 

            <div class="row w-50">
                <!-- <div class="col-sm-8 col-md-8 col-lg-6"> -->
                <form class="justify-content p-2" id="validate_form" action="index.php?action=add_consul" method="POST">

                    <div class="form-group">
                        <h2 class="text-center">Ajouter les informations de la<br>consultation relatives à ce rendez-vous</h2>
                    </div>

                    <div class="hidden">
                        <input type="hidden" name="user_pat_id" value="<?=$_GET['user_pat_id'];?>">
                        <input type="hidden" name="user_med_id" value="<?=$_GET['user_med_id'];?>">
                        <input type="hidden" name="rdv_id" value="<?=$_GET['rdv_id'];?>">
                    </div>

                    <div class="form-group">
                        <label for="date_consul">date de la consultation</label>
                        <input min="2020-1-1" max="2070-12-12" type="date" required="" name="date_consul" class="form-control"data-parsley-trigger="keyup">
                    </div>

                    <div class="form-group">
                        <label for="motif_consul">Motif de la consultation</label>
                        <textarea name="motif_consul" required="" class="form-control" data-parsley-trigger="keyup"></textarea>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary float-right" type="submit" name="submit" value="AJOUTER">
                    </div>
                   
                </form>

            </div> 

        </div>
        <!-- Row -->

    </div>
    <!-- Container -->


    <!-- first, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!-- Parsley -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://parsleyjs.org/dist/parsley.min.js" type="text/javascript" charset="utf-8"></script>


    <script type="text/javascript" charset="utf-8" async defer>

        $(document).ready(() => {

            // Validation errors messages for Parsley
            Parsley.addMessages('fr', {
                defaultMessage: "Cette valeur semble non valide.",
                type: {
                    email: "Cette valeur n'est pas une adresse email valide.",
                    url: "Cette valeur n'est pas une URL valide.",
                    number: "Cette valeur doit être un nombre.",
                    integer: "Cette valeur doit être un entier.",
                    digits: "Cette valeur doit être numérique.",
                    alphanum: "Cette valeur doit être alphanumérique."
                },
                notblank: "Cette valeur ne peut pas être vide.",
                required: "Ce champ est requis.",
                pattern: "Cette valeur semble non valide.",
                min: "Cette valeur ne doit pas être inférieure à %s.",
                max: "Cette valeur ne doit pas excéder %s.",
                range: "Cette valeur doit être comprise entre %s et %s.",
                minlength: "Cette chaîne est trop courte. Elle doit avoir au minimum %s caractères.",
                maxlength: "Cette chaîne est trop longue. Elle doit avoir au maximum %s caractères.",
                length: "Cette valeur doit contenir entre %s et %s caractères.",
                mincheck: "Vous devez sélectionner au moins %s choix.",
                maxcheck: "Vous devez sélectionner %s choix maximum.",
                check: "Vous devez sélectionner entre %s et %s choix.",
                equalto: "Cette valeur devrait être identique.",

                // Others
                dateiso: "Cette valeur n'est pas une date valide (YYYY-MM-DD).",
                minwords: "Cette valeur est trop courte. Elle doit contenir au moins %s mots.",
                maxwords: "Cette valeur est trop longue. Elle doit contenir tout au plus %s mots.",
                words: "Cette valeur est invalide. Elle doit contenir entre %s et %s mots.",
                gt: "Cette valeur doit être plus grande.",
                gte: "Cette valeur doit être plus grande ou égale.",
                lt: "Cette valeur doit être plus petite.",
                lte: "Cette valeur doit être plus petite ou égale.",
                notequalto: "Cette valeur doit être différente."
            });
            Parsley.setLocale('fr');

            /* Initialization */
            $('#validate_form').parsley();
        });

    </script>

</body>

</html>
<!-- #0275d8 -->
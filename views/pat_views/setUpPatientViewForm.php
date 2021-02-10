<?php
	$data = $patient->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Mise à jour mon Compte</title>
</head>

<body>
    <!-- StartMain block -->
    <div class="container rounded">

        <?php require_once('views/headerViewApart.php'); ?>

        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-8 col-lg-6 main">

                <form method="POST" action="index.php?action=set_up_pat_cf"name="fieldData" class="pb-1">

                    <!-- First Part -->
                    <div class="col" id="stageOne">

                        <div class="col">
                            <h2 class="text-center">Mettre à jour mon Compte</h2>
                        </div>
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" value="<?=$data['nom_pat'];?>" name="nomPatient" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Prénom</label>
                            <input type="textarea" value="<?=$data['pre_pat'];?>" name="prenomPatient" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>date de naissance</label>
                            <input type="date" value="<?=$data['date_pat'];?>" name="dateNaissanceP" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Téléphone</label>
                            <input type="tel" value="<?=$data['tel_pat'];?>" name="telephonePatient" class="form-control">
                        </div>

                        <div class="form-group justify-content-center row">
                            <button type="button" class="btn btn-primary btn-block text-center w-50" onclick="nextStage();">SUIVANT</button>
                        </div>
                    </div>
                    <!-- Last Part -->
                    <div class="col" id="stageTwo">
                        <div class="col">
                            <h2 class="text-center">Poursuivre la mise à jour</h2>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" value="<?=$data['email_pat'];?>" name="emailPatient" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Adresse</label>
                            <textarea name="adressePatient" class="form-control"><?=$data['ad_pat'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Ville</label>
                            <input type="textarea" value="<?=$data['ville_pat'];?>" name="villePatient" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nom d'utilisateur</label>
                            <input type="text" value="<?=$data['login_pat'];?>"name="loginPatient" class="form-control">
                            <input type="hidden" name="idPatient" value="<?=$_GET['up_pat'];?>">
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <button type="button" class="btn btn-block btn-primary" onclick="prevStage()">PRECEDENT</button>
                            </div>
                            <div class="col">
                                <input type="submit" name="soumission" value="METTRE A JOUR" class="btn btn-primary btn-block">
                            </div>
                        </div>
                    </div>

                </form>
                <?php $patient->closeCursor(); ?>
            </div>
        </div>

    </div>
    <!-- EndMain block -->


    <style type="text/css">
        #stageTwo {
            display: none;
        }

        form {
            border-radius: 5px;
            box-shadow: 0px 0px 5px 0px;
            background-color: #fff;
        }

        input,
        button {
            border-radius: 3px;
        }

        a {
            color: #292b2c;
        }

        .container {
            background-color: #fff;
            box-shadow: 0px 0px 5px 0px;
            font-family: serif;
        }

        .main {
            font-style: 1.2em;
        }
        .main label, .main input {
            font-size: 1.1em;
            font-weight: bold;
        }

    </style>

    <!-- JQuery, Propper, Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <!-- JS -->
    <script type="text/javascript">
        /**
         * @Displaying next stage of form
         */
        const nextStage = () => {

            document.getElementById('stageOne').style.display = 'none';
            document.getElementById('stageTwo').style.display = 'block';
        }

        /**
         * @brief Dispaly the previous stage
         */
        const prevStage = () => {
            document.getElementById('stageOne').style.display = 'block';
            document.getElementById('stageTwo').style.display = 'none';
        }

    </script>
</body>

</html>

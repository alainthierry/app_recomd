<?php

$data = $medecin->fetch(PDO::FETCH_ASSOC);

/*
Array ( [n_med] => MANZI [pre_med] => Alain [email_med] => thierry.iliho@um6p.ma [tel_med] => 2120650038174 [ste_med] => Health-Center Um6p [ad_med] => 66 Lot Moulay Rachid, Benguérir(Maroc) [spe_med] => Médecine interne [url] => 1600733172.jpeg [lang_med] => Anglais [date_med] => 5152-02-12 [ville_med] => Ville Verte [log_med] => Manzi )
 */

?>
<!DOCTYPE html>
<html>

<head>
    <title>Mettre à jour mon Compte</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" type="text/css" href="public/styles/signup_styles.css">
  <script type="text/javascript" src="public/js/signup_js.js"></script> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <!--Container-->

    <div class="container fluid rounded">

        <?php require_once('views/headerViewApart.php'); ?>

        <div class="row justify-content-center main">
            <div class="col-sm-8 col-md-8 col-lg-6">
                <form method="POST" action="index.php?action=set_up_med_cf" name="fielData" class="pb-1">

                    <!-- First Part -->

                    <div class="col" id="stageOne">
                        <div class="form-group justify-content-center">
                            <h2 class="text-center">Mettre à jour mon Compte</h2>
                        </div>

                        <div class="form-group">
                            <label for="nom_med">Nom</label>
                            <input type="text" value="<?=$data['n_med'];?>" name="nom_med" class="form-control">
                            <input type="hidden" name="med_up_cf" value="<?=$idMedecin;?>">
                        </div>

                        <div class="form-group">
                            <label for="prenom_medecin">Prénom </label>
                            <input type="text" value = "<?=$data['pre_med'];?>" name="prenom_medecin" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="langue">Langue parlée </label>
                            <input type="text"  value="<?=$data['lang_med'];?>" name="langue" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="date_medecin">Date de naissance </label>
                            <input type="date"  value="<?=$data['date_med'];?>" name="date_medecin" class="form-control">
                        </div>

                        <div class="form-group justify-content-center row">
                            <button type="button" id="nextBtn1" onclick="next_btn1()" class="btn btn-primary btn-block w-50">SUIVANT</button>
                        </div>
                    </div>

                    <!-- Second Part -->

                    <div class="col" id="stageTwo">

                        <div class="form-group justify-content-center">
                            <h2 class="text-center">Poursuivre la mise à jour</h2>
                        </div>
                        
                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input type="tel" value = "<?=$data['tel_med'];?>"name="telephone" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="adresse_med">Adresse </label>
                            <textarea name="adresse_med" class="form-control"><?=$data['ad_med'];?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="ville_medecin">Ville</label>
                            <input type="text"  value="<?=$data['ville_med'];?>" name="ville_medecin" class="form-control">
                        </div>

                         <div class="form-group">
                            <label for="user_medecin">Nom d'utilisateur </label>
                            <input class="form-control"  value="<?=$data['log_med'];?>" type="text" name="user_medecin">
                        </div>

                        <div class="form-group justify-content-center row">
                            <div class="col">
                                <button type="button" id="prevBtn1" onclick="prev_btn1()" class="btn btn-primary btn-block">PRECEDENT</button>
                            </div>
                            <div class="col">
                                <button type="button" id="nextBtn2" onclick="next_btn2()" class="btn-block btn btn-primary">SUIVANT</button>
                            </div>
                        </div>

                    </div>

                    <!-- Third Part -->

                    <div class="col" id="stageThree">
                        <div class="form-group justify-content-center">
                            <h2 class="text-center">Poursuivre la mise à jour</h2>
                        </div>
                        <div class="form-group">
                            <label for="email_medecin">Email </label>
                            <input type="email" value = "<?=$data['email_med'];?>"name="email_medecin" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="centre_sante">Centre de santé</label>
                            <textarea name="centre_sante" class="form-control"><?=$data['ste_med'];?></textarea>
                        </div>
                        
                       
                        <div class="form-group justify-content-center row">
                            <div class="col">
                                <button type="button" id="prevBtn2" onclick="prev_btn2()" class="btn btn-primary btn-block">PRECEDENT</button>
                            </div>

                            <div class="col">
                                <input type="submit" class="btn btn-block btn-primary" value="METTRE A JOUR" id="last_btn">
                            </div>
                           
                        </div>
                    </div>

                </form>
            </div>

        </div>
        <!-- End row -->

    </div>
    <!-- End container -->

    <!-- Syles -->
    <style type="text/css">
        
        /* Stages of doctor sign up */
        #stageTwo,
        #stageThree,
        #stageFour {
            display: none;
            width: 100%;
        }

        button,
        #submit,
        #last_btn {
            border-radius: 7px;
        }

        body {
            font-size: 1.2em;
            font-family: serif;
        }

        form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 5px 0px;
            margin-top: 0px;
        }

        #containers {
            display: flex;
            flex-direction: column;
        }

        .main {
            margin-top: 0px;
        }

        .fluid {
            background-color: #fff;
            box-shadow: 0px 0px 5px 0px;
        }

    </style>
    <script type="text/javascript">
        /*
         *For new entry for experience textarea
         */
        let nb_expr = 2;
        let addTextArea = () => {
            console.log(nb_expr);
            new_expr = document.createElement('textarea');
            new_expr.setAttribute("name", "expr" + nb_expr);
            new_expr.setAttribute("class", "form-control");

            document.getElementById('containers').appendChild(new_expr);
            document.getElementById('hidden').value = nb_expr;
            nb_expr++;

        }

        /*
         * Swith btw tab entries
         */
        let next_btn1 = () => {
            document.getElementById('stageOne').style.display = 'none';
            document.getElementById('stageTwo').style.display = 'block';
        }

        let prev_btn1 = () => {
            document.getElementById('stageOne').style.display = 'block';
            document.getElementById('stageTwo').style.display = 'none';
        }

        let next_btn2 = () => {
            document.getElementById('stageTwo').style.display = 'none';
            document.getElementById('stageThree').style.display = 'block';
        }

        let prev_btn2 = () => {
            document.getElementById('stageTwo').style.display = 'block';
            document.getElementById('stageThree').style.display = 'none';
        }

        // let next_btn3 = () => {
        //     document.getElementById('stageThree').style.display = 'none';
        //     document.getElementById('stageFour').style.display = 'block';
        // }

        // let prev_btn3 = () => {
        //     //console.log('Ici');
        //     document.getElementById('stageThree').style.display = 'block';
        //     document.getElementById('stageFour').style.display = 'none';
        // }

    </script>

</body>

</html>

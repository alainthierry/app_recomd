<!DOCTYPE html>
<html>

<head>
    <title>Compte Médecin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Parsley CSS -->
    <link rel="stylesheet" type="text/css" href="https://parsleyjs.org/src/parsley.css">

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

</head>

<body>

    <!--Container-->

    <div class="container fluid rounded">

        <?php require_once('headerViewApart.php'); ?>

        <div class="row justify-content-center main">
            <div class="col-sm-8 col-md-8 col-lg-6">
                <form class="pb-1 mb-4" id="validate_form" action="index.php?action=add_medecin" method="POST">
                    <!-- First Part -->

                    <div class="col" id="stageOne">
                        <div class="form-group justify-content-center">
                            <h2 class="text-center">Créer mon compte Médecin</h2>
                            <?php
                            if (isset($_GET['not']) && !empty($_GET['not']))
                            {
                                if ($_GET['not'] == 1)
                                {
                                    echo "<p class='text-center text-danger'><em>Navré, votre compte n'a pas été créé. Veuillez réessayer plus tard !</em></p>";
                                }
                            }
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="nom_med">Nom</label>
                            <input type="text" required="" name="nom_med" class="form-control" data-parsley-pattern="^[a-zA-Z]+[^.]*[a-zA-Z]+[^.]?$" data-parsley-trigger="keyup">
                        </div>

                        <div class="form-group">
                            <label for="prenom_medecin">Prénom </label>
                            <input required="" type="text" name="prenom_medecin" class="form-control" data-parsley-pattern="^[a-zA-Z]+[^.]*[a-zA-Z]+[^.]?$" data-parsley-trigger="keyup">
                        </div>

                        <div class="form-group">
                            <label for="langue">Langue parlée </label>
                            <input required="" type="text" data-parsley-pattern="^[a-zA-Z]+[^.]+[a-zA-Z]+$" data-parsley-trigger="keyup" name="langue" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="date_medecin">Date de naissance </label>
                            <input required="" data-parsley-trigger="keyup" min="1926-01-01" max="1993-12-31" type="date" name="date_medecin" class="form-control">
                        </div>

                        <div class="form-group justify-content-center row">
                            <button type="button" id="nextBtn1" onclick="next_btn1()" class="btn btn-primary btn-block w-50">SUIVANT</button>
                        </div>
                    </div>

                    <!-- Second Part -->

                    <div class="col" id="stageTwo">

                        <div class="form-group justify-content-center">
                            <h2 class="text-center">Continuez mon inscription</h2>
                        </div>
                        <div class="form-group">
                            <label for="email_medecin">Email </label>
                            <input required="" type="email" data-parsley-type="email" data-parsley-trigger="keyup" name="email_medecin" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input required="" type="tel" data-parsley-pattern="^[0-9]+$" data-parsley-type="number" data-parsley-trigger="keyup" name="telephone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="adresse_med">Adresse </label>
                            <textarea required="" name="adresse_med" data-parsley-pattern="^[a-zA-Z0-9]+[^.]*[a-zA-Z0-9]+[^.]?$" data-parsley-trigger="keyup" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="lat_medecin">Ma latitude</label>
                            <input required="" step="any" data-parsley-trigger="keyup" type="number" name="lat_medecin" class="form-control">
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
                            <h2 class="text-center">Continuez mon inscription</h2>
                        </div>

                        <div class="form-group">
                            <label for="long_medecin">Ma longitude</label>
                            <input required="" step="any" data-parsley-trigger="keyup" type="number" name="long_medecin" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="ville_medecin">Ville</label>
                            <input required="" type="text" data-parsley-pattern="^[a-zA-Z0-9]+[^.]*[a-zA-Z0-9]+[^.]?$" data-parsley-trigger="keyup" name="ville_medecin" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user_medecin">Nom d'utilisateur </label>
                            <input required="" data-parsley-pattern="^[a-zA-Z0-9]+[^.]?[a-zA-Z0-9]+$" data-parsley-trigger="keyup" class="form-control" type="text" name="user_medecin">
                        </div>
                        <div class="form-group">
                            <label for="pass_medecin">Mot de passe </label>
                            <input required="" data-parsley-length="[4, 16]" data-parsley-trigger="keyup" type="password" id="pass_medecin" name="pass_medecin" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="cfpass_medecin">Confirmation du mot de passe </label>
                            <input required="" data-parsley-equalto="#pass_medecin" data-parsley-trigger="keyup" type="password" name="cfpass_medecin" class="form-control">
                        </div>

                        <div class="form-group justify-content-center row">
                            <div class="col">
                                <button type="button" id="prevBtn2" onclick="prev_btn2()" class="btn btn-primary btn-block">PRECEDENT</button>
                            </div>
                            <div class="col">
                                <button type="button" id="nextBtn3" onclick="next_btn3()" class=" btn btn-primary btn-block">SUIVANT</button>
                            </div>
                        </div>
                    </div>

                    <!-- Last Part -->

                    <div class="col" id="stageFour">
                        <div class="form-group justify-content-center">
                            <h2 class="text-center">Terminez mon inscription</h2>
                        </div>
                        <div class="form-group">
                            <label for="centre_sante">Centre de santé</label>
                            <textarea required="" name="centre_sante" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Spécialité</label>
                            <select required name="specialite" class="form-control">
                                <option value="0">Choisir ici</option>
                                <?php
                  // Cas de la specialite
                    $specialite = $_POST['specialite'];
                    $specialite = ("public/specialite.txt");  
                    $handle = fopen($specialite, "r");
                    $compteur = 1;
                    while ($line = fgets($handle))
                    {
                    ?>
                                <option value="<?=$compteur; ?>"><?= $line; ?> </option>
                                <?php
                   $compteur+=1;
                    }
                    fclose($handle);
                  ?>
                            </select>
                        </div>
                        <div class="form-group col">
                            <div id="containers" class="row">
                                <label>Expérience </label>
                                <textarea name="expr1" class="form-control">Aucune expérience</textarea>
                            </div>
                            <div class="row">
                                <button type="button" onclick="addTextArea();" id="plus" class="btn btn-block btn-primary text-center w-25">PLUS</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="nb_exprs" value="1" id="hidden">
                            </div>
                        </div>
                        <div class="form-group justify-content-center row" id="submit">
                            <div class="col">
                                <button type="button" id="prevBtn3" onclick="prev_btn3()" class="btn btn-primary btn-block">PRECEDENT</button>
                            </div>
                            <div class="col">
                                <input type="submit" id="submit" class="btn btn-block btn-primary" value="M' INSCRIRE" id="last_btn">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- End row -->

    </div>
    <!-- Container -->

    <!-- Parsley Purposes -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://parsleyjs.org/dist/parsley.min.js" type="text/javascript" charset="utf-8"></script>



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

        let next_btn3 = () => {
            document.getElementById('stageThree').style.display = 'none';
            document.getElementById('stageFour').style.display = 'block';
        }

        let prev_btn3 = () => {
            document.getElementById('stageThree').style.display = 'block';
            document.getElementById('stageFour').style.display = 'none';
        }

        /** Validating **/
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

            /*$('#validate_form').on('submit', (event) => {

                event.preventDefault();
                if ($('#validate_form').parsley().isValid()) {

                    $.ajax({
                        url: "",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(data) {
                            $('#validate_form')[0].reset();
                            $('#validate_form').parsley().reset();
                            $('#submit').attr('disabled', false);
                            $('#submit').val('Submit');
                            alert(data);
                        }
                    });
                }
            });*/
        });

    </script>

</body>

</html>

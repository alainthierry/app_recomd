<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Parsley CSS -->
    <link rel="stylesheet" type="text/css" href="https://parsleyjs.org/src/parsley.css">
    <title>Compte Patient</title>

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
            border-radius: 1px;
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

        .main label,
        .main input {
            font-size: 1em;
            /*font-weight: bold;*/
        }

    </style>

</head>

<body>
    <!-- StartMain block -->
    <div class="container rounded">

        <?php require_once('headerViewApart.php'); ?>

        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-8 col-lg-6 main">

                <form id="validate_form" method="POST" action="index.php?action=add_patient" class="pb-1">

                    <!-- First Part -->
                    <div class="col" id="stageOne">

                        <div class="col">
                            <h2 class="text-center mt-1">Créer mon compte Patient</h2>
                            <?php 
                            if (isset($_GET['not']) && !empty($_GET['not']))
                            {
                                echo "<em class='text-danger'>Navré votre compte n'a été créé car certaines informations sont déjà utilisées dans notre système.
                                Veuillez choisir des informations uniques !</em>";
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Nom</label>
                            <input required="" data-parsley-pattern="^[a-zA-Z]+[^.]*[a-zA-Z]+[^.]?$" data-parsley-trigger="keyup" type="text" name="nomPatient" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Prénom</label>
                            <input required="" data-parsley-pattern="^[a-zA-Z]+[^.]*[a-zA-Z]+[^.]?$" data-parsley-trigger="keyup" type="textarea" name="prenomPatient" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>date de naissance</label>
                            <input required="" type="date" min="1930-01-01" max="2006-12-12" name="dateNaissanceP" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Téléphone</label>
                            <input required="" type="tel" data-parsley-pattern="^[0-9]+$" data-parsley-trigger="keyup" name="telephonePatient" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input required="" data-parsley-type="email" data-parsley-trigger="keyup" type="email" name="emailPatient" class="form-control">
                        </div>
                        <div class="form-group justify-content-center row">
                            <button type="button" class="btn btn-primary btn-block text-center w-50" onclick="nextStage();">SUIVANT</button>
                        </div>
                    </div>
                    <!-- Last Part -->
                    <div class="col" id="stageTwo">
                        <div class="col">
                            <h2 class="text-center">Terminez mon insciption</h2>
                        </div>
                        <div class="form-group">
                            <label>Adresse</label>
                            <textarea required="" data-parsley-pattern="^[a-zA-Z0-9]+[^.]*[a-zA-Z0-9]+[^.]?$" data-parsley-trigger="keyup" name="adressePatient" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Ville</label>
                            <input required="" data-parsley-pattern="^[a-zA-Z0-9]+[^.]*[a-zA-Z0-9]+[^.]?$" data-parsley-trigger="keyup" type="textarea" name="villePatient" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nom d'utilisateur</label>
                            <input required="" data-parsley-pattern="^[a-zA-Z0-9]+[^.]?[a-zA-Z0-9]+$" data-parsley-trigger="keyup" type="text" name="loginPatient" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input required="" data-parsley-length="[4, 16]" data-parsley-trigger="keyup" type="password" type="password" id="passwordPatient" name="passwordPatient" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Confirmer le mot de passe</label>
                            <input required="" data-parsley-equalto="#passwordPatient" data-parsley-trigger="keyup" type="password" name="ConfirmerPassword" class="form-control">
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <button type="button" class="btn btn-block btn-primary" onclick="prevStage()">PRECEDENT</button>
                            </div>
                            <div class="col">
                                <input type="submit" name="soumission" value="M 'INSCRIRE" class="btn btn-primary btn-block">
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
    <!-- EndMain block -->

    <!-- JQuery, Propper, Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <!-- Parsley Purposes -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://parsleyjs.org/dist/parsley.min.js" type="text/javascript" charset="utf-8"></script>

    <!-- Parsley Purposes -->

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
                            method: "POST",
                            url: "index.php?action=add_patient",
                        })
                        .done(() => {
                            alert("Votre compte a été créé avec succès");
                        });

                }
            });*/
        });

    </script>
</body>

</html>

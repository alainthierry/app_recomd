<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Parsley CSS -->
    <link rel="stylesheet" type="text/css" href="https://parsleyjs.org/src/parsley.css">
    <style type="text/css">
    
        /* main styles */
        .main {
            font-family: serif;
            font-size: 1.3em;
            background-color: #fff;
            box-shadow: 0px 0px 5px 0px;
        }

        h2 {
            font-size: 1.4em;
            margin-bottom: 17px;
        }

        form {
            padding: 1%;
            background-color: #ffff;
            border-radius: 7px;
            box-shadow: 0px 0px 2px 0px;

        }

        p a:hover {
            color: sienna !important;
            text-decoration: none;
        }

        .border-danger {
            background-color: #fff;
            box-shadow: 0px 0px 3px 0px;
            border-radius: 3px;
        }

        /*< A brief description. */
        @media screen and (max-width: 1000px) {

            /* main styles */
            .main {
                font-family: serif;
                font-size: 1.3em;
                background-color: #fff;
                box-shadow: 0px 0px 5px 0px;
            }

            h2 {
                font-size: 1.4em;
                margin-bottom: 17px;
            }

            form {
                padding: 2%;
                background-color: #ffff;
                border-radius: 7px;
                box-shadow: 0px 0px 2px 0px;
                font-size: 0.9em;
                margin: 10px;
            }

            p a:hover {
                color: sienna !important;
                text-decoration: none;
            }

        }

    </style>
</head>

<body>

    <!-- Container -->
    <div class="container-fluid main rounded">

        <?php require_once('headerViewApart.php'); ?>

        <!-- login -->
        <div class="row fixed-center justify-content-center pb-2">

            <!--            <div class="col-sm-4 col-md-4col-lg-4 mt-4" id="form_group">-->
            <div class="col col-md-8 col-lg-6" id="form_group">

                <form method="POST" id="validate_form" action="index.php?action=user_sign" class="border border-secondary" autocomplete="on">
                    <div class="text-center">
                        <h2>Connectez-vous</h2>
                        <?php 
                        if (isset($_GET['added_user']) && !empty($_GET['added_user']))
                            echo "<em class='text-success'>Votre compte a été créé avec succès<br>
                            Veuillez consulter votre boite email pour l'activer !</em>";
                        ?>
                        <?php
                        if (isset($_GET['error']) && !empty($_GET['error'])) {
                            echo "<p class='text-center text-danger border-danger'>Les informations fournies sont erronées ou le compte n'existe pas ou le mot de passe incorrect !</p>";
                        }
                        if (isset($_GET['active']) && !empty($_GET['active']))
                        {
                            if ($_GET['active'] == 1)
                            {
                                echo "<em class='text-success'>Votre compte a été activé avec succès !</em>";
                            }
                            if ($_GET['active'] == 2)
                            {
                                echo "<em class='text-danger'>Votre compte n'a été activé, réessayez !</em>";
                            }
                            if ($_GET['active'] == 3)
                            {
                                echo "<em class='text-danger'> Oops ! Votre compte n'a pas encore été activé, veuillez consulter votre boite email !</em>";
                            }
                            if ($_GET['active'] == 4)
                            {
                                echo "<em class='text-danger'> Oops ! La page à laquelle vous essayez d'accéder n'existe pas !</em>";
                            }
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="user_login">Nom d'utilisateur</label>
                        <input required="" type="text" name="user_login" id="user_login" class="form-control" onkeyup="return checkExistence(this.value);">
                        <span style="font-size: 0.9em;" id="error_mess" class="text-center text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="user_passw">Mot de passe</label>
                        <input required="" data-parsley-length="[4, 16]" data-parsley-trigger="keyup" type="password" name="user_passw" id="user_passw" class="form-control">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="med_check"><label class="form-check-label" for="exampleCheck1"><b>Vous certifiez que vous êtes médecin !</b></label>
                    </div>
                    <div class="form-group justify-content-center row">
                        <div class="col">
                            <input class="btn btn-primary btn-block" type="reset" value="Réinitialiser">
                        </div>
                        <div class="col">
                            <input class="btn btn-primary btn-block" type="submit" value="Connectez-vous">
                        </div>
                    </div>

                    <div class="form-group" id="items">
                        <p class="text-center">Je ne dispose pas encore de compte !</p>
                        <p class="text-center"><a href="index.php?action=inscription_med">M' incrire en tant que Médecin</a>
                        </p>
                        <p class="text-center"><a href="index.php?action=inscription_patient">M' incrire en tant que Patient</a>
                        </p>
                    </div>
                    <!-- <div  id="show_meds" class="text-center">Login</div> -->

                </form>
            </div>

        </div>

        <!-- login -->
    </div>
    <!-- Container-->

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

    <!-- JS -->
    <script type="text/javascript">
        /**
         * @checkExistence
         * @param enteredVal string
         */
        const checkExistence = (enteredVal) => {

            let targetTag = document.getElementById('user_login');
            let targetTagMessError = document.getElementById('error_mess');

            let xhr = new XMLHttpRequest();

            xhr.onreadystatechange = () => {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {

                    if (xhr.responseText === 'true') {
                        targetTag.style.borderColor = 'green';
                        targetTag.style.borderWidth = 'medium';
                        targetTagMessError.innerHTML = "";

                        // CheckPasswordGivenUser
                        /*$(document).ready(() => {
                            $(document).on('keyup', $("#user_login"), (passTag, event) => {
                                event.stopPropagation();
                                console.log($(passTag.target).val());
                            });
                        });*/

                    } else {
                        targetTag.style.borderColor = 'red';
                        targetTag.style.borderWidth = 'medium';
                        targetTagMessError.innerHTML = "<em>Nom d'utlisateur non reconnu !</em>";
                    }
                }
            }
            xhr.open("GET", "index.php?action=check_login_type&entered_val=" + enteredVal, true);
            xhr.send();
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

        });

    </script>
</body>

</html>

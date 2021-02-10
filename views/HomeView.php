<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Social buttons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Parsley CSS -->
    <link rel="stylesheet" type="text/css" href="https://parsleyjs.org/src/parsley.css">
    <title>Care</title>
    <style type="text/css">
        body {
            font-family: serif;
        }

        .text-center,
        .message {
            font-style: oblique;
        }

        .message {
            font-size: 1.5em;
        }

        .welcome h1 {
            font-size: 2.5em;
            font-weight: bold;
        }

        .welcome a {
            font-size: 1.5em;
            font-weight: bold;
            background-color: sienna;
            border-radius: 50px;
            border: 1px solid grey;
        }

        .btn-block {
            margin-top: 70px;
        }

        .welcome a:hover {
            background-color: grey !important;
        }

        @media only screen and (max-width: 800px) {

            body {
                font-family: serif;
            }

            .welcome h1 {
                font-size: 2em;
                font-weight: bold;
            }

            .welcome a {
                font-size: 1.5em;
                font-weight: bold;
                background-color: sienna;
                border-radius: 50px;
                border: 1px solid grey;
            }

            .message {
                font-size: 1.1em;
            }

            .welcome a:hover {
                background-color: grey !important;
            }

            .btn-block {
                width: 75%;
                margin: auto;
                display: block;
                margin-top: 95px;
            }

        }

        /* Footer Styles */

        .page-footer {
            margin: 0;
            padding: 0;
            background-color: rgba(255, 255, 255, -0.5);
            box-shadow: 0px 0px 2px 0px;
            padding-right: 7px;
            padding-right: 7px;
            /*height: 80px;*/
        }

        .fa-twitter {
            background: #55ACEE;
            color: white;
        }

        .fa {
            padding: 7px;
            font-size: 1.5em;
            width: 40px;
            text-align: center;
            text-decoration: none;
            margin: 10px;
            border-radius: 7px;
        }

        .fa:hover {
            color: sienna;
            text-decoration: none;
            border: 0px solid sienna;
        }

        .fa-twitter {
            background: #55ACEE;
            color: white;
        }

        .fa-linkedin {
            background: #007bb5;
            color: white;
        }

        .fa-youtube {
            background: #bb0000;
            color: white;
        }

        .fa-yahoo {
            background: #430297;
            color: white;
        }

        /* Footer Styles */

    </style>
</head>

<body>

    <!-- Container -->
    <div class="container-fluid">

        <?php require_once('views/headerView.php'); ?>
        <!-- /header -->

        <div class="row justify-content-center mt-5">
            <div class="welcome mt-2">
                <!-- <h1>Bienvenu sur Care</h1> -->
                <p class="text-center message"><em>Votre santé entre vos mains !</em></p>
                <p class="mt-5 text-center">
                    <!-- <a href="index.php?action=user_auth" class="btn btn-block">Commencer</a><br> -->
                    <?php
                if (isset($_GET['deleted_user']) && !empty($_GET['deleted_user']))
                {
                    if ((int) htmlspecialchars($_GET['deleted_user']) == 1)
                    {
                        echo "<h5 class='text-success'><em>Votre compte a été  supprimé et
                        nous sommes<br>navrés de ne plus vous avoir parmi nous!</em></h5>";
                    }
                    elseif((int)htmlspecialchars($_GET['deleted_user']) == 2)
                    {
                        echo "<h5 class='text-danger'><em>
                        Votre compte n'a  pas été supprimé ! Merci de
                        vous<br>connecteret de contacter le service d'aide !
                        </em></h5>";
                    }
                }
                if (isset($_GET['help_mess_answer']) && !empty($_GET['help_mess_answer']))
                {
                    if ($_GET['help_mess_answer'] == 1)
                    {
                        echo "<h5 class='text-success'><em>
                        Merci d'utiliser Care, votre message a été envoyé !
                        </em></h5>";
                    }
                    if ($_GET['help_mess_answer'] == 2)
                    {
                        echo "<h5 class='text-danger'><em>
                        Votre message n'a pas été envoyé, veuillez réessayer !
                        </em></h5>";
                    }
                }
                ?>
                </p>
            </div>
        </div>

        <footer class="page-footer fixed-bottom">
            <div class="row justify-content-center">
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-linkedin"></a>
                <a href="#" class="fa fa-youtube"></a>
                <a href="#" class="fa fa-yahoo"></a>
                <a href="" data-toggle="modal" data-target="#help_message" class="fa">Aide</a><br>
            </div>
        </footer>
    </div>
    <!-- Container -->


    <!-- Needed Modals -->

    <!-- Help Modal -->
    <div class="modal fade" id="help_message" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: sienna;">
                      <h2 class="text-center">Votre message !</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="on" id="validate_form" method="POST" action="index.php?action=help_message">

                        <div class="form-group">
                            <label>Email</label>
                            <input required="" data-parsley-type="email" data-parsley-trigger="keyup" type="email" name="help_email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Message</label>
                            <textarea required="" data-parsley-trigger="keyup" name="help_content" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn float-right" style="background-color: sienna;">
                            Envoyer</button>
                        </div>

                    </form>

                </div>
<!--                 <div class="modal-footer" style="background-color: sienna;">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Help Modal -->


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
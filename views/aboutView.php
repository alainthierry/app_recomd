<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Propos Care</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>

    <!-- Main Block -->

    <div class="container-fluid main_block">

        <?php require_once('headerViewApart.php'); ?>

        <!-- Navigation -->

        <!-- Row -->
        <div class="row justify-content-center border rounded">

            <div class="col">
                <h1>A Propos de Care</h1><hr class="border border-primary">
                Le présent projet consiste à mettre en place une application web de recommandation de médecins par symptômes et position géographique. Cette application doit permettre la mise en relation entre ses usages notamment les praticiens du cadre médical et les patients. D’une part, les patients vont avoir une recommandation de médecins et pouvoir prendre des rendez-vous en mode SaaS (Software as service ou logiciel en tant que service) avec les praticiens les mieux positionnés en fonction de leurs symptômes et position géographique. Elle devra offrir une interface de recherche pratique et explicite aux patients. Quant aux praticiens, une interface d’administration de gestion
            </div>
            <div class="col">
                de leurs rendez-vous. Dans un contexte où les gens passent des heures à fouiller sur internet et centres de santé le médecin, le généraliste le mieux placé quand ils en ont besoin, ils se rendent aux centres de santé pour prendre un rendez-vous et rentrent souvent sans réponse. Ils perdent ainsi un précieux temps qui peut leur être utile ailleurs. Ainsi, remédier aux longues et interminables heures d’attentes dans les couloirs des centres de santé ou au temps perdu de recherche sur internetfaciliter la prise de rendez-vous avec le praticien qui répond aux attentes du patient, telle est la mission que se donne cette application web qui pourra par la suite intégrer la poche de ses utilisateurs à travers une application mobile.
                <a href="mailto:thierry.iliho@um6p.ma?subject=Nous contacter Care" class="email">Nous contacter</a>
            </div>
        </div>
        <!-- Row -->

    </div>
    <!-- Main Block -->


    <style type="text/css">
        * {
            font-family: serif;
            font-size: 1.03em;
        }
        .main_block {
            background-color: #fff;animation: all;
            box-shadow: 0px 0px 7px 0px;
            border-radius: 3px;
        }
        .email {
            font-size: 1.03em;
            text-decoration: none !important;
        }
        .email:hover {
            font-size: 1em;
            border:1px solid sienna;
            border-radius: 5px;
            color: black;
            font-weight: bold;
        }

    </style>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        ntegrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script type="text/javascript">

    </script>

</body>
</html>

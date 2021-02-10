<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Ressource introuvable</title>
    
    <!--    Styles -->
    <style type="text/css">
        .container {

            background-color: #fff;
            box-shadow: 0px 0px 3px 0px;

        }

    </style>
</head>

<body>

    <!-- Container -->
    <div class="container">

        <?php require_once('views/headerViewApart.php'); ?>

        <div style="display: flex; flex-direction: column;">
            <div class="row justify-content-center">
                <h2>Navré, la ressource ou la page n'est pas encore disponible</h2>
            </div>
            <div class="row justify-content-center">
                <a class="btn btn-primary" href="index.php?action=home">Revenir sur la page d'accueil</a>
            </div>
        </div>

        <?php require_once('views/footerView.php');?>

    </div>

    <!-- Container -->


    <!-- JQuery, Propper, Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


</body>

</html>

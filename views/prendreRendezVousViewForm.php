<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Prendre mon rendez-vous</title>
</head>

<body>

    <!-- Container -->

    <div class="container ">

        <?php require_once('views/headerViewApart.php'); ?>

        <div class="row justify-content-center  border rounded">
            <div class="col-md-12 col-sm-8 col-lg-6 rounded rounded_styles mb-5">
                <form action="index.php?action=cf_rdv&user_med=<?= $_GET['rdv_med'];?>&user_pat=<?=$_GET['rdv_pat'] ;?>" method="POST" name='form_rdv' onsubmit="return validating()">
                    <div class="form-group">
                        <h2 class="text-center">Prendre mon rendez-vous</h2>
                        <hr>
                    </div>
                    <div class="form-group">
                        <label for="heure_rdv">Heure choisie pour votre rendez-vous</label>
                        <input type="time" name="heure_rdv" value="<?=$_GET['rdv_h'] ;?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="heure_rdv">Date choisie pour votre rendez-vous</label>
                        <input type="date" name="date_rdv" value="<?= $_GET['rdv_d'] ;?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="motif_rdv">Brève description du motif du rendez-vous</label>
                        <textarea name="motif_rdv" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn m-1 float-right">CONFIRMER</button>
                    </div>
                </form>
            </div>

        </div>


    </div>

    <!-- Container -->

    <style type="text/css">
    </style>


    <style type="text/css">
        .rounded_styles {
            padding: 15px;
            background-color: #fff;
            border-radius: 7px;
            box-shadow: 0px 0px 5px 0px;
            font-size: 1.3em;

        }

        .justify-content-center {
            border-radius: 50px;
        }

        * {
            font-family: serif;
        }

        .float-right:hover {
            background-color: #0275d8;
            color: white;
        }

        .float-right {
            background-color: sienna;
        }

        input {
            font-size: 3em;
        }


        .container {
            background-color: #fff;
            box-shadow: 0px 0px 5px 0px;
        }

    </style>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript">
        const validating = () => {
            let data_f = document.forms['form_rdv'];

            if (data_f.motif_rdv.value == "") {
                alert('Ce champ est obligatoire et donc ne peut être vide !');
                return false;
            }
        }

    </script>

</body>

</html>

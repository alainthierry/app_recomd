<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care Admin Interface</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style type="text/css">
        * {
            font-family: serif;
            font-size: 1.03em;
        }

        nav {
            margin-left: -15px;
            margin-right: -15px;
        }

        /* container styles */
        .contains {
            background-color: #fff;
            box-shadow: 0px 0px 5px 0px;
        }
        .admin_logout:hover, #navbarDropdown:hover {
            width: 155px;
            padding-right: 7px;
            padding-left: 7px;
            border-radius: 7px;
            border:1px solid 0px;
            background-color: #fff;
        }
        .dropdown-menu a:hover {
            border: 1px solid grey;
            padding-right: 7px;
            padding-left: 7px;
            border-radius: 7px;
            border:1px solid 0px;
            background-color: #0275d8;
        }

    </style>
</head>

<body onload="return helpMessagesReceived();">

    <!-- Container -->
    <div class="container-fluid">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-primary p-3">
            <a class="navbar-brand ml-5" href="index.php?action=home">Care</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#spt" aria-controls="spt" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="spt">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link active ml-4 dropdown-toggle navbar-brand" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Utilisateurs
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="#list_medecins" onclick="return listMedecins();" class="navbar-brand dropdown-item">Lister les médecins</a>
                            <a href="#list_patients" onclick="return listPatients();" class="navbar-brand dropdown-item">Lister les patients</a>
                            <a href="index.php?action=about" class="navbar-brand dropdown-item">A propos</a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                </ul>
                <a href="index.php?action=admin_log_out" class="admin_logout navbar-brand ">Me déconnecter</a>

            </div>
        </nav>
        <!-- Navigation -->


        <!-- Row -->
        <div class="col justify-content-center border rounded contains"  id="help_messages"></div>
        <div class="col justify-content-center border rounded ">

        </div>
        <div class="row justify-content-center mr-5 ml-5 border rounded ">
            <div id="list_medecins"></div>
            <div  id="list_patients"></div>
        </div>
        <!-- Row -->

    </div>
    <!-- Container -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ntegrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script type="text/javascript">

        /**
         * @brief helpMessagesReceived
         */
        const helpMessagesReceived = () => {

            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = () => {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                    document.getElementById('help_messages').innerHTML = xhr.responseText;
                }
            }
            xhr.open("GET", "index.php?action=help_list", true);
            xhr.send();
        }

        const checkApproval = () => {
            return confirm("Attention, toutes les informations relatives à vous seront supprimées ?");
        }

        /**
         * @brief listPatients
         * @return string
         */
        const listPatients = () => {

            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = () => {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                    document.getElementById('list_patients').innerHTML = xhr.responseText;
                }
            }
            xhr.open("GET", "index.php?action=all_patients", true);
            xhr.send();
        }

        /**
         * @brief listMedecins
         * @return string
         */
        const listMedecins = () => {

            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = () => {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                    document.getElementById('list_medecins').innerHTML = xhr.responseText;
                }
            }
            xhr.open("GET", "index.php?action=all_medecins", true);
            xhr.send();
        }
    </script>
</body>

</html>

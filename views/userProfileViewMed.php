<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care <?=strtolower($_SESSION['nom_med']).'_'.strtolower($_SESSION['prenom_med']);?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style type="text/css">
        * {
            font-family: serif;
            font-size: 1.03em;
        }

        #med_agena {
            border: 1px solid #7455ff;
        }

        /* Profile Styles */
        .profile {
            border: 1px solid none;
            background-color: #fff0;
            box-shadow: 0px 0px 3px 0px;
            border-radius: 0px 0px 10px 10px;
            margin-left: 2px;
            height: 465px;
            padding: 10px;
        }

        .user_picture img {
            width: 140px;
            height: 150px;
            background-color: none;
            box-shadow: 0px 0px 5px 0px;
        }

        .user_picture a {
            text-decoration: none !important;
        }

        nav {
            margin-left: -15px;
            margin-right: -15px;
        }

        .home {
            margin-right: 30px;

        }

        .btn-light {
            font-size: 1em;
        }

        .btn-light:hover {
            background-color: #0275d8 !important;
            color: white !important;
            font-size: 1.1em;
        }

        /* delete_user_med styles */
        #delete_user_med:hover {
            /*border: 1 solid white !important;*/
            background-color: #fff;
            border-radius: 3px;
            padding: 7px;
        }

        @media only screen and (max-width: 800px) {
            * {
                font-family: serif;
                font-size: 1.03em;
            }

            #med_agena {
                border: 1px solid #7455ff;
            }

            /* Profile Styles */
            .profile {
                border: 1px solid none;
                background-color: #fff0;
                box-shadow: 0px 0px 3px 0px;
                border-radius: 0px 0px 10px 10px;
                margin-left: 2px;
                height: 530px;
                padding: 10px;
            }

            .user_picture img {
                width: 140px;
                height: 150px;
                background-color: none;
                box-shadow: 0px 0px 5px 0px;
            }

            .user_picture a {
                text-decoration: none !important;
            }

            nav {
                margin-left: -15px;
                margin-right: -15px;
            }

            .home {
                margin-right: 30px;

            }

            .btn-light {
                font-size: 1em;
            }

            .btn-light:hover {
                background-color: #0275d8 !important;
                color: white !important;
                font-size: 1.1em;
            }
        }

    </style>
</head>

<body onload="return mesRendezV(<?=$_SESSION['idMedecin'];?>);">

    <!-- StartMain block -->

    <div class="container-fluid main_block">

        <!-- Navigation -->

        <nav class="navbar navbar-expand-lg navbar-light bg-primary p-3">
            <a class="navbar-brand ml-5" href="index.php?action=home">Care</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#spt" aria-controls="spt" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="spt">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link active ml-4 dropdown-toggle navbar-brand" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mon agenda
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <button type="button" class="dropdown-item navbar-brand" data-toggle="modal" data-target="#cible" onclick="showTranche(<?= $_SESSION['idMedecin']; ?>);">
                                Consulter mon agenda
                            </button>
                            <a href="index.php?action=add_agendaf&amp;med_id=<?=$_SESSION['idMedecin'] ;?>" class="navbar-brand dropdown-item">Ajouter mon agenda</a>
                            <a href="index.php?action=about" class="navbar-brand dropdown-item">A propos</a>
                            <div class="dropdown-divider"></div>
                            <!--  <button class="dropdown-item navbar-brand" id="mes_rendezV" onclick="return mesRendezV(<?= $_SESSION['idMedecin'];?>);">Mes rendez-vous</button> -->
                        </div>
                    </li>
                </ul>
                <a href="index.php?action=delete_user_med&amp;med_id=<?=$_SESSION['idMedecin'];?>" class="navbar-brand " id="delete_user_med" onclick="return checkApproval();">Supprimer mon compte </a>

            </div>
        </nav>

        <!-- Navigation -->

        <!-- Row -->
        <div class="row">

            <!-- Start Profile -->

            <div class="col-md-4 col-sm-4 col-lg-4 profile">
                <div class="user_picture text-center">

                    <!-- Button trigger modal -->
                    <a href="picture_change" data-toggle="modal" data-target="#ch_prof_cible" onclick="pictChangeForm(<?= $_SESSION['idMedecin'];?>);">
                        <?php
                    if (($_SESSION['picture'] == '') || ($_SESSION['picture'] == '0'))
                    {
                    ?>
                        <img src="./public/images/medecin.png" class="rounded-circle" alt="Photo de profil par défaut"></a>
                    <?php
                    }
                    else
                    {
                    ?>
                    <a href="picture_change" data-toggle="modal" data-target="#ch_prof_cible" onclick="pictChangeForm(<?= $_SESSION['idMedecin'];?>);"><img src="./public/images/<?=$_SESSION['picture'];?>" class="rounded-circle" alt="Cliquer pour modifier votre photo de profil"></a>
                    <?php
                    }
                    ?>
                </div>

                <!-- User Infos -->
                <div class="col justify-content-center">
                    <div class="col">

                        Dr <?=$_SESSION['nom_med'].' '.$_SESSION['prenom_med'];?>
                        <br><?=$_SESSION['email_med']; ?><br><?= $_SESSION['ad_med']; ?>
                        Centre de santé : <?=$_SESSION['tel_med']; ?>, <?=$_SESSION['cste_med'].', '.$_SESSION['ville_med'].'. Parlant '.$_SESSION['lg_med'].', spécialiste en '; ?><?=$_SESSION['spe_med'];?> et <em>
                            né le <?= date('d-m-Y', strtotime($_SESSION['date_med'])) ;?>
                        </em>

                    </div>

                    <!-- Buttons -->
                    <div class="col mx-auto w-100 mt-1 pb-2">
                        <p> <a class="btn btn-block btn-primary" href="index.php?action=set_up_med&amp;up_med=<?=$_SESSION['idMedecin'];?>">Configurer mon profil</a></p>
                        <p>
                            <a href="index.php?action=logout_med" class="btn btn-block btn-primary">Me déconnecter!</a>
                        </p>
                    </div>
                    <!-- Buttons -->

                </div>
                <!-- User Infos -->

            </div>
            <!-- Start Profile -->

            <!-- Liste de rdvs -->
            <div class="col" id="mes_rendezV_cnt"></div>
        </div>
        <!-- Row -->

    </div>
    <!-- EndMain block -->

    <!-- Modal -->
    <div class="modal fade" id="cible" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="modal">Mon agenda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="agenda"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <a class="btn btn-primary" href="index.php?action=set_tranch&amp;_idmed=<?= $_SESSION['idMedecin']; ?>" role="button">Modifier</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- Modal More about Patients-->
    <div class="modal fade" id="more_pat" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="more_pat_cnt"></div>
                <div class="modal-footer bg-secondary">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal picture_change -->
    <div class="modal fade" id="ch_prof_cible" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="ch_prof_form"></div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ntegrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script type="text/javascript">

        /**
         * @param      {<type>}  userPatId  The user pattern identifier
         */
        const confirmerRdv = (userPatId) => {
            alert(`Veuillez confirmer ce rendez-vous pour plus de détails sur le patient !`)
        }

        /**
         * @param      {string}  userPatId  The user pattern identifier
         */
        const consulMessage = (userPatId) => {
            alert(`Vous avez déjà ajouté les informations de la Consultation pour ce rendez-vous !`);
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = () => {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                    document.getElementById('more_pat_cnt').innerHTML = xhr.responseText;
                }
            }
            xhr.open("GET", "index.php?action=more_pat_about&user_patId=" + userPatId, true);
            xhr.send();
        }
        /**
         * @return     {<type>}  { description_of_the_return_value }
         */
        const checkApproval = () => {
            return confirm("Attention, toutes les informations relatives à vous seront supprimées ?");
        }
        /**
         * @brief picture checking before sending
         * @return bool
         */
        const checkImageUploaded = () => {

            let separator = '.';
            let splitExtension = document.forms['pictureChangeF'].new_profile_ph.value.split(separator);
            let authorizedExtensions = ['jpg', 'jpeg', 'png'];
            if (document.forms['pictureChangeF'].new_profile_ph.value === '') {
                alert('Vous devez charger une image !');
                return false;
            } else {

                if (!authorizedExtensions.includes(splitExtension[1])) {
                    alert("Attention, le fichier chargé n'est pas une image !");
                    return false;
                }
                return true;
            }
        }
        
        /**
         * @brief pict_change_form
         */
        const pictChangeForm = (idMed) => {

            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = () => {
                if ((xhr.readyState == XMLHttpRequest.DONE) && (xhr.status == 200)) {
                    document.getElementById('ch_prof_form').innerHTML = xhr.responseText;
                } else {
                    document.getElementById('ch_prof_form').innerHTML = "<em>Error</em>";
                }
            }
            xhr.open("GET", "index.php?action=ch_prof_form&med_prof=" + idMed, true);
            xhr.send();
        }

        /**
         * @brief mes_rendezV
         * @param identif int doctor id
         */
        const mesRendezV = (identif) => {

            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = () => {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                    document.getElementById('mes_rendezV_cnt').innerHTML = xhr.responseText;
                }
            }
            xhr.open("GET", "index.php?action=mes_rdv_med&identif=" + identif, true);
            xhr.send();
        }

        /*
         * @brief Show tranche on click
         * @param val string speciality
         */
        const showTranche = (val) => {

            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200)
                    document.getElementById('agenda').innerHTML = xhr.responseText;

            }
            xhr.open("GET", "index.php?action=get_tranch&_idmed=" + val, true);
            xhr.send();
        }

    </script>
</body>

</html>

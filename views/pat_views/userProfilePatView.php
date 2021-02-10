<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Care <?= strtolower($_SESSION['nom']) . '_' .strtolower($_SESSION['prenom']); ?></title>

    <!--    Styles -->
    <style type="text/css">

        .picture_changef {
            font-style: 1.3em;
            font-family: serif;
            font-weight: bold;
        }

        /**
         * @brief header Styles
         */
        #header nav {
            width: 100%;
            height: 70px;
        }

        body {
            /*background-image: url('public/images/l.png');*/
            /*background-repeat: no-repeat;*/
            /*background-size: cover;*/
        }

        #more_cnt {
            background-color: #fff;
            box-shadow: 0px 0px 3px 0px;
        }

        #show_meds {
            position: absolute;
        }

        nav {
            background-color: #0000F !important;
        }

        .main_row {
            position: relative;
        }

        /* RdvList Body Styles */
        #rdv_list {
            margin-left: -28px;
            width: 100%;
            margin: auto;
        }

        /* Profile Style */
        .profile {
            background-color: #fff;
            box-shadow: 0px 0px 5px 0px;
            border-radius: 4px;
            border: 1px solid none;
            margin-left: 2px;
            font-family: serif;
            font-size: 1.28em;
        }

        #profile-content {
            justify-content: center;
        }

        .user_picture img {
            border: 1px solid black;
            border-radius: 100%;
            width: 45%;
            height: 145px;
            margin: 15px;
            margin-top: 20px;
        }

        /* Tool Styles  */
        .search_medecin {
            background-color: #fff;
            box-shadow: 0px 0px 7px 0px;
            border-radius: 4px;
            margin-left: 2px;
        }

        #lang_block {
            display: none;
        }

        .search_lang {}

        /* Navigation */
        nav {
            margin-left: -15px;
            margin-right: -15px;
            font-size: 1.3em !important;
        }

        .dropdown-menu button:hover,
        .dropdown-menu a:hover {
            /*background-color: #0275d8;*/
            background-color: sienna;
            border-radius: 3px;
        }

    </style>
</head>

<body onload="return listSuggestedDoc();">

    <!-- Container -->
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
                        <a class="nav-link active dropdown-toggle navbar-brand" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mon carnet de santé
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <button type="button" class="dropdown-item navbar-brand" data-toggle="modal" data-target="#rendezVousModal" id="rdv_list_id">
                                Mes rendez-vous
                            </button>
                            <a href="index.php?action=consul_info&amp;user_conc=<?=$_SESSION['id_pat'];?>" class="navbar-brand dropdown-item">Mes consultations</a>
                            <a href="index.php?action=delete_user_pat&amp;pat_id=<?=$_SESSION['id_pat'];?>" class="dropdown-item navbar-brand" id="delete_user_pat" onclick="return checkApproval()" ;>Supprimer mon compte</a>
                            <a href="index.php?action=about" class="navbar-brand dropdown-item">A propos</a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                    <div class="input-group">
                        <select name="seach_choice" class="custom-select" onchange="return getSelected(this.value);">
                            <option value="1" selected>Recherche par spécialité</option>
                            <option value="2">Recherche par langue</option>
                        </select>
                    </div>
                </ul>
                <form method="GET" action="" autocomplete="off" class="form-block my-2my-lg-0">
                    <div class="input-group">
                        <select class="custom-select rounded-pill" id="lang_block" onchange="return displayLangDoctors(this.value);">
                            <option value="0" selected>Choisir une langue</option>
                            <option value="1">Français</option>
                            <option value="2">Arabe</option>
                            <option value="3">Anglais</option>
                        </select>
                    </div>
                    <div class="form-group" id="spec_block">
                        <input class="form-control rounded-pill mr-5" type="search" placeholder="Saisissez une spécialité" aria-label="Search" onkeyup="showCorrespond(this.value);" id="#search_btn" onkeydown="hideCorrespond();">
                    </div>
                </form>
            </div>
        </nav>
        <!-- Navigation -->


        <!-- Main-Row -->
        <div class="row main_row">

            <!-- Profile -->
            <div class="col-sm-3 col-md-3  profile">
                <div id="profile-content">
                    <p>
                    <div class="user_picture text-center">
                        <a href="picture_change" data-toggle="modal" data-target="#ch_prof_cible">
                            <?php if (($_SESSION['url'] == '') || ($_SESSION['url'] == '0'))
                            {
                            ?>
                            <img src="./public/images/patient.jpg">
                            <?php
                            }
                            else
                            {
                            ?>
                            <img src="./public/images/<?=$_SESSION['url'];?>">
                            <?php
                            }
                            ?>
                        </a>
                    </div>
                    <p><?= $_SESSION['nom'] .' '. $_SESSION['prenom']; ?><br><?= $_SESSION['email']; ?></p>
                    <p><?= $_SESSION['tel']; ?></p>
                    <p><?= $_SESSION['adresse'] . ', ' . $_SESSION['ville'] . '.'; ?>
                        <br><em>Né le <?= date('d-m-Y',strtotime($_SESSION['data_n']));?></em>
                    </p>

                    <!-- Buttons -->
                    <div class="col">
                        <p><a class="btn btn-block btn-primary mt-2" href="index.php?action=set_up_pat&amp;up_pat=<?=$_SESSION['id_pat'];?>">Configurer mon profil</a></p>
                        <p>
                            <a href="index.php?action=logout_pat" class="btn btn-block btn-primary">Me déconnecter!</a>
                        </p>
                    </div>
                    <!-- Buttons -->

                </div>
            </div>
            <!-- Profile -->

            <div class="col">

                <!-- list_suggested -->
                <div class="col" id="list_suggested"></div>

                <!-- diplaying agenda -->
                <div id="displayAgenda" class="col" style="margin-top: -25px;"></div>

            </div>

            <!-- Display while typing -->
            <div id="show_meds" class="row offset-sm-5"></div>

        </div>
        <!-- Main-Row -->

    </div>
    <!-- Container -->

    <!-- Modal rendezVous -->
    <div class="modal fade" id="rendezVousModal" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="text-center text-capitalize">Mes rendez-vous</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalRdvBidy"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal rendezVous -->

    <!-- Modal MoreAboutDoc -->
    <div class="modal fade" id="moreAbout" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="more_cnt">
                <div class="modal-header" style="background-color: sienna;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="more_cnt" class="border rounded">
                    <div class="offset-sm-1 offset-md-0 m-4" id="more_about"></div>
                </div>
                <div class="modal-footer" style="background-color: sienna;">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal MoreAboutDoc -->

    <!-- Modal picture_change -->
    <div class="modal fade" id="ch_prof_cible" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col rounded border border-secondary">
                        <form method="POST" action="index.php?action=ch_prof_pat&amp;pat_profil=<?=$_SESSION['id_pat'];?>" enctype="multipart/form-data" name="pictureChangeF" onsubmit="return checkImageUploaded();">
                            <div class="form-group picture_changef">
                                <label for="new_profile_ph" id="photoLabel">Choisir la nouvelle photo de profil</label>
                                <input type="file" name="new_profile_ph" class="form-control-file">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">CONFIRMER</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JQuery, Propper, Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <!--  Geolib Js  -->
    <script src="https://cdn.jsdelivr.net/npm/geolib@3.3.1/lib/index.min.js"></script>

    <!-- Js implementation -->
    <script type="text/javascript" charset="utf-8" async defer>
        


        const rdvConfirmed = () => {
            alert('Votre rendez-vous a été confirmé par le médecin !');
        }

        const rdvNotConfirmed = () => {
            alert('Désolé, votre rendez-vous n\'a pas encore été confirmé par le médecin !');
        }

        const consultationMade = () => {
            alert(`Les informations de la consultation relative à ce rendez-vous ont été ajoutées par le médecin !`);
        }

        /**
         * @brief listSuggestedDoc
         */
        const listSuggestedDoc = () => {

            // Get the actual latitude and longitude of connected Patient
            alert("Autoriser l'action suivante pour faciliter votre recommandation de médecins par position géographique !");
            navigator.geolocation.getCurrentPosition(
                (position) => {

                    let xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = () => {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            document.getElementById('list_suggested').innerHTML = xhr.responseText;
                        }
                    }
                    xhr.open("GET", "index.php?action=list_suggested&patVille=<?= $_SESSION['ville']; ?>&latitude=" + position.coords.latitude + "&longitude=" + position.coords.longitude, true);
                    xhr.send();
                },
                //Get position denied
                () => {

                    let xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = () => {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            document.getElementById('list_suggested').innerHTML = xhr.responseText;
                        }
                    }
                    xhr.open("GET", "index.php?action=list_suggested&patVille=<?= $_SESSION['ville']; ?>", true);
                    xhr.send();
                }
            );
        }

        /**
         * @brief checkApproval
         */
        const checkApproval = () => {
            return confirm("Attention, toutes les informations relatives à vous seront supprimées ?")
        }
        /**
         * @brief display corresponding doctors
         * @param indexLang int selected langue
         */
        const displayLangDoctors = (indexLang) => {

            if (indexLang == 0) {
                alert('Vous devez choisir une langue !');
            } else {
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = () => {
                    if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                        document.getElementById('show_meds').innerHTML = xhr.responseText;
                    }
                }
                xhr.open("GET", "index.php?action=sh_med_lang&_idpat=<?=$_SESSION['id_pat'];?>&lang_sel=" + indexLang, true);
                xhr.send();
            }

        }

        /**
         * @brief display search mode
         * @param selectedVal int corresponding search field 
         */
        const getSelected = (selectedVal) => {

            // console.log(selectedVal);
            if (selectedVal == 2) {
                document.getElementById('lang_block').style.display = 'block';
                document.getElementById('spec_block').style.display = 'none';
            } else {
                document.getElementById('lang_block').style.display = 'none';
                document.getElementById('spec_block').style.display = 'block';
            }
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


        /* ElseWhere */

        /* bookedHour */
        const bookedHour = () => {
            alert('Navré, cette heure a déjà été prise !')
        }

        /*askForCheck*/
        const askForCheck = () => {
            return confirm('Voulez-vous prendre cette ?')
        }

        /* takeAppointMentList */
        const takeAppointMentList = (idMed) => {

            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = () => {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                    document.getElementById('displayAgenda').innerHTML = xhr.responseText;
                }
            }
            xhr.open("GET", "index.php?action=pr_rdv&_idpat=<?=$_SESSION['id_pat'];?>&_idmed=" + idMed, true);
            xhr.send();
        }

        /* moreAbout Infos doc */
        const moreAbout = (id_med) => {
            // alert(id_med);
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = () => {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                    document.getElementById('more_about').innerHTML = xhr.responseText;
                }
            }
            xhr.open("GET", "index.php?action=show_more&idMedMore=" + id_med, true);
            xhr.send();
        }

        /* ElseWhere */

        $(document).ready(() => {

            /* Get appointments list OK */
            $('#rdv_list_id').click(() => {

                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = () => {
                    if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                        document.getElementById('modalRdvBidy').innerHTML = xhr.responseText;
                    }
                }
                xhr.open("GET", "index.php?action=showRdv&_idpat=<?= $_SESSION['id_pat']; ?>", true);
                xhr.send();
            });
        });

        /* Show match doctors to the entered value of users */
        const showCorrespond = (enterVal) => {

            if (enterVal.length == 0) {
                document.getElementById('show_meds').innerHTML = '';
            } else {
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = () => {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById('show_meds').innerHTML = xhr.responseText;
                    }
                }
                xhr.open("GET", "index.php?action=search_spec&_idpat=<?= $_SESSION['id_pat']; ?>&specialite=" + enterVal, true);
                xhr.send();
            }
        }

        /* hideCorrespond */
        const hideCorrespond = () => {
            document.getElementById('show_meds').display = 'none';
        }

    </script>

    <!-- JS -->

</body>
</html>



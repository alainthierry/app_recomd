<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Ajouter mon agenda</title>
</head>
<body>

    <!-- StartMain block -->
    <div class="container rounded">

        <?php require_once('headerViewApart.php'); ?>
        <!-- Row -->

        <div class="row justify-content-center">

            <div class="col-md-8 col-sm-5 col-lg-6 rounded">
                <form method="POST" action="index.php?action=add_agenda&amp;_medId=<?=$_GET['med_id'];?>" name="data">
                    <div class="form-group">
                        <table class="table table-striped rounded bg-secondary">
                            <thead>
                                <th scope="col">Jour</th>
                                <th scope="col">Date</th>
                                <th scope="col">Heure début</th>
                                <th scope="col">Heure fin</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Lundi</td>
                                    <td scope="col"><input type="date" name="lu_date" class="form-control"></td>
                                    <td scope="col"><input type="time" name="lu_h_d" class="form-control"></td>
                                    <td scope="col"><input type="time" name="lu_h_f" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Mardi</td>
                                    <td scope="col"><input type="date" name="ma_date" class="form-control"></td>
                                    <td scope="col"><input type="time" name="ma_h_d" class="form-control" value=""></td>
                                    <td scope="col"><input type="time" name="ma_h_f" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Mercredi</td>
                                    <td scope="col"><input type="date" name="me_date" class="form-control"></td>
                                    <td scope="col"><input type="time" name="me_h_d" class="form-control"></td>
                                    <td scope="col"><input type="time" name="me_h_f" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Jeudi</td>
                                    <td scope="col"><input type="date" name="je_date" class="form-control"></td>
                                    <td scope="col"><input type="time" name="je_h_d" class="form-control"></td>
                                    <td scope="col"><input type="time" name="je_h_f" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Vendredi</td>
                                    <td scope="col"><input type="date" name="ve_date" class="form-control"></td>
                                    <td scope="col"><input type="time" name="ve_h_d" class="form-control"></td>
                                    <td scope="col"><input type="time" name="ve_h_f" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Samedi</td>
                                    <td scope="col"><input type="date" name="sa_date" class="form-control"></td>
                                    <td scope="col"><input type="time" name="sa_h_d" class="form-control"></td>
                                    <td scope="col"><input type="time" name="sa_h_f" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Dimanche</td>
                                    <td scope="col"><input type="date" name="di_date" class="form-control"></td>
                                    <td scope="col"><input type="time" name="di_h_d" class="form-control"></td>
                                    <td scope="col"><input type="time" name="di_h_f" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="reset" name="reset" class="btn btn-primary btn-block ml-5 w-50" value="Réinitialiser" id="reset"></td>
                                    <td><button class="btn ml-5 btn-primary btn-block" id="ajouter">Ajouter</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- buttons -->
                    <!-- buttons -->

                </form>
            </div>

        </div>

        <!-- Row -->

        <!-- addAgendaModal -->
        <!-- <p>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAgendaModal" onclick="addAgenda(<?= $_SESSION['id_med']; ?>);">
	Ajouter votre agenda
	</button>
	</p>
	<div class="modal fade" id="addAgendaModal" role="dialog" aria-labelledby="modal" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="modal">Ajouter votre agenda</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" id="addAgenda"></div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
	        <a class="btn btn-primary" href="index.php?action=set_tranch&amp;_idmed=<?= $_SESSION['id_med']; ?>" role="button">Modifier</a>
	      </div>
	    </div>
	  </div>
	</div> -->
        <!-- addAgendaModal -->

    </div>
    <!-- EndMain block -->


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script type="text/javascript">

        const addAgenda = (idMed) => {
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200)
                    document.getElementById('addAgenda').innerHTML = xhr.responseText;

            }
            xhr.open("GET", "index.php?action=addGform&id_med=" + idMed, true);
            xhr.send();
        }

    </script>
    <style type="text/css">

        .container {
            background-color: #fff;
            box-shadow: 0px 0px 5px 0px;
        }

    </style>

</body>
</html>

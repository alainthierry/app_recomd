<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Liste de mes consultations</title>
    <style type="text/css">

        body {
            font-family: serif;
        }
		.list-group-item:hover{
			border:5px solid sienna !important;
			border-color: sienna;
			font-size: 1.4em;
		}
		.list-group-item {
			border-color: sienna;
			font-size: 1.3em;
		}
		.justify-content-center {
			box-shadow: 0px 0px 3px 0px;
	        background-color: #fff;
	        border-radius: 3px;
		}

    </style>
</head>

<body>

    <!-- Container -->

    <div class="container">

    	<?php require_once('views/headerViewApart.php');?>
    	<div class="row justify-content-center">
    		<div class='col-sm-8 col-lg-8 col-md-4 border rounded' id="style">
                <?php
                if ($consultations->fetch(PDO::FETCH_ASSOC) == NULL)
                {
                    echo "<h1><em> Aucune consultation pour le moment</em></h1>";
                    $consultations->closeCursor();
                } else {
                    echo "<h2 class='text-center'>Liste de mes consultations</h2>";
                     $consultations->execute();
                    while ($data = $consultations->fetch(PDO::FETCH_ASSOC))
    				{
    				?>
    				<em><a href="#" data-toggle="modal" data-target="#more_med" title="Cliquez pour plus !" onclick="return moreAboutMed(<?=$data['idMedecin'] ;?>);" class='list-group-item mb-1 mt-1 border border-secondary text-center rounded border-primary list-group-item-action'>
    					Consultation pour <?= lcfirst($data['motifConsul']);?>, effectuée le <?= date('d-m-Y', strtotime($data['dateConsul']));?>.
    				</a></em>
    				<?php
    				}
    				$consultations->closeCursor();
                }
				?>
			</div>
    	</div>
       
    </div>

    <!-- Container -->


    <!-- Needed Modals -->

    <div class="modal fade" id="more_med" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: sienna;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="more_med_cnt"></div>
                <div class="modal-footer" style="background-color: sienna;">
                    <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script type="text/javascript">

    	/**
    	 * more about concerned doctor
    	 * @param int userMed  The user median
    	 */
    	const moreAboutMed = (userMed) => {

    		let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('more_med_cnt').innerHTML = xhr.responseText;
                }
            }
            xhr.open("GET", "index.php?action=show_more&idMedMore="+ userMed, true);
            xhr.send();
    	}

    </script>

</body>
</html>
<!-- #0275d8 -->	
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Modifier votre agenda</title>
</head>

<body>

    <!-- StartMain block -->
    <div class="container">
       
        <?php require_once('headerViewApart.php'); ?>
        
        <!-- row -->
        <div class="row justify-content-center">

            <div class="rounded" id="data">
                <form method="POST" action="index.php?action=up_tranche" name="data">
                    <table class="table table-striped rounded bg-secondary">
                        <thead>
                            <th scope="col">Jour</th>
                            <th scope="col">Date</th>
                            <th scope="col">Heure début</th>
                            <th scope="col">Heure fin</th>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
								while ($data = $med_tranche->fetch(PDO::FETCH_ASSOC))
								{
								?>
                                <td scope="col">
                                    <label><?= $data['jour'] ;?></label>
                                    <input type="hidden" name="_<?= strtolower(substr($data['jour'], 0, 2)); ?>" value="<?= $data['idPat']; ?>">
                                </td>
                                <td scope="col">
                                    <input type="date" name="date_<?= strtolower(substr($data['jour'], 0, 2)); ?>" class="form-control" value="<?= $data['dateT']; ?>">
                                </td>
                                <td scope="col">
                                    <input type="time" name="start_<?= strtolower(substr($data['jour'], 0, 2)); ?>" class="form-control" value="<?= $data['heure_d']; ?>">
                                </td>
                                <td scope="col">
                                    <input type="time" name="end_<?= strtolower(substr($data['jour'], 0, 2)); ?>" class="form-control" value="<?= $data['heure_f']; ?>">
                                </td>
                            </tr>
                            <?php
								}
								$med_tranche->closeCursor();
								?>
                            <tr>
                                <td colspan="2">
                                    <button type="button" id="first_btn" class="btn btn-block bg-primary" onclick="return redirect();">Annuler</button>
                                </td>
                                <td colspan="2">
                                    <button id="secd_btn" class="btn btn-block bg-primary" name="checkbtn">Modifier</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>

            </div>
        </div>

    </div>

    <!-- EndMain block -->

    <style type="text/css">
        
        .justify-content-center {
            box-shadow: 0px 0px 7px 0px;
            background-color: #fff;
            border-radius: 4px;
        }

        #first_btn {
            display: block;
            width: 55%;
            height: 10%;
            margin-left: 45px;
        }

        #secd_btn {
            display: block;
            width: 75%;
            height: 10%;
            margin-left: 10px;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ntegrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        /**
         * @brief Agenda Part
         */
        const redirect = () => {
            let url = "index.php?action=profile_med";
            location.replace(url);
        }

        /*$(document).ready(function()
        	{

        		$(document).on('click', 'td', function(e)
        		{
        			e.stopPropagation();

        			$('.motif').css('display', 'block');		// Zone desaisie
        			// Get id and content of clicked cell
        			let clicked_cell_cnt = $(this).text();
        			let clicked_cell_id = $(this).attr('id');

        			// Get color of clicked cell
        			let clicked_cell_color = $(this).css('background-color');

        			// Needed colors for comparasion
        			let rgb_red = 'rgb(255, 0, 0)';
        			let cell_green_color = 'rgb(255, 255, 255)';

        			if (clicked_cell_color == cell_green_color)		// Available hour
        			{
        				$(this).css('background-color', rgb_red);
        				$(this).attr('readonly', 'true');
        				//$(this).children(':first').attr('hr);*/
        /*}
        			else
        			{
        				alert('Heure prise !');
        			}
        		});
        	});*/
    </script>
    
</body>
</html>
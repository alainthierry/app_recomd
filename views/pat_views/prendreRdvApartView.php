 <?php
    require_once("controllers/ctrl.php");
    function getHoursDate($date)
    {
        $ctrl = new Ctrl();
        $hoursArray = $ctrl->getRdvHeuresAction($date);
        return $hoursArray;
    }
?>
 <!DOCTYPE html>
 <html>

 <head>
     <title></title>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
 </head>

 <body>

     <!-- Container -->
     <div class="container">

         <?php require_once('views/headerViewApart.php'); ?>

         <!-- Row -->
         <div class="row justify-content-center" id="apart_main">
             <table class="bg-secondary rounded mt-1 mb-5" id="htable">
                 <thead>
                     <tr>
                         <th colspan="7" id="titre" class="text-center">Prenez un rendez-vous !</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php
        	while ($data = $medTranchH->fetch(PDO::FETCH_BOTH))
        	{
        		echo '<tr><td class="btn btn-primary btn-block">'.date('d-m-Y', strtotime($data['dateT'])).'</td>';
        		for($i = (int)substr($data['heure_d'],0,2); $i<(int)substr($data['heure_f'],0,2); $i++)
        		{
        			$heure = date('H:i', strtotime($i.':00'));
        			if (in_array($data['dateT'], $datesArray))
        			{
        				$hoursArray = getHoursDate($data['dateT']);
        				if (in_array($heure, $hoursArray))
        				{
        				?>
                     <td><span class="btn bg-danger" onclick="return bookedHour();"><?= $heure; ?></span></td>
                     <?php
        				}
        				else {
        				?>
                     <td onclick="return askForCheck();"><a href="index.php?action=prf_rdv&amp;rdv_med=<?= $_GET['_idmed'];?>&amp;rdv_pat=<?=$_GET['_idpat'] ;?>&amp;rdv_d=<?= $data['dateT'];?>&amp;rdv_h=<?=$heure ;?>" class="btn btn-block bg-success"><?= $heure; ?></a></td>
                     <?php
        				}	
        			}
        			else {
        			?>
                     <td><a href="index.php?action=prf_rdv&amp;rdv_med=<?= $_GET['_idmed'];?>&amp;rdv_pat=<?=$_GET['_idpat'] ;?>&amp;rdv_d=<?= $data['dateT'];?>&amp;rdv_h=<?=$heure ;?>" class="btn btn-block bg-success"><?= $heure; ?></a></td>
                     <?php
        			}
        		}
        		echo '</tr>';
        	}
        	?>
                 </tbody>
             </table>

         </div>
         <!-- Row -->
     </div>
     <!-- Container -->
     <style type="text/css">
         #htable td,
         #htable th {
             color: white;
           /*  margin: 3px;*/
         }



         #htable td a:hover {
             color: white;
             text-decoration: none;
         }

         #titre {
             padding-left: 30px;
             font-size: 1.3em;
         }
         .container {
             background-color: #fff;
             box-shadow: 0px 0px 3px 0px;
         }

     </style>

     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
     </script>
 </body>

 </html>

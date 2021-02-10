<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<title>Chercher un medecin</title>
</head>
<body>

<!-- StartMain block -->
<div id="mainblock" class="row">
	<?php require_once('headerView.php'); ?>
	<!-- Start Med -->
	<div id="med_infos">
		<table border="1">
			<thead>
				<tr>
					<th colspan="7">Medecins correspondants à votre recherche</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while ($data = $medecins->fetch(PDO::FETCH_ASSOC))
				{
				?>
				<tr>
					<td><?= $data['nomMedecin']; ?></td>
					<td><?= $data['prenomMedecin']; ?></td>
					<td><?= $data['emailMedecin']; ?></td>
					<td><?= $data['villeMedecin']; ?></td>
					<td><?= $data['telephoneMedecin']; ?></td>
					<td><?= $data['specialite']; ?></td>
					<td>
						<a href="index.php?action=prendre_rdv&amp;med=<?=$data['idMedecin'] ?>">Prendre un rendez-vous</a>
					</td>
					<td id="tranche_medC" onmouseover="showTrancheMedecin(<?=$data['idMedecin'] ;?>);" onmouseout = "HideTrancheMedecin();">Voir l'agenda
					</td>
				</tr>
				<?php
				}
				?>
				<tr>
					<td colspan="7">
					<center>
						<a href="index.php?action=profile_pat">Revenir sur votre profil</a>
					</center>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<!-- End Med -->

	<div id="tranche_med"></div>

</div>

<!-- EndMain block -->	

</body>

<!-- Js script -->
<script type="text/javascript">
	
	/*
	* Get Medecin Agenda
	*/
	function showTrancheMedecin(idMedecin)
	{
		console.log(idMedecin);
		let xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function()
		{
			if (xhr.readyState == 4 && xhr.status == 200)
				document.getElementById('tranche_med').innerHTML =  xhr.responseText;
		}
		xhr.open("GET", "./views/medecinTrancheView.php?med="+idMedecin, true);
		xhr.send();
		document.getElementById('tranche_med').style.display = 'block';
	}

	function HideTrancheMedecin()
	{
		document.getElementById('tranche_med').style.display = 'none';
	}

</script>

<style type="text/css">
	
	* {
		margin: 10px;
	}

	#tranche_med {
		margin-top: 20px;
	}
	a {
    color: #292b2c ;
  }

</style>

</html>









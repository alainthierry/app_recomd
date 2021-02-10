<!DOCTYPE html>
<html>
<head>
	<title>Medecin tranche</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

	<p>
		<table class = "table table-sm table-primary table-striped rounded ">
			<thead>
				<tr>
					<th class="text-center bg-secondary ">Jour</th>
					<th class="text-center bg-secondary ">Début</th>
					<th class="text-center bg-secondary ">Fin</th>
				</tr>
			</thead>
			<tbody>
			<?php
			while ($data = $med_tranche->fetch(PDO::FETCH_BOTH))
			{
			?>
			<tr>
				<td scope="col"><?= $data['jour']; ?>, <?= date('d-m-Y', strtotime($data['dateT']));?></td>
				<td scope="col"><?= $data[2]; ?></td>
				<td scope="col"><?= $data[3]; ?></td>
			</tr>
			<?php
			}
			$med_tranche->closeCursor();
			?>
			</tbody>
		</table>
	</p>
	
</body>
</html>
<style type="text/css">

	tr td {
		text-align: justify;
		border-radius: 5px;
	}
	th {
		margin: 5px;
	}
</style>

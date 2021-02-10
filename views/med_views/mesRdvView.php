
<div class='border rounded' id="style">
	<h3 class='text-center'>Rendez-vous pris par les patients</h3>
	<?php 
	while ($data = $med_rdvQ->fetch(PDO::FETCH_BOTH))
	{
		/**
		 * Appointment not Confirmed
		 */
		if ($data['rdv_cf'] == '0')
		{
		?>
		<a title="Cliquez pour plus !" onclick="return confirmerRdv();" class='list-group-item mb-1 mt-1 border border-danger text-center rounded border-primary list-group-item-action'>Rendez-vous pour <?=lcfirst($data['motif']).' pris pour le '.date('d-m-Y', strtotime($data['rdvDate'])).' à '.date('H:i', strtotime($data['rdvh'])) ; ?>
		<a href="index.php?action=rdv_conf&amp;rdv_concern=<?=$data['idRdv'];?>&amp;user_pat=<?=$data['userPat'];?>" class="rdv_concern" title="Confirmer ce rendez-vous">Confirmer</a></a>
		<?php
		}
		else
		{
			/**
			 * Consultation infos not added
			 */
			if ($data['rdvConsul'] == '0')
			{
			?>
			<a title="Cliquez pour plus !" href="index.php?action=more_pat_about&amp;user_pat_id=<?=$data['userPat'] ;?>&amp;user_med_id=<?=$_SESSION['idMedecin'];?>&amp;rdv_id=<?=$data['idRdv'];?>" class='list-group-item border border-success text-center mb-1 mt-1 rounded border-primary list-group-item-action'>Rendez-vous pour <?=lcfirst($data['motif']).' pris pour le '.date('d-m-Y', strtotime($data['rdvDate'])).' à '.date('H:i', strtotime($data['rdvh'])) ; ?>
			</a>
			<?php 
			}
			else 
			{
			?>
			<a title="Cliquez pour plus !" data-toggle="modal" data-target="#more_pat" onclick="return consulMessage(<?=$data['userPat'];?>);" href="#" class='list-group-item border border-secondary text-center mb-1 mt-1 rounded border-4 list-group-item-action'>Rendez-vous pour <?=lcfirst($data['motif']).' pris pour le '.date('d-m-Y', strtotime($data['rdvDate'])).' à '.date('H:i', strtotime($data['rdvh'])) ; ?>
			</a>
			<?php 
			}
		}
	}
	$med_rdvQ->closeCursor();
	?>
</div>

<style type="text/css" media="screen">
	.list-group-item:hover{
		border:5px solid sienna !important;
		border-color: sienna;
	}
	.rdv_concern:hover{
		border:3px solid sienna !important;
		border-color: sienna;
		border-radius: 7px;
	}
</style>
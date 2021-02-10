<table class="table table-striped">
	<h3 class="text-center">Liste des messages d'aide reçus par Care</h3>
	<tbody>
		<?php
		while ($data = $messages->fetch(PDO::FETCH_ASSOC))
		{
		?>
		<tr>
			<td><?= $data['content'];?>, envoyé le <?=date("d-m-Y", strtotime($data['dateHelp'])). ' à '.date("H:i" , strtotime($data['heure'])).', par';?>
				<a href="mailto:<?=$data['email'] ;?>?subject=Réponse au message d'aide envoyé à Care">ce mail</a>
			</td><td><a href="index.php?action=delete_message&amp;delete_hepl_message=<?=$data['idHelp'];?>" title="Rassurez-vous de répondre avant cette action !">supprimer</a></td>
		</tr>
		<?php 
		}
		?>
	</tbody>
</table>
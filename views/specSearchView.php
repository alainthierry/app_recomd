<!-- View -->
<p>
	<?php
	if ($medNames == true)
	{
		while ($data = $medNames->fetch(PDO::FETCH_NUM))
		{
		?>
		<a href="index.php?action=pr_rdv_apart&amp;_idmed=<?= $data[0]; ?>&amp;_idpat=<?=$_GET['_idpat']; ?>" class='list-group-item border rounded border-primary list-group-item-action each_doc'>Docteur <?=$data[1].' '.$data[2].', '.$data[3].', '.$data[4].' '.$data[5].'';?></a>
		<?php
		}
		$medNames->closeCursor();
	}
	else
	{
	?>
	<h1>Rien ne correspond à votre recherche<h1>
	<?php
	}
	?>
</p>

 <style type="text/css">
 	.each_doc:hover{
 		border: 5px solid sienna !important;
 	}

</style>



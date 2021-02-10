<table class="table table-bordered table-dark rounded table-striped">
    <thead>
        <tr>
            <!-- <th class="text-center text-capitalize">Mes rendez-vous</th> -->
        </tr>
    </thead>
    <tbody>
        <?php
        while ($data = $gotRdv->fetch(PDO::FETCH_BOTH))
        {
        ?>
        <tr>
            <?php 
            if ($data['rdvConfirmation'] == '0')
            {
            ?>
            <td id="rdvContainer" class="border bg-danger mt-2">
                <a onclick="return rdvNotConfirmed();" href="index.php?action=sheachrdv&amp;motf=<?=$data['motif'] ;?>&amp;rdv_h=<?=$data['rdvh'] ;?>&amp;priseDate=<?= date('d-m-Y', strtotime($data['datPrise']));?>&amp;rdv_d=<?=$data['rdvDate'] ;?>&amp;user_med=<?=$data['userMed'] ;?>" class="btn w-100 text-white d-flex justify-content-start">Rendez-vous pour <?= lcfirst($data['motif']);?>, pris le <?= date('d-m-Y', strtotime($data['datPrise']));?> et prévu pour le  <?= date('d-m-Y', strtotime($data['rdvDate']));?> à <?= date('H:i', strtotime($data['rdvh']));?>
                </a>
            </td>
            <?php   
            }
            else
            {
                if ($data['rdvConsul'] == '0')
                {
                ?>
                <td id="rdvContainer" class="border bg-success mt-2">
                <a onclick="return rdvConfirmed();" href="index.php?action=sheachrdv&amp;motf=<?=$data['motif'] ;?>&amp;rdv_h=<?=$data['rdvh'] ;?>&amp;priseDate=<?= date('d-m-Y', strtotime($data['datPrise']));?>&amp;rdv_d=<?=$data['rdvDate'] ;?>&amp;user_med=<?=$data['userMed'] ;?>" class="btn w-100 text-white d-flex justify-content-start">Rendez-vous pour <?= lcfirst($data['motif']);?>, pris le <?= date('d-m-Y', strtotime($data['datPrise']));?> et prévu pour le  <?= date('d-m-Y', strtotime($data['rdvDate']));?> à <?= date('H:i', strtotime($data['rdvh']));?>
                </a>
            </td>
                <?php 
                }
                else
                {
                ?>
                <td id="rdvContainer" class="border bg-secondary mt-2">
                <a onclick="return consultationMade();" href="index.php?action=sheachrdv&amp;motf=<?=$data['motif'] ;?>&amp;rdv_h=<?=$data['rdvh'] ;?>&amp;priseDate=<?= date('d-m-Y', strtotime($data['datPrise']));?>&amp;rdv_d=<?=$data['rdvDate'] ;?>&amp;user_med=<?=$data['userMed'] ;?>" class="btn w-100 text-white d-flex justify-content-start">Rendez-vous pour <?= lcfirst($data['motif']);?>, pris le <?= date('d-m-Y', strtotime($data['datPrise']));?> et prévu pour le  <?= date('d-m-Y', strtotime($data['rdvDate']));?> à <?= date('H:i', strtotime($data['rdvh']));?>
                </a>
            </td>
                <?php    
                } 
            }
            ?>
        </tr>
        <?php
        }
        $gotRdv->closeCursor();
        ?>
    </tbody>
</table>

<style type="text/css" media="screen">

	#rdvContainer:hover{
		/*background-color: #0275d8 !important;*/
        border: 5px solid sienna !important;
        border-radius: 10px !important;
	}
</style>
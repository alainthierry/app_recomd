<style type="text/css" media="screen">

	img {
            width: 80px;
            height: 80px;
            background-color: none;
            box-shadow: 0px 0px 5px 0px;
            border-radius: 100%;
        }
</style>
<table class="table table-light table-stripe">
    <thead>
        <tr>
            <th class="text-center" style="font-size: 1.7em;">Listes des médecins présents sur Care</th>
        </tr>
    </thead>
    <tbody>

        <?php
    while ($data = $all_medecins->fetch(PDO::FETCH_ASSOC))
    {
    ?>
        <tr>
            <td id="cnt_colomun">
                <button type="button" class="rounded container">
                    <a style="font-size: 1.2em;" href="#" class="btn bouton">
                        <?php if ($data['url'] == '0' || $data['url'] == '')
                        {
                        ?>
                        <img src="./public/images/medecin.png" class="picture">
                        <?php
                        }
                        else
                        {
                        ?>
                        <img src="./public/images/<?=$data['url'];?>" class="picture">
                        <?php
                        }
                        ?>
                        <?=$data['nomMedecin'];?> <?=$data['prenomMedecin'].', (';?>
                        <a href="mailto:<?=$data['emailMedecin'];?>">Email</a>
                        , Tel : <?=$data['telephoneMedecin'];?>)
                    </a>
                </button>

            </td>
        </tr>
        <?php
    }
    $all_medecins->closeCursor();
    ?>
    </tbody>
</table>

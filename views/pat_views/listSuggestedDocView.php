    <style type="text/css">
        /* Do picture Styles */
        th {
            font-family: serif;
            font-size: 1.5em;
            font-weight: bold;
        }

        img {

            border: 1px solid black;
            border-radius: 100%;
            width: 95px;
            height: 85px;
            padding: 3px;
        }

        #cnt_colomun:hover {

            background-color: #0275d8 !important;
            border-radius: 10px;
        }

        #plus:hover {

            text-decoration: none;
            background-color: sienna;
        }

        #plus {

            text-decoration: none;
            background-color: #0275d8;
        }

        .container {
            height: 50% !important;
        }

    </style>
    <table class="table table-light table-stripe">
        <thead>
            <tr>
                <th class="text-center">Médecins, Spécialistes et Docteurs recommeandés</th>
            </tr>
        </thead>
        <tbody>

        <?php
        while ($data = $suggestedDoc->fetch(PDO::FETCH_ASSOC))
        {
        ?>
            <tr>
                <td id="cnt_colomun">
                    <button type="button" class="container rounded">
                        <a href="#displayAgenda" class="btn bouton" onclick="return takeAppointMentList(<?= $data['idMed'] ;?>);">
                            <?php if ($data['url'] == '0')
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
                            Docteur <?=$data['n_med'];?> <?=$data['pre_med'];?> spécialiste en
                            <?=$data['spe_med'];?>,<?=$data['ste_med']?><?= $data['ad_med'];?>
                            <a id="plus" class="rounded-pill btn" data-toggle="modal" data-target="#moreAbout" onclick="return moreAbout(<?= $data['idMed'] ;?>);">PLUS</a>
                        </a>
                    </button>

                </td>
            </tr>
            <?php
        }
        $suggestedDoc->closeCursor();
        ?>
        </tbody>
    </table>





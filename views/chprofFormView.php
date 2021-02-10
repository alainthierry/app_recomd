<div class="col rounded border border-secondary">
    <form method="POST" action="index.php?action=cf_new_prof" enctype="multipart/form-data" name="pictureChangeF" onsubmit="return checkImageUploaded();">
        <div class="form-group">
            <label for="new_profile_ph" id="photoLabel">Choisir la nouvelle photo de profil</label>
            <input type="file" name="new_profile_ph" class="form-control-file" id="photoInput">
            <input type="hidden" name="med_prof" value="<?=$_GET['med_prof'] ;?>">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" >CONFIRMER</button>
        </div>
    </form>
</div>

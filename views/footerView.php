<!-- Social buttons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style type="text/css">
    /* Footer Styles */

    .page-footer {
        margin: 0;
        padding: 0;
        background-color: rgba(255, 255, 255, -0.5);
        box-shadow: 0px 0px 2px 0px;
        padding-right: 7px;
        padding-right: 7px;
        /*height: 80px;*/
    }

    .fa-twitter {
        background: #55ACEE;
        color: white;
    }

    .fa {
        padding: 7px;
        font-size: 1.5em;
        width: 40px;
        text-align: center;
        text-decoration: none;
        margin: 10px;
        border-radius: 7px;
    }

    .fa:hover {
        color: sienna;
        text-decoration: none;
        border: 0px solid sienna;
    }

    .fa-twitter {
        background: #55ACEE;
        color: white;
    }

    .fa-linkedin {
        background: #007bb5;
        color: white;
    }

    .fa-youtube {
        background: #bb0000;
        color: white;
    }

    .fa-yahoo {
        background: #430297;
        color: white;
    }

    /* Footer Styles */

</style>


<!-- Help Modal -->
<div class="modal fade" id="help_message" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header float-right" style="background-color: sienna;">
                <h2 class="text-center"><em>Votre message !</em></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form autocomplete="on" id="validate_form" method="POST" action="index.php?action=help_message">

                    <div class="form-group">
                        <label>Email</label>
                        <input required="" data-parsley-type="email" data-parsley-trigger="keyup" type="email" name="help_email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea required="" data-parsley-trigger="keyup" name="help_content" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn float-right" style="background-color: sienna;">
                            Envoyer</button>
                    </div>

                </form>

            </div>
            <!--                 <div class="modal-footer" style="background-color: sienna;">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                </div> -->
        </div>
    </div>
</div>
<!-- Help Modal -->


<footer class="page-footer fixed-bottom">
    <div class="row justify-content-center">
        <a href="#" class="fa fa-twitter"></a>
        <a href="#" class="fa fa-linkedin"></a>
        <a href="#" class="fa fa-youtube"></a>
        <a href="#" class="fa fa-yahoo"></a>
        <a href="" data-toggle="modal" data-target="#help_message" class="fa">Aide</a><br>
    </div>
</footer>

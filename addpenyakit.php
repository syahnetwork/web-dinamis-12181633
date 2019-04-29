<?php include_once("header.php"); ?>
    <!-- <div class="container" style="margin-top:50px"> -->
    <div class="container" style="margin-top:100px">
        <div class="row">
            <div class="widget ">
                <div id="formcontrols" class="tab-pane active">

                    <div class="alert" id="error-msg">

                    </div>

                    <div class="alert alert-success" id="success-msg">

                    </div>


                    <form class="form-horizontal" id="add-penyakit-form" method="post">
                        <fieldset>

                            <div class="control-group">
                                <label for="nama" class="control-label">Nama</label>
                                <div class="controls">
                                    <input type="text" placeholder="Nama" name="nama" required id="nama"
                                           class="span6">
                                    <p class="help-block">Silahkan masukkan identitas penyakit</p>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->


                            <div class="control-group">
                                <label for="obat" class="control-label">Obat</label>
                                <div class="controls">
                                    <input type="text" placeholder="Obat" name="obat" required id="obat"
                                           class="span6">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->


                            <br><br>


                            <div class="form-actions">
                                <button class="btn btn-primary" type="button" id="addpenyakit">Save</button>
                                <a href="penyakit.php" class="btn">Cancel</a>
                            </div> <!-- /form-actions -->
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php include_once("footerpenyakit.php"); ?>
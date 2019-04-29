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


                    <form class="form-horizontal" id="add-pembayaran-form" method="post">
                        <fieldset>

                            <div class="control-group">
                                <label for="biaya" class="control-label">Biaya</label>
                                <div class="controls">
                                    <input type="text" placeholder="Biaya" name="biaya" required id="biaya"
                                           class="span6">
                                    <p class="help-block">Silahkan masukkan data pembayaran</p>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->


                            <div class="control-group">
                                <label for="tanggal" class="control-label">Tanggal Out</label>
                                <div class="controls">
                                    <input type="date" placeholder="Tanggal Out" name="tanggal" required
                                           id="tanggal"
                                           class="span6">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->


                            <br><br>


                            <div class="form-actions">
                                <button class="btn btn-primary" type="button" id="addpembayaran">Save</button>
                                <a href="pembayaran.php" class="btn">Cancel</a>
                            </div> <!-- /form-actions -->
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php include_once("footerpembayaran.php"); ?>
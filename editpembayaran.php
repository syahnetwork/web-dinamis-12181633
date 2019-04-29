<?php include_once("header.php");
include_once("include/config.php");
$fetch_pembayaran_info = $db_con->prepare("select * from pembayaran where pembayaran_id = :pembayaran_id");
$fetch_pembayaran_info->execute(array(':pembayaran_id' => $_GET['pembayaran_id']));
$list = $fetch_pembayaran_info->fetchAll(PDO::FETCH_ASSOC);
?>

    <div class="container" style="margin-top:50px">
        <div class="row">
            <div class="widget ">
                <div id="formcontrols" class="tab-pane active">

                    <div class="alert" id="error-msg">

                    </div>

                    <div class="alert alert-success" id="success-msg">

                    </div>

                    <form class="form-horizontal" id="edit-pembayaran-form" method="post">
                        <fieldset>
                            <input type="hidden" name="pembayaran_id" value="<?php echo $list[0]['pembayaran_id']; ?>">
                            <div class="control-group">
                                <label for="biaya" class="control-label">Nama</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $list[0]['biaya']; ?>"
                                           placeholder="Nama" name="biaya" required id="biaya" class="span6">
                                    <p class="help-block">Silahkan edit data pembayaran</p>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->


                            <div class="control-group">
                                <label for="tanggal" class="control-label">Tanggal Out</label>
                                <div class="controls">
                                    <input type="date" value="<?php echo $list[0]['tanggal']; ?>"
                                           placeholder="Tanggal Out" name="tanggal" required id="tanggal"
                                           class="span6">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->


                            <br>


                            <div class="form-actions">
                                <button class="btn btn-primary" type="button" id="editpembayaran">Save</button>
                                <a href="pembayaran.php" class="btn">Cancel</a>
                            </div> <!-- /form-actions -->
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php include_once("footerpembayaran.php"); ?>
<?php include_once("header.php");
include_once("include/config.php");
$fetch_pendaftaran_info = $db_con->prepare("select * from pendaftaran where pendaftaran_id = :pendaftaran_id");
$fetch_pendaftaran_info->execute(array(':pendaftaran_id' => $_GET['pendaftaran_id']));
$list = $fetch_pendaftaran_info->fetchAll(PDO::FETCH_ASSOC);
?>

    <div class="container" style="margin-top:50px">
        <div class="row">
            <div class="widget ">
                <div id="formcontrols" class="tab-pane active">

                    <div class="alert" id="error-msg">

                    </div>

                    <div class="alert alert-success" id="success-msg">

                    </div>

                    <form class="form-horizontal" id="edit-pendaftaran-form" method="post">
                        <fieldset>
                            <input type="hidden" name="pendaftaran_id"
                                   value="<?php echo $list[0]['pendaftaran_id']; ?>">


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
                                <button class="btn btn-primary" type="button" id="editpendaftaran">Save</button>
                                <a href="pendaftaran.php" class="btn">Cancel</a>
                            </div> <!-- /form-actions -->
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php include_once("footerpendaftaran.php"); ?>
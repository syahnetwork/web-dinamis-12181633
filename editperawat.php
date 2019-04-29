<?php include_once("header.php");
include_once("include/config.php");
$fetch_perawat_info = $db_con->prepare("select * from perawat where perawat_id = :perawat_id");
$fetch_perawat_info->execute(array(':perawat_id' => $_GET['perawat_id']));
$list = $fetch_perawat_info->fetchAll(PDO::FETCH_ASSOC);
?>

    <div class="container" style="margin-top:50px">
        <div class="row">
            <div class="widget ">
                <div id="formcontrols" class="tab-pane active">

                    <div class="alert" id="error-msg">

                    </div>

                    <div class="alert alert-success" id="success-msg">

                    </div>

                    <form class="form-horizontal" id="edit-perawat-form" method="post">
                        <fieldset>
                            <input type="hidden" name="perawat_id" value="<?php echo $list[0]['perawat_id']; ?>">
                            <div class="control-group">
                                <label for="nama" class="control-label">Nama</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $list[0]['nama']; ?>"
                                           placeholder="Nama" name="nama" required id="nama" class="span6">
                                    <p class="help-block">Silahkan edit identitas perawat</p>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->


                            <div class="control-group">
                                <label for="alamat" class="control-label">Alamat</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $list[0]['alamat']; ?>"
                                           placeholder="Alamat" name="alamat" required id="alamat"
                                           class="span6">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->


                            <div class="control-group">
                                <label for="nohp" class="control-label">No HP</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $list[0]['nohp']; ?>" name="nohp"
                                           placeholder="No HP" required id="nohp" class="span6">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->


                            <br>


                            <div class="form-actions">
                                <button class="btn btn-primary" type="button" id="editperawat">Save</button>
                                <a href="perawat.php" class="btn">Cancel</a>
                            </div> <!-- /form-actions -->
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php include_once("footerperawat.php"); ?>
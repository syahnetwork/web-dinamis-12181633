<?php include_once("header.php");
include_once("include/config.php");
$fetch_penyakit_info = $db_con->prepare("select * from penyakit where penyakit_id = :penyakit_id");
$fetch_penyakit_info->execute(array(':penyakit_id' => $_GET['penyakit_id']));
$list = $fetch_penyakit_info->fetchAll(PDO::FETCH_ASSOC);
?>

    <div class="container" style="margin-top:50px">
        <div class="row">
            <div class="widget ">
                <div id="formcontrols" class="tab-pane active">

                    <div class="alert" id="error-msg">

                    </div>

                    <div class="alert alert-success" id="success-msg">

                    </div>

                    <form class="form-horizontal" id="edit-penyakit-form" method="post">
                        <fieldset>
                            <input type="hidden" name="penyakit_id" value="<?php echo $list[0]['penyakit_id']; ?>">
                            <div class="control-group">
                                <label for="nama" class="control-label">Nama</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $list[0]['nama']; ?>"
                                           placeholder="Nama" name="nama" required id="nama" class="span6">
                                    <p class="help-block">Silahkan edit identitas penyakit</p>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->


                            <div class="control-group">
                                <label for="obat" class="control-label">Obat</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $list[0]['obat']; ?>"
                                           placeholder="Obat" name="obat" required id="obat"
                                           class="span6">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->


                            <br>


                            <div class="form-actions">
                                <button class="btn btn-primary" type="button" id="editpenyakit">Save</button>
                                <a href="penyakit.php" class="btn">Cancel</a>
                            </div> <!-- /form-actions -->
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php include_once("footerpenyakit.php"); ?>
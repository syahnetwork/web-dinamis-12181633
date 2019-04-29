<?php include_once("header.php");
include_once("include/config.php");
$fetch_pasien_info = $db_con->prepare("select * from pasien where pasien_id = :pasien_id");
$fetch_pasien_info->execute(array(':pasien_id' => $_GET['pasien_id']));
$list = $fetch_pasien_info->fetchAll(PDO::FETCH_ASSOC);
?>

    <div class="container" style="margin-top:50px">
        <div class="row">
            <div class="widget ">
                <div id="formcontrols" class="tab-pane active">

                    <div class="alert" id="error-msg">

                    </div>

                    <div class="alert alert-success" id="success-msg">

                    </div>

                    <form class="form-horizontal" id="edit-pasien-form" method="post">
                        <fieldset>
                            <input type="hidden" name="pasien_id" value="<?php echo $list[0]['pasien_id']; ?>">
                            <div class="control-group">
                                <label for="nama" class="control-label">Nama</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $list[0]['nama']; ?>"
                                           placeholder="Nama" name="nama" required id="nama" class="span6">
                                    <p class="help-block">Silahkan edit identitas Pasien</p>
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


                            <div class="control-group">
                                <label for="umur" class="control-label">Umur</label>
                                <div class="controls">
                                    <input type="text" value="<?php echo $list[0]['umur']; ?>" name="umur"
                                           placeholder="Umur" id="umur" class="span6">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->


                            <br>


                            <div class="form-actions">
                                <button class="btn btn-primary" type="button" id="editpasien">Save</button>
                                <a href="pasien.php" class="btn">Cancel</a>
                            </div> <!-- /form-actions -->
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php include_once("footerpasien.php"); ?>
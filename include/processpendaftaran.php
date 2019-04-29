<?php
include('config.php');
$error = array();
$res = array();
$success = "";
if (isset($_REQUEST['action']) && $_REQUEST['action'] == "addpendaftaran") {
    if (empty($_POST['tanggal'])) {
        $error[] = "Silahkan isi tanggal daftar";
    }
    if (count($error) > 0) {
        $resp['msg'] = $error;
        $resp['status'] = false;
        echo json_encode($resp);
        exit;
    }

    $sqlQuery = "INSERT INTO 	pendaftaran(tanggal )
		  VALUES(:tanggal)";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':tanggal', $_POST['tanggal'], PDO::PARAM_STR);
    $run->execute();

    $resp['msg'] = "Data pendaftaran telah berhasil ditambahkan";
    $resp['status'] = true;
    echo json_encode($resp);
    exit;


} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "editpendaftaran") {


    if (empty($_POST['tanggal'])) {
        $error[] = "Silahkan isi tanggal daftar";
    }

    if (count($error) > 0) {
        $resp['msg'] = $error;
        $resp['status'] = false;
        echo json_encode($resp);
        exit;
    }

    $sqlQuery = "UPDATE pendaftaran SET  
            tanggal  = :tanggal
            WHERE pendaftaran_id = :pendaftaran_id";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':tanggal', $_POST['tanggal'], PDO::PARAM_STR);
    $run->bindParam(':pendaftaran_id', $_POST['pendaftaran_id'], PDO::PARAM_INT);
    $run->execute();
    $resp['msg'] = "Data pendaftaran telah diupdate";
    $resp['status'] = true;
    echo json_encode($resp);
    exit;

} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "deletependaftaran") {
    $sqlQuery = "DELETE FROM pendaftaran WHERE pendaftaran_id =  :pendaftaran_id";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':pendaftaran_id', $_POST['pendaftaran_id'], PDO::PARAM_INT);
    $run->execute();
    $resp['status'] = true;
    $resp['msg'] = "Data telah dihapus";
    echo json_encode($resp);

} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "listpendaftaran") {
    $statement = $db_con->prepare("select * from pendaftaran where pendaftaran_id > :pendaftaran_id");
    $statement->execute(array(':pendaftaran_id' => 0));
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($row);
    echo "</pre>";
}

?>
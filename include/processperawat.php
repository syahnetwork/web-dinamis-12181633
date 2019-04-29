<?php
include('config.php');
$error = array();
$res = array();
$success = "";
if (isset($_REQUEST['action']) && $_REQUEST['action'] == "addperawat") {
    if (empty($_POST['nama'])) {
        $error[] = "Silahkan isi nama";
    }
    if (empty($_POST['alamat'])) {
        $error[] = "Silahkan isi alamat";
    }
    if (empty($_POST['nohp'])) {
        $error[] = "Silahkan isi No HP";
    }
    if (count($error) > 0) {
        $resp['msg'] = $error;
        $resp['status'] = false;
        echo json_encode($resp);
        exit;
    }

    $sqlQuery = "INSERT INTO 	perawat(nama,alamat , nohp )
		  VALUES(:nama,:alamat,:nohp)";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':nama', $_POST['nama'], PDO::PARAM_STR);
    $run->bindParam(':alamat', $_POST['alamat'], PDO::PARAM_STR);
    $run->bindParam(':nohp', $_POST['nohp'], PDO::PARAM_STR);
    $run->execute();

    $resp['msg'] = "Data perawat telah berhasil ditambahkan";
    $resp['status'] = true;
    echo json_encode($resp);
    exit;


} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "editperawat") {

    if (empty($_POST['nama'])) {
        $error[] = "Silahkan isi nama";
    }
    if (empty($_POST['alamat'])) {
        $error[] = "Silahkan isi alamat";
    }
    if (empty($_POST['nohp'])) {
        $error[] = "Silahkan isi No HP";
    }

    if (count($error) > 0) {
        $resp['msg'] = $error;
        $resp['status'] = false;
        echo json_encode($resp);
        exit;
    }

    $sqlQuery = "UPDATE perawat SET nama = :nama, 
            alamat  = :alamat, 
            nohp  = :nohp  
            WHERE perawat_id = :perawat_id";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':nama', $_POST['nama'], PDO::PARAM_STR);
    $run->bindParam(':alamat', $_POST['alamat'], PDO::PARAM_STR);
    $run->bindParam(':nohp', $_POST['nohp'], PDO::PARAM_STR);
    $run->bindParam(':perawat_id', $_POST['perawat_id'], PDO::PARAM_INT);
    $run->execute();
    $resp['msg'] = "Data perawat telah diupdate";
    $resp['status'] = true;
    echo json_encode($resp);
    exit;

} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "deleteperawat") {
    $sqlQuery = "DELETE FROM perawat WHERE perawat_id =  :perawat_id";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':perawat_id', $_POST['perawat_id'], PDO::PARAM_INT);
    $run->execute();
    $resp['status'] = true;
    $resp['msg'] = "Data telah dihapus";
    echo json_encode($resp);

} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "listperawat") {
    $statement = $db_con->prepare("select * from perawat where perawat_id > :perawat_id");
    $statement->execute(array(':perawat_id' => 0));
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($row);
    echo "</pre>";
}

?>
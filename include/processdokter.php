<?php
include('config.php');
$error = array();
$res = array();
$success = "";
if (isset($_REQUEST['action']) && $_REQUEST['action'] == "adddokter") {
    if (empty($_POST['nama'])) {
        $error[] = "Silahkan isi Nama";
    }
    if (empty($_POST['alamat'])) {
        $error[] = "Silahkan isi Alamat";
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

    $sqlQuery = "INSERT INTO 	dokter(nama,alamat , nohp )
		  VALUES(:nama,:alamat,:nohp)";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':nama', $_POST['nama'], PDO::PARAM_STR);
    $run->bindParam(':alamat', $_POST['alamat'], PDO::PARAM_STR);
    $run->bindParam(':nohp', $_POST['nohp'], PDO::PARAM_STR);
    $run->execute();

    $resp['msg'] = "Dokter telah berhasil ditambahkan";
    $resp['status'] = true;
    echo json_encode($resp);
    exit;


} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "editdokter") {

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

    $sqlQuery = "UPDATE dokter SET nama = :nama, 
            alamat  = :alamat, 
            nohp  = :nohp  
            WHERE dokter_id = :dokter_id";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':nama', $_POST['nama'], PDO::PARAM_STR);
    $run->bindParam(':alamat', $_POST['alamat'], PDO::PARAM_STR);
    $run->bindParam(':nohp', $_POST['nohp'], PDO::PARAM_STR);
    $run->bindParam(':dokter_id', $_POST['dokter_id'], PDO::PARAM_INT);
    $run->execute();
    $resp['msg'] = "Dokter telah diupdate";
    $resp['status'] = true;
    echo json_encode($resp);
    exit;

} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "deletedokter") {
    $sqlQuery = "DELETE FROM dokter WHERE dokter_id =  :dokter_id";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':dokter_id', $_POST['dokter_id'], PDO::PARAM_INT);
    $run->execute();
    $resp['status'] = true;
    $resp['msg'] = "Data telah dihapus";
    echo json_encode($resp);

} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "listdokter") {
    $statement = $db_con->prepare("select * from dokter where dokter_id > :dokter_id");
    $statement->execute(array(':dokter_id' => 0));
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($row);
    echo "</pre>";
}

?>
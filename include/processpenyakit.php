<?php
include('config.php');
$error = array();
$res = array();
$success = "";
if (isset($_REQUEST['action']) && $_REQUEST['action'] == "addpenyakit") {
    if (empty($_POST['nama'])) {
        $error[] = "Silahkan isi nama penyakit";
    }
    if (empty($_POST['obat'])) {
        $error[] = "Silahkan isi nama obat";
    }
    if (count($error) > 0) {
        $resp['msg'] = $error;
        $resp['status'] = false;
        echo json_encode($resp);
        exit;
    }

    $sqlQuery = "INSERT INTO 	penyakit(nama,obat )
		  VALUES(:nama,:obat)";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':nama', $_POST['nama'], PDO::PARAM_STR);
    $run->bindParam(':obat', $_POST['obat'], PDO::PARAM_STR);
    $run->execute();

    $resp['msg'] = "Data penyakit telah berhasil ditambahkan";
    $resp['status'] = true;
    echo json_encode($resp);
    exit;


} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "editpenyakit") {

    if (empty($_POST['nama'])) {
        $error[] = "Silahkan isi nama penyakit";
    }
    if (empty($_POST['obat'])) {
        $error[] = "Silahkan isi nama obat";
    }

    if (count($error) > 0) {
        $resp['msg'] = $error;
        $resp['status'] = false;
        echo json_encode($resp);
        exit;
    }

    $sqlQuery = "UPDATE penyakit SET nama = :nama, 
            obat  = :obat
            WHERE penyakit_id = :penyakit_id";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':nama', $_POST['nama'], PDO::PARAM_STR);
    $run->bindParam(':obat', $_POST['obat'], PDO::PARAM_STR);
    $run->bindParam(':penyakit_id', $_POST['penyakit_id'], PDO::PARAM_INT);
    $run->execute();
    $resp['msg'] = "Data penyakit telah diupdate";
    $resp['status'] = true;
    echo json_encode($resp);
    exit;

} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "deletepenyakit") {
    $sqlQuery = "DELETE FROM penyakit WHERE penyakit_id =  :penyakit_id";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':penyakit_id', $_POST['penyakit_id'], PDO::PARAM_INT);
    $run->execute();
    $resp['status'] = true;
    $resp['msg'] = "Data telah dihapus";
    echo json_encode($resp);

} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "listpenyakit") {
    $statement = $db_con->prepare("select * from penyakit where penyakit_id > :penyakit_id");
    $statement->execute(array(':penyakit_id' => 0));
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($row);
    echo "</pre>";
}

?>
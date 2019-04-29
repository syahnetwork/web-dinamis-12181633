<?php
include('config.php');
$error = array();
$res = array();
$success = "";
if (isset($_REQUEST['action']) && $_REQUEST['action'] == "addpasien") {
    if (empty($_POST['nama'])) {
        $error[] = "Silahkan isi nama";
    }
    if (empty($_POST['alamat'])) {
        $error[] = "Silahkan isi alamat";
    }
    if (empty($_POST['nohp'])) {
        $error[] = "Silahkan isi No HP";
    }
    if (empty($_POST['umur'])) {
        $error[] = "Silahkan isi umur";
    }
    if (count($error) > 0) {
        $resp['msg'] = $error;
        $resp['status'] = false;
        echo json_encode($resp);
        exit;
    }

    $sqlQuery = "INSERT INTO 	pasien(nama,alamat , nohp , umur)
		  VALUES(:nama,:alamat,:nohp,:umur)";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':nama', $_POST['nama'], PDO::PARAM_STR);
    $run->bindParam(':alamat', $_POST['alamat'], PDO::PARAM_STR);
    $run->bindParam(':nohp', $_POST['nohp'], PDO::PARAM_STR);
    $run->bindParam(':umur', $_POST['umur'], PDO::PARAM_STR);
    $run->execute();

    $resp['msg'] = "Data pasien telah berhasil ditambahkan";
    $resp['status'] = true;
    echo json_encode($resp);
    exit;


} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "editpasien") {

    if (empty($_POST['nama'])) {
        $error[] = "Silahkan isi nama";
    }
    if (empty($_POST['alamat'])) {
        $error[] = "Silahkan isi alamat";
    }
    if (empty($_POST['nohp'])) {
        $error[] = "Silahkan isi No HP";
    }
    if (empty($_POST['umur'])) {
        $error[] = "Silahkan isi umur";
    }


    if (count($error) > 0) {
        $resp['msg'] = $error;
        $resp['status'] = false;
        echo json_encode($resp);
        exit;
    }

    $sqlQuery = "UPDATE pasien SET nama = :nama, 
            alamat  = :alamat, 
            nohp  = :nohp,  
            umur  = :umur
            WHERE pasien_id = :pasien_id";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':nama', $_POST['nama'], PDO::PARAM_STR);
    $run->bindParam(':alamat', $_POST['alamat'], PDO::PARAM_STR);
    $run->bindParam(':nohp', $_POST['nohp'], PDO::PARAM_STR);
    $run->bindParam(':umur', $_POST['umur'], PDO::PARAM_STR);
    $run->bindParam(':pasien_id', $_POST['pasien_id'], PDO::PARAM_INT);
    $run->execute();
    $resp['msg'] = "Data pasien telah diupdate";
    $resp['status'] = true;
    echo json_encode($resp);
    exit;

} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "deletepasien") {
    $sqlQuery = "DELETE FROM pasien WHERE pasien_id =  :pasien_id";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':pasien_id', $_POST['pasien_id'], PDO::PARAM_INT);
    $run->execute();
    $resp['status'] = true;
    $resp['msg'] = "Data telah dihapus";
    echo json_encode($resp);

} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "listpasien") {
    $statement = $db_con->prepare("select * from pasien where pasien_id > :pasien_id");
    $statement->execute(array(':pasien_id' => 0));
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($row);
    echo "</pre>";
}

?>
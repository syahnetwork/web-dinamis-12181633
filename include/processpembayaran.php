<?php
include('config.php');
$error = array();
$res = array();
$success = "";
if (isset($_REQUEST['action']) && $_REQUEST['action'] == "addpembayaran") {
    if (empty($_POST['biaya'])) {
        $error[] = "Silahkan isi biaya";
    }
    if (empty($_POST['tanggal'])) {
        $error[] = "Silahkan isi tanggal pembayaran";
    }
    if (count($error) > 0) {
        $resp['msg'] = $error;
        $resp['status'] = false;
        echo json_encode($resp);
        exit;
    }

    $sqlQuery = "INSERT INTO 	pembayaran(biaya,tanggal )
		  VALUES(:biaya,:tanggal)";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':biaya', $_POST['biaya'], PDO::PARAM_STR);
    $run->bindParam(':tanggal', $_POST['tanggal'], PDO::PARAM_STR);
    $run->execute();

    $resp['msg'] = "Data pembayaran telah berhasil ditambahkan";
    $resp['status'] = true;
    echo json_encode($resp);
    exit;


} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "editpembayaran") {

    if (empty($_POST['biaya'])) {
        $error[] = "Silahkan isi biaya";
    }
    if (empty($_POST['tanggal'])) {
        $error[] = "Silahkan isi tanggal pembayaran";
    }

    if (count($error) > 0) {
        $resp['msg'] = $error;
        $resp['status'] = false;
        echo json_encode($resp);
        exit;
    }

    $sqlQuery = "UPDATE pembayaran SET biaya = :biaya, 
            tanggal  = :tanggal
            WHERE pembayaran_id = :pembayaran_id";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':biaya', $_POST['biaya'], PDO::PARAM_STR);
    $run->bindParam(':tanggal', $_POST['tanggal'], PDO::PARAM_STR);
    $run->bindParam(':pembayaran_id', $_POST['pembayaran_id'], PDO::PARAM_INT);
    $run->execute();
    $resp['msg'] = "Data pembayaran telah diupdate";
    $resp['status'] = true;
    echo json_encode($resp);
    exit;

} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "deletepembayaran") {
    $sqlQuery = "DELETE FROM pembayaran WHERE pembayaran_id =  :pembayaran_id";
    $run = $db_con->prepare($sqlQuery);
    $run->bindParam(':pembayaran_id', $_POST['pembayaran_id'], PDO::PARAM_INT);
    $run->execute();
    $resp['status'] = true;
    $resp['msg'] = "Data telah dihapus";
    echo json_encode($resp);

} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == "listpembayaran") {
    $statement = $db_con->prepare("select * from pembayaran where pembayaran_id > :pembayaran_id");
    $statement->execute(array(':pembayaran_id' => 0));
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($row);
    echo "</pre>";
}

?>
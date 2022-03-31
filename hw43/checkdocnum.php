<?php
require_once("dbconfig.php");

$docnum = $_GET['docnum'];

$sql = "SELECT *
        FROM documents
        WHERE doc_num = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $docnum);
$stmt->execute();
$result = $stmt->get_result();
if( $result->num_rows == 1){
    $row = $result->fetch_object();
    echo  $row->id;
}else{
    $error = "";
}
?>

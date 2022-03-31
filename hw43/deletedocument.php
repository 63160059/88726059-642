<?php
session_start();

if(!isset($_SESSION['loggedin'])){
    header("location: login.php");
}
require_once("dbconfig.php");


if ($_POST){
    
    $id = $_POST['id'];


    $sql = "DELETE 
            FROM doc_staff
            WHERE doc_staff.doc_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();


    
    $sql = "DELETE 
            FROM documents 
            WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    
    header("location: document.php");
} else {
   
    $id = $_GET['id'];
    $sql = "SELECT *
            FROM documents
            WHERE id = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_object();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ลบข้อมูลคำสั่งแต่งตั้ง</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h1 align =center ><b>ลบข้อมูลคำสั่งแต่งตั้ง</b></h1>
        <table class="table table-hover">
            <tr>
                <th style='width:120px'>เลขที่คำสั่ง</th>
                <td><?php echo $row->doc_num;?></td>
            </tr>
            <tr>
                <th>ชื่อคำสั่ง</th>
                <td><?php echo $row->doc_title;?></td>
            </tr>
            <tr>
                <th>วันที่เริ่มต้นคำสั่ง</th>
                <td><?php echo $row->doc_start_date;?></td>
            </tr>
            <tr>
                <th>วันที่สิ้นสุด</th>
                <td><?php echo $row->doc_to_date;?></td>
            </tr>
            <tr>
                <th>สถานะ</th>
                <td><?php echo $row->doc_status;?></td>
            </tr>
            <tr>
                <th>ชื่อไฟล์เอกสาร</th>
                <td><?php echo $row->doc_file_name;?></td>
            </tr>
        </table>
        <form action="deletedocument.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row->id;?>">
            <input type="submit" value="Confirm delete" class="btn btn-danger">
            <button type="button" class="btn btn-warning" onClick="window.history.back()">Cancel Delete</button>
        </form>
</body>

</html>
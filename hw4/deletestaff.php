<?php
require_once("dbconfig.php");


if ($_POST){
    
    $id = $_POST['id'];

    
    $sql = "DELETE 
            FROM staff 
            WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    
    header("location: staff.php");
} else {
   
    $id = $_GET['id'];
    $sql = "SELECT *
            FROM staff
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
    <title>ลบข้อมูลบุคลากร</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>ลบข้อมูลบุคลากร</h1>
        <table class="table table-hover">
            <tr>
                <th style='width:120px'>รหัสพนักงาน</th>
                <td><?php echo $row->stf_code;?></td>
            </tr>
            <tr>
                <th>ชื่อ-นามสกุล</th>
                <td><?php echo $row->stf_name;?></td>
            </tr>
        </table>
        <form action="deletestaff.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row->id;?>">
            <input type="submit" value="Confirm delete" class="btn btn-danger">
            <button type="button" class="btn btn-warning" onClick="window.history.back()">Cancel Delete</button>
        </form>
</body>

</html>
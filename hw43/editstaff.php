<?php
session_start();

if(!isset($_SESSION['loggedin'])){
    header("location: login.php");
}


require_once("dbconfig.php");


if ($_POST){
    $id = $_POST['id'];
    $stf_code = $_POST['stf_code'];
    $stf_name = $_POST['stf_name'];
    $username = $_POST['username'];
    $password = base64_encode($_POST['password']);

    $sql = "UPDATE staff 
            SET stf_code = ?, 
            stf_name = ?, 
            username = ?, 
            passwd = ?                
            WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssi",$stf_code,$stf_name,$username,$password,$id);
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
    <title>แก้ไขคำสั่งบุคลากร</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
    <h1 align =center ><b>แก้ไขคำสั่งบุคลากร</b></h1>
        <form action="editstaff.php" method="post">
            <div class="form-group">
            <label for="stf_code">รหัสพนักงาน</label>
            <input type="text" class="form-control" name="stf_code" id="stf_code" value="<?php echo $row->stf_code;?>" style="background-color:#DFF6FF">
            </div>
            <div class="form-group">
            <label for="stf_name">ชื่อ-นามสกุล</label>
            <input type="text" class="form-control" name="stf_name" id="stf_name" value="<?php echo $row->stf_name;?>" style="background-color:#DFF6FF">
            </div>
            <div class="form-group">
            <label  for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" value="<?php echo $row->username;?>" style="background-color:#DFF6FF">
            </div>
            <div class="form-group">
            <label  for="password">Password</label>
                <input  type="password" class="form-control" name="password" id="passwd" value="<?php echo base64_decode($row->passwd);?>" style="background-color:#DFF6FF" >
                               
            </div>
            <br>
            <input type="hidden" name="id" value="<?php echo $row->id;?>">
            <button type="button" class="btn btn-warning" onclick="history.back();">Back</button>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
</body>

</html>
<?php
require_once("dbconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะเพิ่ม
if ($_POST){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];

    // insert a record by prepare and bind
    // The argument may be one of four types:
    //  i - integer
    //  d - double
    //  s - string
    //  b - BLOB

    // ในส่วนของ INTO ให้กำหนดให้ตรงกับชื่อคอลัมน์ในตาราง actor
    // ต้องแน่ใจว่าคำสั่ง INSERT ทำงานใด้ถูกต้อง - ให้ทดสอบก่อน
    $sql = "INSERT 
            INTO actor (first_name, last_name,email) 
            VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss", $fname, $lname,$email);
    $stmt->execute();

    // redirect ไปยัง actor.php
    header("location: actor.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>php db demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Add an actor</h1>
        <form action="newactor.php" method="post">
            <div class="form-group">
                <label for="fname">First name</label>
                <input type="text" class="form-control" name="fname" id="fname">
            </div>
            <div class="form-group">
                <label for="lname">Last name</label>
                <input type="text" class="form-control" name="lname" id="lname">
            </div>
            <div class="form-group">
                <label for="lname">E-Mail</label>
                <input type="text" class="form-control" name="email" id="email">
            </div>
            
            <button type="submit" class="btn btn-success">Save</button>
        </form>
</body>

</html>
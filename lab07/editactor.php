<?php
require_once("dbconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะลบ
if ($_POST){
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
   

    $sql = "UPDATE actor 
            SET first_name = ?, 
                last_name = ?,
                email = ?,
                last_update = CURRENT_TIMESTAMP
            WHERE actor_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssi", $fname, $lname, $email,$id);
    $stmt->execute();

    header("location: actor.php");
} else {
    $id = $_GET['id'];
    $sql = "SELECT *
            FROM actor
            WHERE actor_id = ?";

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
    <title>php db demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Edit an actor</h1>
        <form action="editactor.php" method="post">
            <div class="form-group">
                <label for="fname">First name</label>
                <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $row->first_name;?>">
            </div>
            <div class="form-group">
                <label for="lname">Last name</label>
                <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $row->last_name;?>">
            </div>
            <div class="form-group">
                <label for="lname">E-Mail</label>
                <input type="text" class="form-control" name="email" id="email" value="<?php echo $row->email;?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $row->actor_id;?>">
            <button type="submit" class="btn btn-success">Update</button>
        </form>
</body>

</html>
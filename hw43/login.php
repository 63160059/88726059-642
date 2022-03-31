<?php
$error = "";
session_start();
if($_POST){
    require_once("dbconfig.php");

    $username = $_POST['username'];
    $password = base64_encode($_POST['password']);
    $sql = "SELECT *
            FROM staff
            WHERE username = ? AND passwd = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if( $result->num_rows > 0){
        $row = $result->fetch_assoc();
        //$_SESSION['user_id'] = $row['id'];
        $_SESSION['stf_name'] = $row['stf_name'];
        $_SESSION['is_admin'] = $row['is_admin'];
        $_SESSION['loggedin'] = true;
        header('location: document.php');
    }else{
        $error = 'Username or Password is incorrect';
    } 
}else{
    if(isset($_SESSION['loggedin'])){
        header("location: document.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title >Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <br><br>
    <h1 align =center><b>&nbsp;LOGIN</b></h1>
        <br><br>
        <form action="login.php" method="post" >
            <div class="form-group" align =center>
            <label align =center for="username" >Username</label>
                &emsp;
                <input align =center type="text"  name="username" id="username" >
            </div><br>
            <div class="form-group" align =center>
            <label align =center for="password">Password</label>
                &emsp;&nbsp;
                <input align =center type="password"  name="password" id="passwd" >
            </div>
            <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            &emsp;&emsp;&emsp;&nbsp;
            <input align =center type="submit" value="Login" name="submit">
        </form>
    <div align =center style="">
        <br>
        <?php  echo $error; ?>
    </div>
</body>

</html>
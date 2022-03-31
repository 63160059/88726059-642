<?php
if(!isset($_SESSION['loggedin'])){
    header("location: login.php");
}else{
    header("location: document.php");
}

?>
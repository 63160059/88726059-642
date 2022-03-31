<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header("location: login.php");
}

require_once("dbconfig.php");

if ($_POST){
    // echo "<pre>";
    // print_r($_POST);
    $id = $_POST['id'];

    $sql = "DELETE 
            FROM doc_staff 
            WHERE doc_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
 
    @$staff_id = $_POST['staff_id'];

    if(!empty($staff_id)){
        for ($i=0; $i<count($staff_id); $i++){
            $sql = "INSERT 
                    INTO doc_staff (doc_id, stf_id) 
                    VALUES (?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ss", $id, $staff_id[$i]);
            $stmt->execute();
        }
    }
    
    header("location: document.php");

}else {

    $doc_id = $_GET['id'];
    $sql = "SELECT *
            FROM documents
            WHERE id = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $doc_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_object();

   echo "<h1 align =center >$row->doc_num : $row->doc_title</h1>";
    
    $sql = "SELECT * 
            FROM staff LEFT JOIN (SELECT * FROM doc_staff WHERE doc_id = ?) ds ON staff.id = ds.stf_id
            ORDER BY staff.id";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $doc_id);
    $stmt->execute();
    $result = $stmt->get_result();
}
//echo "Welcome ".$_SESSION['stf_name'];
?>

<body>
    <form action="addstafftodocument.php" method="post" >
    <br>
        <div class="form-group">
        <input  type="hidden" name="id"  value=" <?php echo $doc_id; ?>">
        <?php
        while($row = $result->fetch_object()){ ?>
            <div class="checkbox" >
                <label >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                    &emsp;&emsp;&emsp;&emsp;&emsp;

                </label>
                <input type="checkbox" name="staff_id[]" class="form-control"  <?php if ($row->doc_id <> null) echo "checked";?>
                value="<?php echo $row->id; ?>"><?php echo $row->stf_name; ?>
            </div>
        </h3>
        <?php } ?>
        <br>
        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        <button type="submit" style="width: 60px;height:50px"><h3 align =center ><b>ส่ง</b></h3></button>
        
    </form>
</body>

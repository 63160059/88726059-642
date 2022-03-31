<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header("location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> คำสั่งแต่งตั้ง</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    <h1 align =center>คำสั่งแต่งตั้ง
        <a href='logout.php'><span class='glyphicon glyphicon-off' style='color:#FF0000;'></span></a>
    </h1>
   <h2 align =center >รายการคำสั่งแต่งตั้ง| 
    <a href='newdocument.php'><span class='glyphicon glyphicon-plus' ></span></a>
    <a href='staff.php'><span class='glyphicon glyphicon-user' ></span></a>
    <a href='selectdocument.php'><span class='glyphicon glyphicon-search' ></span></a></h2>
        <form a action="#" method="post">
            <input type="text" name="kw" placeholder="Enter document name" value="" size=140 >
            <button type="submit" class="glyphicon glyphicon-search btn btn-info"></button>
        </form>
        
        <?php 
        require_once("dbconfig.php");

        @$kw = "%{$_POST['kw']}%";


        $sql = "SELECT *
                FROM documents
                WHERE concat(doc_num, doc_title) LIKE ? 
                ORDER BY doc_num";

        

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $kw);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 0) {
            echo  "Not found!";
        } else {
            echo "Found " . $result->num_rows . " record(s).";
            $table = "<table align =center class='table table-hover'>
                        <thead>
                            <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>&emsp;&emsp;&emsp;&emsp;&nbsp;<br>เลขที่คำสั่ง</th>
                                <th scope='col'>ชื่อคำสั่ง</th>
                                <th scope='col'>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;<br>วันที่เริ่มต้นคำสั่ง </th>
                                <th scope='col'>วันที่สิ้นสุด  </th>
                                <th scope='col'>สถานะ  </th>
                                <th scope='col'>ชื่อไฟล์เอกสาร  </th>
                                <th scope='col'>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<br>จัดการข้อมูลคำสั่งแต่งตั้ง</th>
                                <th scope='col'>บุคลากร</th>
                            </tr>
                        </thead>
                        <tbody>";
                        
             
            $i = 1; 

            while($row = $result->fetch_object()){ 
                $table.= "<tr>";
                $table.= "<td align =center>" . $i++ . "</td>";
                $table.= "<td align =center>$row->doc_num &emsp;</td>";
                $table.= "<td>$row->doc_title</td>";
                $table.= "<td>$row->doc_start_date</td>";
                $table.= "<td>$row->doc_to_date</td>";
                $table.= "<td>$row->doc_status</td>";
                $table.= "<td><a style='color:#1134A6;' href='uploads/$row->doc_file_name'>$row->doc_file_name</a></td>";
                $table.= "<td align =center >";
                $table.= "<a href='editdocument.php?id=$row->id'><span class='glyphicon glyphicon-wrench' aria-hidden='true'></span></a>";
                $table.= " : ";
                $table.= "<a href='deletedocument.php?id=$row->id'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>";
                $table.= "</td>";
                $table.= "<td align =center >";
                $table.= "<a href='addstafftodocument.php?id=$row->id'><span class='glyphicon glyphicon-user' aria-hidden='true' ></span></a>";
                $table.= "</td>";
                $table.= "</tr>";
            }

            

            $table.= "</tbody>";
            $table.= "</table>";
            
            echo $table;
        }
        ?>
        
    </div>
</body>

</html>
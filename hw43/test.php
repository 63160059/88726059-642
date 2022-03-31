<form action="#" method="post">
    <input type="text" name = "docnum" id="docnum" onkeyup="checkdocnum()"/>   
    <div id = "disp">???</div>
    <button type="submit" class="btn btn-success" id="submit" >Save</button>
</form>

<script>
function checkdocnum() {
    var docnum = document.getElementById("docnum").value;
    //document.getElementById("disp").innerHTML = docnum;
    var xhttp = new XMLHttpRequest();
    //console.log("hello");
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status ==200 ) {
            // document.getElementByid("disp").innerHTML = this.responseText;
            if (this.responseText != ""){
                document.getElementById("submit").disabled = true;
                document.getElementById("disp").innerHTML = "<a href='addstafftodocument.php?id=" + 
                this.responseText + "'>จัดการกรรมการ</a>";
            }else{
                document.getElementById("submit").disabled = false;
                document.getElementById("disp").innerHTML = "";
            }
        }
    };
    //console.log("hello");
    xhttp.open("GET", "checkdocnum.php?docnum=" + docnum, true);
    //console.log("hello");
    xhttp.send();
}
</script>
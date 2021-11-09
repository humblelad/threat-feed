<?php 
include "connection.php";

if(isset($_POST['id'])){
   $id=$_POST['id'];

      //commented below due as we already send to delete table before sending to review table. 	
   //$sql=pg_query($dbconn,"INSERT INTO delete(deleteid) VALUES('$id')");
     //$sql=pg_query($dbconn,"DELETE FROM review WHERE videoid='$id'");
   
$sql=pg_query($dbconn,"PREPARE revdel(text) as DELETE FROM review i WHERE i.videoid=$1; EXECUTE revdel('$id');");
echo 1;
pg_close($dbconn);
exit;
}

echo 0;
pg_close($dbconn);
exit;

?>

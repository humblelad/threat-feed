<?php 
include "connection.php";

if(isset($_POST['id'])){
   $id=$_POST['id'];

   $sql=pg_query($dbconn,"INSERT INTO delete(deleteid) VALUES('$id')");   
   $sql=pg_query($dbconn,"DELETE FROM review WHERE videoid='$id'");
echo 1;
pg_close($dbconn);
exit;
}

echo 0;
pg_close($dbconn);
exit;

?>

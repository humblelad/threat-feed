<?php 
include "connection.php";


if($_POST['r']==1){
	$id=$_POST['id'];
	
	$sql=pg_query($dbconn,"INSERT INTO review VALUES('$id')");
   $sql=pg_query($dbconn,"INSERT INTO DELETE VALUES('$id')");
	$sql=pg_query($dbconn,"DELETE FROM initial WHERE videoid='$id'");
	echo 1;
	exit;
}

if(isset($_POST['id'])){
   $id=$_POST['id'];

   $sql=pg_query($dbconn,"INSERT INTO DELETE VALUES('$id')");
   $sql=pg_query($dbconn,"DELETE FROM initial WHERE videoid='$id'");
   
   echo 1;
   pg_close($dbconn);
   exit;
}




echo 0;
pg_close($dbconn);
exit;


?>

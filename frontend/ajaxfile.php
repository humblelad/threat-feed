<?php 
include "connection.php";


if($_POST['r']==1){
	$id=$_POST['id'];
	
	// $sql=pg_query($dbconn,"INSERT INTO review VALUES('$id')");
 //   $sql=pg_query($dbconn,"INSERT INTO delete VALUES('$id')");
	// $sql=pg_query($dbconn,"DELETE FROM initial WHERE videoid='$id'");
$sql=pg_query($dbconn,"PREPARE rev(text) as INSERT INTO review VALUES($1); EXECUTE rev('$id');");
$sql=pg_query($dbconn,"PREPARE transfer(text) as INSERT INTO delete VALUES($1); EXECUTE transfer('$id');");
$sql=pg_query($dbconn,"PREPARE bahar(text) as DELETE FROM initial i WHERE i.videoid=$1; EXECUTE bahar('$id');");
	echo 1;
	exit;
}

if(isset($_POST['id'])){
   $id=$_POST['id'];

 $sql=pg_query($dbconn,"PREPARE andar(text) as INSERT INTO DELETE VALUES($1); EXECUTE andar('$id');");
   $sql=pg_query($dbconn,"PREPARE bahar(text) as DELETE FROM initial i WHERE i.videoid=$1; EXECUTE bahar('$id');");
   //$sql=pg_query($dbconn,"INSERT INTO DELETE VALUES('$id')");
   //$sql=pg_query($dbconn,"DELETE FROM initial WHERE videoid='$id'");
   
   echo 1;
   pg_close($dbconn);
   exit;
}




echo 0;
pg_close($dbconn);
exit;


?>

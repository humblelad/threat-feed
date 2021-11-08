<?php  
$dbconn = pg_connect("host=localhost port=5432 dbname=mydbname user=myusername password=mypassword");  

if (!$dbconn){  
echo "<center><h1>Doesn't work =(</h1></center>";  
}  
// pg_close($dbconn);  

?>  

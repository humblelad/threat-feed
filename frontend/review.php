<?php  
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>LTF</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="bootbox.min.js"></script>
</head>
<body>
 
<div class="container">
  <h2>Review</h2>
  <center>


  <a href="index.php"><button type="button" class="btn btn-primary">Go Back</button></a>
   
  </center>

  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">Investigate More:</div>
      <div class="panel-body">
      
  
  <p>Click Link to open/Delete:</p>            

    <?php
     {
      echo '<table class="table table-striped">
    <thead>
      <tr>
        <th>YT Links:</th>
          </tr>
    </thead>
    <tbody>';
       $count=1;
  $result=pg_query($dbconn,"select * from review");
 while($row=pg_fetch_object($result))
  { $id = $row->videoid;

    echo '<tr>
    <td>'.$count.'</td>
        <td>';
   
echo '<a href="https://youtu.be/'.$id.'" target="_blank">'.$id.'</a>';
     echo "<br>";


  echo'</td>
        <td>

<button class="delete btn btn-danger btn-xs" id="'.$id.'" data-id="'.$id.'">Delete</button>
</td>
<td>';
$count=$count+1 ;
}          
      echo'</tr>
    </tbody>
  </table>
</div>      

    </div>';

 
  pg_close($dbconn);
}
?>
  <script>
    $(document).ready(function(){

  // Delete 
  $('.delete').click(function(){
    var el = this;
  
    // Delete id
    var actionid = $(this).data('id');
 
    // Confirm box
    bootbox.confirm("Do you really want to delete record?", function(result) {
 
       if(result){
         // AJAX Request
         $.ajax({
           url: 'delete.php',
           type: 'POST',
           data: { id:actionid },
           success: function(response){

             // Removing row from HTML Table
             
    $(el).closest('tr').css('background','tomato');
                $(el).closest('tr').fadeOut(800,function(){
       $(this).remove();
       //added this to refresh
       window.location.reload()
    });
       

    //    else{

    //     // some error as it is displaying even after success
    // bootbox.alert('Record not deleted.');
    //    }

           }
         });
       }
 
    });
 
  });
});


</script>
</body>
</html>




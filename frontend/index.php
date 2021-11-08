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
  <h2>LTF(Live Threat Feed)</h2>
<?php
$reviem=pg_query($dbconn,"select count(*) from review");
$d=pg_query($dbconn,"select count(*) from initial");
while ($row = pg_fetch_row($review)) {
     $rev = $row[0];
     
 }
 while ($row = pg_fetch_row($d)) {
     $tosee = $row[0];
     
 }


echo "
  
  <center>

<script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>
       <div id=\"piechart\" style=\"width: 500px; height: 300px;\"></div>
        <script> google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Under Verification',".$tosee."],
          ['Threat',".$rev."],
     
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    ";

    ?>
 
  <a href="review.php"><button type="button" class="btn btn-primary">Review Dashboard</button></a>
   
  </center>

  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">Links Pending:</div>
      <div class="panel-body">
      
  
  <p>Click Link to open/Add to review/Delete:</p>            

    <?php
     {
      echo '

      <table class="table table-striped">
    <thead>
      <tr>
        <th>YT Links:</th>
          </tr>
    </thead>
    <tbody>
    
      ';
       
  
  $result=pg_query($dbconn,"select * from initial");
      // $result=pg_query($dbconn,"SELECT initial.videoid FROM initial LEFT JOIN delete on delete.deleteid=initial.videoid WHERE delete.deleteid IS NULL ORDER BY videoid");
$count=1;
 while($row=pg_fetch_object($result))
  { 
   $id = $row->videoid;
     echo '<tr>
    <td>'.$count.'</td>
    <td>
<iframe src="https://www.youtube.com/embed/'.$id.'?loop=1" width="500" height="300" frameborder="0" allowfullscreen="1"></script></iframe>

    </td>
        ';
   
echo '<td><a href="https://youtu.be/'.$row->videoid.'" target="_blank">'.$row->videoid.'</a>';
     echo "<br>";


  echo'</td>
        <td>

<button class="delete btn btn-danger btn-xs" id="'.$id.'" data-id="'.$id.'">Delete</button>
</td>
<td>
<button class="review btn btn-primary btn-xs" id="'.$id.'" data-id="'.$id.'">Add to Review</button>
 </td>';
$count=$count+1;
}       
             
        
      echo'</tr>
    </tbody>
  </table>
</div>      
    </div> ';

 
  pg_close($dbconn);
}
?>
  <script>
    $(document).ready(function(){

  // Delete 
  $('.delete').click(function(){
    var el = this;
    <?php 
    $c=2; ?>
     
  
    // Delete id
    var actionid = $(this).data('id');
    
    // Confirm box
    bootbox.confirm("Do you really want to delete record?", function(result) {
 //dletefromhere
       if(result){
     
                 

         // AJAX Request
           $.ajax({
           url: 'ajaxfile.php',
           type: 'POST',
           data: { id:actionid },
           success: function(response){

             // Removing row from HTML Table
             if(response == 1){
    $(el).closest('tr').css('background','tomato');
                $(el).closest('tr').fadeOut(800,function(){
       $(this).remove();
    });
       }else{
    bootbox.alert('Record not deleted.');
       }

           }
         });
       }
 
    });
 
  });
});

//forreview

 $(document).ready(function(){

  // Delete 
  $('.review').click(function(){
    var el = this;
  
    // Delete id
    var actionid = $(this).data('id');
 
    // Confirm box
    bootbox.confirm("Want to investigate more?", function(result) {
 
       if(result){
         // AJAX Request
         $.ajax({
           url: 'ajaxfile.php',
           type: 'POST',
           data: { id:actionid,r:1 },
           success: function(response){

             // Removing row from HTML Table
             if(response == 1){
    $(el).closest('tr').css('background','tomato');
                $(el).closest('tr').fadeOut(800,function(){
       $(this).remove();
    });
       }else{
    bootbox.alert('Record not deleted.');
       }

           }
         });
       }
 
    });
 
  });
});

</script>

<script>
        
    </script>
</body>
</html>




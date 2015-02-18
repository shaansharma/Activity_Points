<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php
        
 // $con = mysqli_connect('10.11.143.151','group3','group3','group3');
  
  $con = mysqli_connect('localhost','root','root','g12cs'); 
        
  if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
        
        ?>
        
    </body>
</html>

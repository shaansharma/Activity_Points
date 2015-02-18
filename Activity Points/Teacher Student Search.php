<?php
session_start();
?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        
        <script src="JQuery.js"></script>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Teacher Student Search</title>
    </head>
    <body>
        
        <form action="Teacher Student Search Results.php" method="post">
         
        Student Number: <input type="text" name="StudentNumber" id="StudentNumber" class="search">
        First Name: <input type="text" name="FirstName" id="FirstName" class="search">
        Last Name: <input type="text" name="LastName" id="LastName" class="search">
            
        </form>    
        
        
        <script>

$(".search").keyup(function(){
    
   var StudentNumber = $('#StudentNumber').val();
   var FirstName = $('#FirstName').val();
   var LastName = $('#LastName').val();
   
  var Search_Data = StudentNumber + '?????' + FirstName + '?????' + LastName;
    
 $.ajax({
type: "GET",
url: "Teacher Student Search Results.php",
data: {query: Search_Data},
cache: false,
success: function(html)
    {
    $("#result").html(html).show();
    }
});    
});
</script>


<div id="result"></div>
        
        
    
        <?php
        
        include "Connection.php";
        
        if(isset($_POST['AddStudent'])){
            
            $query = "INSERT INTO club_member_table VALUES (" . $_POST['StudentNumber'] . ", '" . str_replace("Add student to ", "", $_POST['AddStudent']) . "');";
            mysqli_query($con, $query);
            
            echo $query;
            
        }
        
        if(isset($_POST['ViewPoints'])){
            
            $query = "SELECT * FROM activity_point_table WHERE Student_Number = " . $_POST['StudentNumber'] . "
             ORDER BY Date_of_Point_Reception ASC;";
        
        $result = mysqli_query($con, $query);
        
        if(mysqli_num_rows($result) == 0){
            
            echo 'Student has no activity points';
            
        }else{
            
            $totalPoints = 0;
            
            echo '<table border="1">';
            echo '<tr><td>Club</td><td>Points</td><td>Date</td></tr>';
            
            while($row = mysqli_fetch_array($result)){
                
            echo '<tr><td>' . $row['Club_Name'] . '</td><td>' . $row['Number_of_Points'] . '</td><td>' . $row['Date_of_Point_Reception'] . '</td></tr>'; 
            $totalPoints = $totalPoints + $row['Number_of_Points'];
            
            }
            
            echo '</table>';
            echo '<br>Total points: ' . $totalPoints;
            
        }
            
        }
        
        ?>
        
    </body>
</html>

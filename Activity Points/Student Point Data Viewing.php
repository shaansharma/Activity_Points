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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Student Point Data Viewing Page</title>
    </head>
    <body>
        
        <?php
        
        include "Connection.php";
        
        $studentNumber = $_SESSION['ID'];

        if(strlen($studentNumber) != 6){
            header('Location: http://localhost/Activity%20Points/Login.php');
        }
        
        $query = "SELECT * FROM activity_point_table WHERE Student_Number = " . $studentNumber . "
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
        
        ?>
        
    </body>
</html>

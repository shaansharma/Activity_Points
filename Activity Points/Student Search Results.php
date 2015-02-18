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
        <title></title>
    </head>
    <body>
        
        <?php
        
      include "Connection.php";

        if(isset($_POST['query'])){
        
           $searchData = explode('?????', $_POST['query']);
            
           $teamName = $searchData[0];
           $teacher = $searchData[1];
            
           $query = "SELECT club_table.Club_Name, teacher_user_table.Teacher_Name
              FROM club_table, teacher_user_table
               WHERE club_table.Teacher_Email = teacher_user_table.Teacher_Email AND
               teacher_user_table.Teacher_Name LIKE '%" . $teacher . "%' AND 
               club_table.Club_Name LIKE '%" . $teamName . "%';";
            
        }else{
            
         $query = "SELECT club_table.Club_Name, teacher_user_table.Teacher_Name
                  FROM club_table, teacher_user_table
                  WHERE club_table.Teacher_Email = teacher_user_table.Teacher_Email;";
         
        }
          
         $result = mysqli_query($con, $query);   
         echo $query;
         
         if(mysqli_num_rows($result) != 0){
         
         echo '<table border="1">';
         echo '<tr><td>Club</td><td>Teacher Sponsor</td><td>Join/Leave</td></tr>';

         
        while($row = mysqli_fetch_array($result)){
            
            echo '<form action="student_manage.php" method="post">';
           
           $query = "SELECT * FROM club_member_table WHERE Student_Number = " . $_SESSION['ID'] . " AND Club_Name = '" . $row['Club_Name'] . "';";
           $membership = mysqli_query($con, $query);
            
            if(mysqli_num_rows($membership) == 1){
                $membershipPrompt = 'Leave';
            }else{
                $membershipPrompt = 'Join';
            }
            
            echo '<tr><td>' . $row['Club_Name'] . '</td><td>' . $row['Teacher_Name'] . '</td><td><input type="submit" name="Action" value="' . $membershipPrompt . '"</td></tr>'; 
            echo '<input type="hidden" name="Club_Name" value="' . $row['Club_Name'] . '">';
            
            echo '</form>';
            
        }
        
        }else{
            
            echo 'No results found!';
            
            }
        
        ?>
        
    </body>
</html>

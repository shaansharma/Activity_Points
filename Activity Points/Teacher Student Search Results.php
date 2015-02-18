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
        
        if(isset($_GET['query'])){ 
            
        include "Connection.php";
        
        $searchData = $_GET['query'];
        
        $searchFields = explode('?????', $searchData);
        
        $studentNumber = $searchFields[0];
        $firstName = $searchFields[1];
        $lastName = $searchFields[2];
        
        $query = "SELECT * FROM club_table WHERE teacher_email = '" . $_SESSION['ID'] . "';";
        $results = mysqli_query($con, $query);
        
        while($row = mysqli_fetch_array($results)){
            
            $clubList[] = $row['Club_Name'];
            
        }
        
        
        
        $query = "SELECT * FROM student_table WHERE Student_Number LIKE '%" . $studentNumber . "%' AND First_Name LIKE '%" . $firstName . "%' AND Last_Name LIKE '%" . $lastName . "%';";
        $results = mysqli_query($con, $query);
        
        echo '<table border="1">';
        echo '<tr><td>Student Number</td><td>Student Name</td><td>View Activity Point Data</td>';
        
        if(count($clubList) != 0){
            
            foreach($clubList as $club){
                
                echo '<td>Add Student to ' . $club . ' </td>';
                
            }
            
        }
        
        echo '</tr>';
        
        
        
        while($row = mysqli_fetch_array($results)){
            
            echo '<form action="Teacher Student Search.php" method="post">';
            
            echo '<input type="hidden" name="StudentNumber" value="' . $row['Student_Number'] . '"';
            
            echo '<tr><td>' . $row['Student_Number'] . '</td><td>' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</td><td><input type="submit" name="ViewPoints" value="View Points"></td>';
            
            
            
            if(count($clubList) != 0){
            
            foreach($clubList as $club){
                
                $query = "SELECT * FROM club_member_table WHERE Student_Number = " . $row['Student_Number'] . " AND Club_Name = '" . $club . "';";
                $membershipCheck = mysqli_query($con, $query);
                
                if(mysqli_num_rows($membershipCheck) == 0){
                
                echo '<td><input type="Submit" Name="AddStudent" value="Add student to ' . $club . '"></td>';
                
                }else{
                    
                    echo '<td>Student Already Added!</td>';
                    
                }
            }
            
        }
            
            echo '</tr>';    
            
            echo '</form>';
            
        }
        
        
        
        echo '</table>';
        
        
        }
        
        ?>
        
    </body>
</html>

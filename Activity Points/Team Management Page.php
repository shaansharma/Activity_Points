<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Club Management</title>
    </head>
    <body>
        
        <?php
        
        if(isset($_GET['Action'])){

            $b = 0;
            while($b < 1){
                $b = $b + 1;
                header('Location :http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
            }
            
            $clubName = $_GET['Club_Name'];
           
        include "Connection.php";
        
        echo '<center><h1>' . $clubName . ' Management</h2></center>';
        
        $query = "SELECT * FROM club_member_table WHERE Club_Name = '" . $clubName . "';";
        $result = mysqli_query($con, $query);
       
echo '<form action="http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '" method="post">';    
        
        echo '<table border="1"><tr><td>Student Number</td><td>Student Name</td><td>Points Added This Year</td><td>Add Points</td><td>Delete Student</td></tr>';
        
        while($row = mysqli_fetch_array($result)){
            
            $currentMonth = date('M');
            if($currentMonth != 'Sep' && $currentMonth != 'Oct' && $currentMonth != 'Nov' && $currentMonth != 'Dec'){
                $referenceDate = date('Y') - 1 . "-09-04";
            }else{
                $referenceDate = date('Y') . "-09-04";
            }
            
            $query = "SELECT SUM(Number_of_Points) FROM activity_point_table WHERE Date_of_Point_Reception >= '" . $referenceDate . "' AND Club_Name = '" . $clubName . "' AND Student_Number = " . $row['Student_Number'] . ";";
            $pointSum = mysqli_query($con, $query);
            
            while($points = mysqli_fetch_array($pointSum)){
            
            $studentNumber = $row['Student_Number'];
            $studentNumbers[] = $studentNumber;
            
            $query = "SELECT * FROM Student_Table WHERE Student_Number = " . $studentNumber . ";";
            $results = mysqli_query($con, $query);
            
            while($rows = mysqli_fetch_array($results)){
            
                $pointsToAdd = 0;
                
            while($pointsToAdd <= 10 - $points['SUM(Number_of_Points)']){
                $pointArray[] = $pointsToAdd;
                $pointsToAdd = $pointsToAdd + 1;
            }    
   

            
        echo '<tr><td>' . $studentNumber . '</td><td>' . $rows['First_Name'] . ' ' . $rows['Last_Name'] . '</td><td>' . $points['SUM(Number_of_Points)'] . '</td><td><select name="AddPoints' . $studentNumber .'">';
        $a = 0;
        while(in_array($a, $pointArray)){
        echo '<option value="' . $a . '">' . $a . '</option>';
        $a = $a + 1;
        }
        echo '</select></td><td><input type="checkbox" name="Delete' . $studentNumber . '"></td></tr>';
        
            }
        
        
            } 
        } 
        
        echo '</table>';
       
        echo '<input type="Submit" name="AddPoints" value="Add Points">';
        echo '<input type="Submit" name="DeleteStudents" value="Delete Students">';
       
        echo '</form>';
        
        $query = "SELECT Open_Closed from club_table WHERE Club_Name = '" . $clubName . "';";
        $result = mysqli_query($con, $query);
        
        echo '<form action="http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '" method="post">';
        
        while($row = mysqli_fetch_array($result)){
            
            if($row['Open_Closed'] == 1){
                
                echo '<input type="submit" name="OpenorClose" value="Close">';
                
            }else{
                
               echo '<input type="submit" name="OpenorClose" value="Open"><br>';
               echo 'Clear All Previous Members <input type="checkbox" name="ClearPreviousMembers">';
                
            }
            
        }
        
        echo '</form>';
        
        
        if(isset($_POST['OpenorClose'])){
            
           if($_POST['OpenorClose'] == 'Close'){
           
           $query = "UPDATE club_table SET Open_Closed = " . 2 . " WHERE Club_Name = '" . $clubName . "';";
           mysqli_query($con, $query);
           echo $query;
           
           }else{
               
           $query = "UPDATE club_table SET Open_Closed = " . 1 . " WHERE Club_Name = '" . $clubName . "';";
           mysqli_query($con, $query);
           
           if(isset($_POST['ClearPreviousMembers'])){
               
               $query = "DELETE FROM club_member_table WHERE Club_Name = '" . $clubName . "';";
               mysqli_query($con, $query);
               
           }
           
           }
              
       }
        
       echo '<br>';

       var_dump($studentNumbers);
       
       
       if(isset($_POST['AddPoints'])){
         
           echo date('Y-m-N');
           $s = 0;
           
           while($s <= count($studentNumbers) - 1){
           
           if($_POST['AddPoints' . $studentNumbers[$s]] != 0){
               
               $query = "INSERT INTO activity_point_table VALUES (" . $studentNumbers[$s] . ", '" . $clubName . "', " . $_POST['AddPoints' . $studentNumbers[$s]] . ", '" . date('Y-m-N') . "');";
               mysqli_query($con, $query);     
               
           }
           
           $s = $s + 1;
           
           }         
       }
       
       
       if(isset($_POST['DeleteStudents'])){
           
           $s = 0;
                   
           while($s <= count($studentNumbers) - 1){
               
               if(isset($_POST['Delete' . $studentNumbers[$s]])){
                   
                   $query = "DELETE FROM club_member_table WHERE Student_Number = " . $studentNumbers[$s] . " AND Club_Name = '" . $clubName . "';";
                   mysqli_query($con, $query); 
                   
               }  
           
               $s = $s + 1;
               
        }        
       }
       
       
       
       }
        
       
       
      
       
        ?>
        
    </body>
</html>

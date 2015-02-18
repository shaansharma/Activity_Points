<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Master File Uploading Page</title>
    </head>
    <body>
        
        <form action="Master File Uploading Page.php" method="post">
        
        <input type='submit' name="Select" value="Select File">
        
        </form>
        
        
        <form action="Master File Uploading Page.php" method="post">
            
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='text' name='file' value=''> 
            <br><br>
            <input type='submit' name="Upload"  value='Upload File'>
            
        </form>
        
        
        
        <?php
        
        include "Connection.php";
        
        if(isset($_POST['Upload'])){
            
            $filePath = $_POST['file'];
            
            $studentData = file_get_contents($filePath);
            
            if(trim($studentData != '')){
            
            $query = "TRUNCATE TABLE student_table";
            mysqli_query($con, $query);
                
            $studentData = preg_replace( "/\r|\n/", ",", $studentData);
            
            $studentDataArray = explode(',', $studentData);
            
            $counter = 0;
            
            while($counter < count($studentDataArray)){
                
            if(ctype_alpha($studentDataArray[$counter]) && ctype_alpha($studentDataArray[$counter + 1]) && ctype_digit($studentDataArray[$counter + 2])){
                
                $lastName = $studentDataArray[$counter];
                $firstName = $studentDataArray[$counter + 1];
                $studentNumber = $studentDataArray[$counter + 2];
                $year = $studentDataArray[$counter + 6];
                $dateOfBirth = $studentDataArray[$counter + 7];
                
                $counter = $counter + 7;
                
                $query = "INSERT INTO student_table VALUES (" . $studentNumber . ", '" . $firstName . "', '" . $lastName . "', '19" . $dateOfBirth . "', '" . $year . "');";             
                
                mysqli_query($con, $query);
                
            }
            
            $counter = $counter + 1;
            
            }
                    
            echo "<script type='text/javascript'>
                
                alert('Student list successfully updated!');
                
                </script>";
            
        }
        }
        
        ?>
        
    </body>
</html>

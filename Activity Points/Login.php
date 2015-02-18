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
        <title>Login</title>
    </head>
    <body>
        
        <form method='post' action='Login.php'>
            
            Username: <input type='text' name='Username'><br><br>
            Password: <input type='password' name='Password'><br><br>
            <input type='submit' name='Login' value='Login'>
            
        </form>
        
        <?php
        
        include "Connection.php";
        
        if(isset($_POST['Login'])){
            
            $username = $_POST['Username'];
            $password = $_POST['Password'];
            
            $query = "SELECT * FROM student_table WHERE Student_Number = " . $username . " AND Date_of_Birth = " . $password . ";";
            echo $query;
            $result = mysqli_query($con, $query);
            
            if(mysqli_num_rows($result) != 1){
                
                echo "Invalid password and username combination!";
                
            }else{
                
                $_SESSION['ID'] = $username;
                
                header('Location: http://localhost/Activity%20Points/Student%20Point%20Data%20Viewing.php');
                
            }
            
        }
        
        ?>
        
    </body>
</html>

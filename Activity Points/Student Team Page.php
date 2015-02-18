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
            
            if($_POST['Action'] == 'Join'){
                
                $query = "INSERT INTO club_member_table VALUES (" . $_SESSION['ID'] . ", '" . $_POST['Club_Name'] . "');";
                
            }else{
                
                $query = "DELETE FROM club_member_table WHERE Student_Number = " . $_SESSION['ID'] . " AND Club_Name = '" . $_POST['Club_Name'] . "';";
                
            }
            
            mysqli_query($con, $query);
        
        ?>
        
    </body>
</html>

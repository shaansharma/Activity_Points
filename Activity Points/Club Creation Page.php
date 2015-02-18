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
        <title>Club Creation page</title>
    </head>
    <body>
        
        <form action="Club Creation Page.php" method="post">
            
            Club Name: <input type="text" name="ClubName" maxlength="50"><br><br>
            
            <input type="radio" name="Type" value="1">Athletic &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="Type" value="2">Non-Athletic<br><br>
            
            Maximum Number of Points: <input type="radio" name="Points" value="1">1 &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="Points" value="2">2 &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="Points" value="3">3 &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="Points" value="4">4 &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="Points" value="5">5 &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="Points" value="6">6 &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="Points" value="7">7 &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="Points" value="8">8 &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="Points" value="9">9 &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="Points" value="10">10<br><br>

        <input type="Submit" Name="CreateTeam" value="Create Team">                                
                                        
        </form>
        
        <?php
        
        if(isset($_POST['CreateTeam'])){
            
            include "Connection.php";
            
            $teacherEmail = $_SESSION['ID'];
            $clubName = $_POST['ClubName'];
            $type = $_POST['Type'];
            $maxPoints = $_POST['Points'];
            
            $query = "INSERT INTO club_table VALUES ('" . $clubName . "', '" . $teacherEmail . "', " . $type . ", 1, " . $maxPoints . ");";
            
            mysqli_query($con, $query);
            
            var_dump($query);
            
        }
        
        ?>
        
    </body>
</html>

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
        <title>Team Search</title>
                   
  

    </head>
    <body>
        
        <form action="Student Search Results.php" method="Post">
        
        <center>Club Name: <input type="text" name="TeamName" class="search" id="TeamName">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;              
        Teacher Sponsor: <input type="text" name="Teacher" class="search" id="Teacher"></center><hr>
        
        </form>
        
            <script>

$(".search").keyup(function(){
    
   var Team_Name = $('#TeamName').val();
   var Teacher = $('#Teacher').val();
   
  var Search_Data = Team_Name + '?????' + Teacher;
    
 $.ajax({
type: "POST",
url: "Teacher Search Results.php",
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

if(isset($_POST['Manage'])){
    
    header('Location: Team Management Page.php');
    
}

?>
        
    </body>
</html>

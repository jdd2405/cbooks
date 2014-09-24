<?php

require 'connection.php';

if (isset($_GET["email"]) && isset($_GET["username"]) && isset($_GET["password"])){
    $query = "INSERT INTO users (username, password, email) 
        VALUES('".$_GET["username"]."', '".$_GET["password"]."', '".$_GET["email"]."' ) "; 
    
    
    $result = mysqli_query($link, $query)  
    or die(mysqli_error());
    
    echo $result;
        
}
else {
    echo "Keine Angaben erhalten!";
}

mysqli_close($link);

?>
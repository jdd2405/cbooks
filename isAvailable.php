<?php    

require 'connection.php';

if(isset($_GET['key']) && isset($_GET['value'])){
    
    $key = $_GET['key'];
    $value = $_GET['value'];
    
    $result = mysqli_query($link,"SELECT * FROM user WHERE ".$key." = '".$value."'");

    if (mysqli_num_rows($result)>0){
        echo false;
     }
    
     else {
         echo true;
    }
}

else {
    echo "keine Daten übergeben";
}


?>
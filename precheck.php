<?php    

require('connection.php');

if(isset($_GET['name']) && isset($_GET['value'])){
    
    $name = $_GET['name'];
    $value = $_GET['value'];
    
    if($name=="email"){

        $result = mysqli_query($con,"SELECT * FROM user WHERE email = '".$value."'");

        if (mysqli_num_rows($result)>0){
            echo "E-Mail bereits registriert.";
        }
        else {
            echo "i.O.";
        }
    }
    
    else if($name=="username"){

        $result = mysqli_query($con,"SELECT * FROM user WHERE username = '".$value."'");

        if (mysqli_num_rows($result)>0){
            echo "Benutzername bereits vergeben.";
        }
        else {
            echo "i.O.";
        }
    }  

}

else {
    echo "keine Daten übergeben";
}


?>
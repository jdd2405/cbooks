<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    session_start();
    
    $hostname = $_SERVER['HTTP_HOST'];
    $path = dirname($_SERVER['PHP_SELF']);
    
    
    require('connection.php');
    
   



    if(isset($_GET['loginUsername']) && isset($_GET['loginPassword'])){

        $loginUsername = $_GET['loginUsername'];
        $loginPassword = $_GET['loginPassword'];

        $result = mysqli_query($con,"SELECT * FROM user WHERE username = '".$loginUsername."';");

        while($row = mysqli_fetch_array($result)) {
            if ($row['password']==$loginPassword){
                $_SESSION['isLoggedIn'] = true;
                
                // Weiterleitung zur geschützten Startseite
                if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
                    if (php_sapi_name() == 'cgi') {
                        header('Status: 303 See Other');
                    }
                    
                    else {
                        header('HTTP/1.1 303 See Other');
                    }
                }

               header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/login_portal.html');
               exit;
            }
        }
    }
    
    else {
        echo "Probleme...";
    }
}





     



//mysqli_close($con);





?>
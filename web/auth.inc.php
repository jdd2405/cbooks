<?php

// test if user is (still) authentificated
if(!isset($_SESSION['auth']) || $_SESSION['auth']==false){
    header("Location:logout.php");
}


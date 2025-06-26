<?php
if(!isset($_SESSION)){
    session_start();
}
    session_unset();
    session_destroy();

    header("Refresh: 1; url=http://localhost/softlineApp/login/index.php");
    exit();
    die();
?>
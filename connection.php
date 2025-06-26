<?php
function getConn(){
    $dns = "mysql:host=localhost;dbname=softlineapp;charset=utf8";
    $user = "root";
    $pass = "";

    try{
        $conn = new PDO($dns, $user, $pass);
        return $conn;
    }catch(PDOException $erro){
        return null;
    }
}
<?php

function Stfconn() {
        
    $servername = "mysql.sportofollow.com";
    $username = "stfadmin";
    $password = "Cameta0216";
    $dbname = "sportofollowdb";

    $stfconn = new mysqli($servername, $username, $password, $dbname);
    return $stfconn;
}


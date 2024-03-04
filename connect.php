<?php
    $server = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "latihan";

    $conn = mysqli_connect($server,$dbuser,$dbpass,$dbname);
    if(!$conn) {
        die("Connection failed".mysqli_connect_error());
    }
   
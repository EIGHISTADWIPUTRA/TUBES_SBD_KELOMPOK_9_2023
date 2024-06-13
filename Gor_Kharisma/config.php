<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $database ="Gor_Kharisma";

    $conn = mysqli_connect($host,$username,$password,$database);
    if(!$conn)
    {
        die ("Koneksi dengan database gagal: ".mysqli_connect_error());
    }

?>

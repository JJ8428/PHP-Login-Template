<?php
    $servername = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "BioTechSQL"; # Match the DB name in SQLi server
    $conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
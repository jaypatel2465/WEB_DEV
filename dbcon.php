
<?php
    $host = "localhost:3307";
    $un = "root";
    $pw = "";
    $database = "jobportal";

    $conn = new mysqli($host, $un, $pw, $database);

    if($conn -> connect_error){
        die("Connection failed: " . $conn -> connect_error);
    }

    echo "<link rel='icon' href='icon.ico' type='image/x-icon'>";
?>
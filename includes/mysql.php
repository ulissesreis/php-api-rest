<?php
//DRIVER MYSQL
//configurar seu banco de dados abaixo
$mysqli = new mysqli('HOSTNAME', 'USERNAME', 'PASSWORD', 'BASENAME');

if ($mysqli ->connect_errno) {
    echo "Errno: " .$mysqli->connect_errno;
    echo "<br>Error: " .$mysqli->connect_error;
    exit;
}
$mysqli->set_charset("utf8");

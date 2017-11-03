<?php

//primeiro fazemos a segurança da aplicaco REST

$security = false; //por enquanto estamos com os escudos abaixados
session_start();

if ($security) {
    //*Definir abaixo de acordo com sua matriz de acesso.
    if (!isset($_SESSION['email']) == true) {
        //Usuario nao fez login
        header('Content-Type: application/json');
        header('HTTP/1.1 401 Unauthorized');
        die('{}');
    }
}
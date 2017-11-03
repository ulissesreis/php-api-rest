<?php

function processaConsulta($query)
{
    require 'includes/mysql.php';

    if (!$result = $mysqli->query($query)) {
        $statusCode = 500;
        header("HTTP/1.1 " . $statusCode . " " . "Internal Server Error");
        die("{}");
    }

    $statusCode = 200;
    header('Content-Type: application/json; charset=utf8');
    header("Cache-Control: no-cache, must-revalidate");
    header("HTTP/1.1 " . $statusCode . " " . "Success");

    //Esta é a melhor pratica, no entanto, algumas hospedagens não oferecem suporte.
    //$data = $result->fetch_all(MYSQLI_ASSOC);
    //echo json_encode($data);
    //

    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);

    $result->close();
    $mysqli->close();
}

function getDados()
{
    return json_decode(file_get_contents('php://input'), true);
}

function processaInsert($query)
{
    $query = ajustarQuery($query);    
    require 'includes/mysql.php';

    if ($mysqli->query($query) === true) {
        $insert_id = mysqli_insert_id($mysqli);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }

    $mysqli->close();
    return $insert_id;
}

function processaDelete($query)
{
    require 'includes/mysql.php';

    if (!$mysqli->query($query) === true) {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
    $mysqli->close();
}

function processaUpdate($query)
{
    $query = ajustarQuery($query);    
    require 'includes/mysql.php';

    if (!$mysqli->query($query) === true) {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
    $mysqli->close();
}

function executaProcedure($query)
{
    $query = ajustarQuery($query);    
    require 'includes/mysql.php';

    if (!$mysqli->query($query) === true) {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
    $mysqli->close();
}
function escape($valor)
{
    if ($valor != null && $valor != '') {
        return addslashes($valor);
    } else {
        return 'null';
    }
}
function validarTexto($valor)
{
    if ($valor != null && $valor != '') {
          return true;
    } else {
        return false;
    }
}
function validarNumero($valor)
{
    if ($valor > 0) {
          return true;
    } else {
        return false;
    }
}

function ajustarQuery($query)
{ 
    //evitar erros na query
    $query= str_replace(" = ", "=", $query);
    $query= str_replace(", ", ",", $query);
    $query= str_replace(" ,", ",", $query);
    $query= str_replace("' ,", "',", $query);
    $query= str_replace("''", "NULL", $query);
    $query= str_replace("= ", "=", $query);
    $query= str_replace(" =", "=", $query);
    $query= str_replace("=,", "=NULL,", $query);     
    return $query;
}

<?php

require_once 'includes/validacoes.php';
require_once 'includes/funcoes.php';
if ($metodo == "GET") {//SELECT
    if (isset($_GET['pais'])) {
        $pais = $_GET['pais'];
    } else {
        $pais = "Brasil";
    }

    $query = ("SELECT nome,pais,sigla FROM estados e WHERE e.pais = '$pais'");

    processaConsulta($query);
}
if ($metodo == "POST") {//INSERT.
    $dados = getDados();
    
    $query = "INSERT INTO estados (nome,pais,sigla)
              VALUES ('" . escape($dados['nome']) . "','" . escape($dados['pais']) . "','" . escape($dados['sigla']) . "')";
  
     processaInsert($query);
}
if ($metodo == "PUT") {//UPDATE.
            
    $dados = getDados();
    
    $query = "UPDATE estados SET "
    ."nome = '" . escape($dados['nome']) . "',"
    ."sigla = '" . escape($dados['sigla']) . "'"
    ." WHERE id=". escape($dados['id']);
    
    processaUpdate($query);
}

//Pode-se usar o método DELETE passando o 'parametro do WHERE' via URL
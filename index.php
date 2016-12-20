<?php

require_once 'ConexaoInterface.php';
require_once 'MySqlConexao.php';
require_once 'TabelaInterface.php';
require_once 'Tabela.php';

$conexao = new MySqlConexao('localhost', 'crud', 'crud', 'Fre_12#76');

$agenda = new Tabela('curso', $conexao);


$post = [
    'nome' => 'Carlos',
    'telefone' => 212
];

$resultado = $agenda->selecionar(['id' => 1]);
var_dump($resultado);
<?php
$host = "mysql.railway.internal";
$usuario = "root";
$senha = "uKEXtVTcbibczwSvCRolXqFEzioLShPi";
$banco = "railway";
$porta = "3306";

$mysql = new mysqli($host, $usuario, $senha, $banco, $porta);

if ($mysqli->connect_errno){
  echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
    echo "Conectado com sucesso ao banco de dados!";
}
?>

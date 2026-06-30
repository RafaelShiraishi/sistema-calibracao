<?php
mysqli_report(MYSQLI_REPORT_OFF);

$host = getenv('MYSQLHOST') ?: "mysql.railway.internal";
$usuario = getenv('MYSQLUSER') ?: "root";
$senha = getenv('MYSQLPASSWORD') ?: "uKEXtVTcbibczwSvCRolXqFEzioLShPi";
$banco = getenv('MYSQLDATABASE') ?: "railway";
$porta = getenv('MYSQLPORT') ?: "3306";

$mysqli = mysqli_init();
if (!$mysqli) {
  die("Falha ao iniciar o componente MySQLi.");
}

if (!$conexao_sucesso) {
  echo "Não foi possível conectar ao banco de dados. Erro: " . mysqli_connect_error();
} else {
  echo "Conectado com sucesso ao banco de dados!";
}
?>

<?php
echo "<h1>Se você está lendo isso, o seu servidor PHP está 100% funcionando na nuvem!</h1>";
echo "<p>Para testar a conexão com o banco de dados, acesse o link adicionando /conexao.php no final da URL.</P>";
?>
<?php
(teste railway)

header('Content-Type: text/plain');

echo "PHP funcionando!\n";
echo "PHP_VERSION = " . PHP_VERSION . "\n";
echo "PWD = " . getcwd() . "\n";
echo "FILES:\n";

print_r(scandir('.'));
print_r(scandir('.'));

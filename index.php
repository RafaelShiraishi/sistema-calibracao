<?php

header('Content-Type: text/plain');

echo "PHP funcionando!\n";
echo "PHP_VERSION = " . PHP_VERSION . "\n";
echo "PWD = " . getcwd() . "\n";
echo "FILES:\n";

print_r(scandir('.'));

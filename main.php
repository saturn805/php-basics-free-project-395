<?php

require_once __DIR__ . '/PasswordGenerator.php';

use function hexlet\code\generatePassword;

// Помощник для переноса строки при неоднократном вызове функции
function println (string $value): void
{
    echo $value . PHP_EOL;
}

println(generatePassword(5));
println(generatePassword(30));
println(generatePassword(30, useUppercase: false, useDigits: false));
println(generatePassword(70, useSpecial: true));
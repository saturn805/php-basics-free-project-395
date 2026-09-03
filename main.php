<?php

require_once __DIR__ . '/PasswordGenerator.php';

use function hexlet\code\generatePassword;

// Помощник для переноса строки при неоднократном вызове функции
function println (string $value): void
{
    echo $value . PHP_EOL;
}

println(generatePassword(8, 1));
println(generatePassword(12, 123));
println(generatePassword(12, 123, useSpecial: true));
println(generatePassword(8, 1, useUppercase: false, useDigits: false));
println(generatePassword(-3, 42));
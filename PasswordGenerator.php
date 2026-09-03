<?php

namespace hexlet\code;

const LOWERCASE = 'abcdefghijklmnopqrstuvwxyz';
const UPPERCASE = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
const DIGITS = '0123456789';
const SPECIAL = '!@#$%^&*';

// Генерация псевдо-случайного числа
function nextRandom(int $number): int
{
    return (16807 * $number) % 2147483647;
}

// Основная функция генерации пароля
function generatePassword (
    int $length, 
    int $seed, 
    bool $useUppercase = true, 
    bool $useDigits = true, 
    bool $useSpecial = false
): string
{
    if ($length <= 0) {
        return '';
    }

    // Проверка на доступные параметры и сбор общего набора символов
    $availableSet = LOWERCASE;
    $availableSet .= $useUppercase ? UPPERCASE : '';
    $availableSet .= $useDigits ? DIGITS : '';
    $availableSet .= $useSpecial ? SPECIAL : '';

    $len = strlen($availableSet);

    $current = $seed;
    $result = '';

    for ($i = 0; $i < $length; $i++) {
        $current = nextRandom($current);
        $index = $current % $len;
        $result .= $availableSet[$index];
    }

    return $result;
}
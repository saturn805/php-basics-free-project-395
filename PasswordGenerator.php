<?php

namespace hexlet\code;

const LOWERCASE = 'abcdefghijklmnopqrstuvwxyz';
const UPPERCASE = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
const DIGITS = '0123456789';
const SPECIAL = '!@#$%^&*';

const MIN_LENGTH = 8;  // For the password length check condition


// ================================================
// Password generation
// ================================================

// Generation of a pseudo‑random number
function nextRandom(int $number): int
{
    return (16807 * $number) % 2147483647;
}

// Main function for password generation
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


// ================================================
// Main func for checking password strength
// ================================================
function checkPassword(string $password): string
{
    $estimation = 0;

    // Password length check
    if (isLongPassword($password)) {
        $estimation += 1;
    }

    // Check for lowercase letters
    if (hasLowercase($password)) {
        $estimation += 1;
    }

    // Check for uppercase letters
    if (hasUppercase($password)) {
        $estimation += 1;
    }

    // Check for the presence of digits
    if (hasDigits($password)) {
        $estimation += 1;
    }

    // Check for special characters
    if (hasSpecial($password)) {
        $estimation += 1;
    }

    // Reaching a verdict
    return getVerdict($estimation);
}

// ================================================
// Helper functions for checking password
// ================================================

// Password length check
function isLongPassword(string $password): bool
{
    if (strlen($password) >= MIN_LENGTH) {
        return true;
    }

    return false;
}

// Checking for lowercase letters in the password
function hasLowercase(string $password): bool
{
    foreach (str_split($password) as $char) {
        if (str_contains(LOWERCASE, $char)) {
            return true;
        }
    }

    return false;
}

// Checking for uppercase letters in the password
function hasUppercase(string $password): bool
{
    foreach (str_split($password) as $char) {
        if (str_contains(UPPERCASE, $char)) {
            return true;
        }
    }

    return false;
}

// Checking for numbers in the password
function hasDigits(string $password): bool
{
    foreach (str_split($password) as $char) {
        if (str_contains(DIGITS, $char)) {
            return true;
        }
    }

    return false;
}

// Checking for special characters in the password
function hasSpecial(string $password): bool
{
    foreach (str_split($password) as $char) {
        if (str_contains(SPECIAL, $char)) {
            return true;
        }
    }

    return false;
}

// Receiving the verdict
function getVerdict(int $estimation): string
{
    return match (true) {
        $estimation <= 2 => "Слабый пароль (оценка {$estimation} из 5)",
        $estimation === 3 => "Средний пароль (оценка {$estimation} из 5)",
        $estimation === 4 => "Надежный пароль (оценка {$estimation} из 5)",
        $estimation === 5 => "Очень надежный пароль (оценка {$estimation} из 5)",
    };
}
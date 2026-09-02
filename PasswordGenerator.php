<?php

namespace hexlet\code;

const LOWERCASE = 'abcdefghijklmnopqrstuvwxyz';

function generatePassword(int $length): string
{
    $alphabet = LOWERCASE;
    $len = strlen(LOWERCASE);
    $result = '';

    for ($i = 0; $i < $length; $i++) {
        $index = $i % $len;
        $result .= $alphabet[$index];
    }

    return $result;
}
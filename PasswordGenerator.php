<?php

namespace hexlet\code;

const LOWERCASE = 'abcdefghijklmnopqrstuvwxyz';
const UPPERCASE = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
const DIGITS = '0123456789';
const SPECIAL = '!@#$%^&*';

function generatePassword(
    int $length, 
    bool $useUppercase = true, 
    bool $useDigits = true,
    bool $useSpecial = false
): string
{
    $alphabet = LOWERCASE;
    $upperAlphabet = UPPERCASE;
    $someDigits = DIGITS;
    $specials = SPECIAL;

    $len = strlen(LOWERCASE);
    $upperLen = strlen(UPPERCASE);
    $digitsLen = strlen(DIGITS);
    $specialsLen = strlen(SPECIAL);

    $result = '';
    
    // Счетчики для каждого набора символов
    $lowerCounter = 0;
    $upperCounter = 0;
    $digitCounter = 0;
    $specialCounter = 0;

    for ($i = 0; $i < $length; $i++) {
        // Все три параметра включены
        if ($useUppercase && $useDigits && $useSpecial) {
            if ($i < $len) {
                $index = $lowerCounter % $len;
                $result .= $alphabet[$index];
                $lowerCounter++;
            } elseif ($i < $len + $upperLen) {
                $index = $upperCounter % $upperLen;
                $result .= $upperAlphabet[$index];
                $upperCounter++;
            } elseif ($i < $len + $upperLen + $digitsLen) {
                $index = $digitCounter % $digitsLen;
                $result .= $someDigits[$index];
                $digitCounter++;
            } else {
                $index = $specialCounter % $specialsLen;
                $result .= $specials[$index];
                $specialCounter++;
            }
        }
        // Только uppercase и digits (без special)
        elseif ($useUppercase && $useDigits) {
            if ($i < $len) {
                $index = $lowerCounter % $len;
                $result .= $alphabet[$index];
                $lowerCounter++;
            } elseif ($i < $len + $upperLen) {
                $index = $upperCounter % $upperLen;
                $result .= $upperAlphabet[$index];
                $upperCounter++;
            } else {
                $index = $digitCounter % $digitsLen;
                $result .= $someDigits[$index];
                $digitCounter++;
            }
        }
        // Только digits
        elseif (!$useUppercase && $useDigits) {
            if ($i < $len) {
                $index = $lowerCounter % $len;
                $result .= $alphabet[$index];
                $lowerCounter++;
            } else {
                $index = $digitCounter % $digitsLen;
                $result .= $someDigits[$index];
                $digitCounter++;
            }
        }
        // Только uppercase
        elseif ($useUppercase && !$useDigits) {
            if ($i < $len) {
                $index = $lowerCounter % $len;
                $result .= $alphabet[$index];
                $lowerCounter++;
            } else {
                $index = $upperCounter % $upperLen;
                $result .= $upperAlphabet[$index];
                $upperCounter++;
            }
        }
        // Ничего не включено (только lowercase)
        elseif (!$useUppercase && !$useDigits) {
            $index = $lowerCounter % $len;
            $result .= $alphabet[$index];
            $lowerCounter++;
        }
        // Uppercase и Special (без digits)
        elseif ($useUppercase && !$useDigits && $useSpecial) {
            if ($i < $len) {
                $index = $lowerCounter % $len;
                $result .= $alphabet[$index];
                $lowerCounter++;
            } elseif ($i < $len + $upperLen) {
                $index = $upperCounter % $upperLen;
                $result .= $upperAlphabet[$index];
                $upperCounter++;
            } else {
                $index = $specialCounter % $specialsLen;
                $result .= $specials[$index];
                $specialCounter++;
            }
        }
        // Digits и Special (без uppercase)
        elseif (!$useUppercase && $useDigits && $useSpecial) {
            if ($i < $len) {
                $index = $lowerCounter % $len;
                $result .= $alphabet[$index];
                $lowerCounter++;
            } elseif ($i < $len + $digitsLen) {
                $index = $digitCounter % $digitsLen;
                $result .= $someDigits[$index];
                $digitCounter++;
            } else {
                $index = $specialCounter % $specialsLen;
                $result .= $specials[$index];
                $specialCounter++;
            }
        }
        // Только Special
        elseif (!$useUppercase && !$useDigits && $useSpecial) {
            if ($i < $len) {
                $index = $lowerCounter % $len;
                $result .= $alphabet[$index];
                $lowerCounter++;
            } else {
                $index = $specialCounter % $specialsLen;
                $result .= $specials[$index];
                $specialCounter++;
            }
        }
    }

    return $result;
}
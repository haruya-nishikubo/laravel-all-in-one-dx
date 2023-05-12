<?php

if (! function_exists('alphabets_to_index')) {
    function alphabets_to_index(string $alphabets): int
    {
        $alphabets = strtoupper($alphabets);
        $alphabets = str_split($alphabets);
        $alphabets = array_reverse($alphabets);

        $index = 0;
        foreach ($alphabets as $key => $value) {
            $index += (ord($value) - 64) * pow(26, $key);
        }

        return $index - 1;
    }
}

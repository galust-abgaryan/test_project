<?php

/**
 * @param $string
 * @param string $delimiter
 * @param bool $isUcFirst
 * @return string
 */
function humanize($string, $delimiter = '_', $isUcFirst = true)
{
    $string  = \Illuminate\Support\Str::slug($string, '_');
    $result = explode(' ', str_replace($delimiter, ' ', $string));

    foreach ($result as & $word) {
        if ($isUcFirst) {
            $word = mb_strtoupper(mb_substr($word, 0, 1)) . mb_substr($word, 1);
        } else {
            $word = mb_substr($word, 0);
        }
    }

    return implode(' ', $result);
}

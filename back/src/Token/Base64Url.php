<?php
namespace Token;

class Base64Url
{
    public static function encode(string $text)
    {
        $base64 = base64_encode($text);

        $base64Url = str_replace(['+', '/', '='], ['-', '_', ''], $base64);

        return $base64Url;
    }

    public static function decode(string $base64Url)
    {
        $base64 = str_replace(['-', '_'], ['+', '/'], $base64Url);

        $pad = strlen($base64) % 4;
        if ($pad == 2) {
            $base64 .= '==';
        } else if ($pad === 3) {
            $base64 .= '=';
        }

        return base64_decode($base64);
    }
}

<?php

namespace Hoanguyencoder\HttpStatus\lib;

class CheckUrl
{
    public static function isUrl(string $uri): bool
    {
        return (bool) preg_match(
            '/^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}((:[0-9]{1,5})?\/.*)?$/i',
            $uri
        );
    }

    public static function check(string $url): int
    {
        if (!self::isUrl($url)) {
            return 0;
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $url = (strpos($url, '://') === false) ? 'http://' . $url : $url;

            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                return 0;
            }
        }

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_NOBODY => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_RETURNTRANSFER => true,
        ]);

        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE) ?: 0;
        curl_close($ch);

        return (int) $code;
    }
}

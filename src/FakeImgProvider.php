<?php

namespace Asper\Faker;

use Faker\Provider\Base as Provider;

class FakeImgProvider extends Provider
{
    const FONT_LOBSTER = 'lobster';
    const FONT_BEBAS = 'bebas';
    const FONT_MUSEO = 'museo';
    const FONT_NOTO = 'noto';

    public static function imageUrl($width = 640, int $height = null, string $background = null, string $color = null, string $text = null, bool $retina = false, string $font = null)
    {
        $baseUrl = 'https://fakeimg.pl/';
        $pattern = '{size}/{background}/{color}';
        $params = [];
        $query = [];

        if (is_array($width)) {
            extract($width);
        }

        // size
        $params['size'] = (!$height || $width === $height) ? $width : "${width}x${height}";

        // color
        $params['background'] = $color ? (strtoupper($background) ?: '_') : strtoupper($background);
        $params['color'] = strtoupper($color);

        // query
        $text && ($query['text'] = $text);
        (bool) $retina && ($query['retina'] = 1);
        $font && ($query['font'] = $font);

        $path = $pattern;
        foreach ($params as $key => $value) {
            $path = str_replace('{' . $key . '}', $value, $path);
        }

        $path = str_replace('//', '/', $path);
        $path = str_replace('_', '', $path);
        $path = rtrim($path, '/');

        return $baseUrl . $path . (count($query) ? '?' . http_build_query($query) : '');
    }
}

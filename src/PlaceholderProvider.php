<?php

namespace Asper\Faker;

use Faker\Provider\Base as Provider;

class PlaceholderProvider extends Provider
{
    public static function imageUrl($width = 640, int $height = null, string $background = null, string $color = null, string $text = null, string $extension = null)
    {
        $baseUrl = 'https://via.placeholder.com/';
        $pattern = '{filename}/{background}/{color}';
        $params = [];
        $query = [];

        if (is_array($width)) {
            extract($width);
        }

        // size and extension
        $params['filename'] = (!$height || $width === $height) ? $width : "${width}x${height}";
        if ($extension) {
            $params['filename'] .= '.' . $extension;
        }

        // color
        $params['background'] = $color ? (strtoupper($background) ?: '_') : strtoupper($background);
        $params['color'] = strtoupper($color);

        if ($text) {
            $query['text'] = $text;
        }

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

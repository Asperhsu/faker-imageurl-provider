<?php

namespace Asper\Faker;

use Faker\Provider\Base as Provider;

class PlaceholderProvider extends Provider
{
    public static function imageUrl(int $width = 640, int $height = null, string $extension = null, string $backgroundColor = null, string $textColor = null, string $text = null)
    {
        $baseUrl = 'https://via.placeholder.com/';
        $segments = [];
        $query = '';

        // size and extension
        $filename = (!$height || $width === $height) ? $width : "${width}x${height}";
        if ($extension) {
            $filename .= '.' . $extension;
        }
        $segments[] = $filename;

        // color
        if ($textColor) {
            $segments[] = strtoupper($backgroundColor);
            $segments[] = strtoupper($textColor);
        } else {
            $backgroundColor && ($segments[] = strtoupper($backgroundColor));
        }

        if ($text) {
            $query = '?' . http_build_query([
                'text' => $text,
            ]);
        }

        return $baseUrl . implode('/', $segments) . $query;
    }
}

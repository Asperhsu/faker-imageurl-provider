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
    
    public static function image($dir = null, int $width = 640, int $height = 480, bool $fullPath = true, string $background = null, string $color = null, string $text = null, string $extension = null ) 
	{
		$dir = is_null($dir) ? sys_get_temp_dir() : $dir;

		if (!is_dir($dir) || !is_writable($dir)) { 
			throw new Exception( sprintf('Cannot write to directory "%s"', $dir) );
		}

		$name = md5(uniqid(empty($_SERVER['SERVER_ADDR']) ? '' : $_SERVER['SERVER_ADDR'], true));
        $filename = $name .'.jpg';
        $filepath = $dir . DIRECTORY_SEPARATOR . $filename;

		$url = static::imageUrl($width, $height, $background, $color, $text, $extension );

		if (function_exists('curl_exec')) {
			$fp = fopen($filepath, 'w');
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            $success = curl_exec($ch) && curl_getinfo($ch, CURLINFO_HTTP_CODE) === 200;
            fclose($fp);
            curl_close($ch);

			if (!$success) {
                unlink($filepath);

                // could not contact the distant URL or HTTP error - fail silently.
                return false;
            }
		} elseif(ini_get('allow_url_fopen')) {
			$success = copy($url, $filepath);
		} else {
			throw new Exception('The image formatter downloads an image from a remote HTTP server. Therefore, it requires that PHP can request remote hosts, either via cURL or fopen()');
		}

		return $fullPath ? $filepath : $filename;
	}
}

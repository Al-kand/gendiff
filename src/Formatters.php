<?php

namespace Differ\Formatters;

use function Differ\Formatters\{plain, stylish, json};

function format(array $data, string $format): string
{
    switch ($format) {
        case 'stylish':
            $result = stylish($data);
            break;
        case 'plain':
            $result = plain($data);
            break;
        case 'json':
            $result = json($data);
            break;
        default:
            throw new \Exception("Unknown format");
    }
    return $result;
}

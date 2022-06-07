<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse(string $path): object
{
    $content = file_get_contents($path);
    if ($content === false) {
        throw new \Exception("Error file reading {$path}");
    }

    $type = pathinfo($path, PATHINFO_EXTENSION);

    switch ($type) {
        case 'json':
            $parsingData = json_decode($content, false);
            break;
        case 'yaml':
        case 'yml':
            $parsingData = Yaml::parse($content, Yaml::PARSE_OBJECT_FOR_MAP);
            break;
        default:
            $parsingData = false;
    }

    if ($parsingData === false) {
        throw new \Exception("Unknown file type {$type}");
    }
    return $parsingData;
}

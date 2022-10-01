<?php

namespace Differ\Formatters;

const TAB = "    ";

function stylish(array $data, int $depth = 0): string
{
    $lines = array_map(
        fn ($item) => makeLine($item, $depth),
        $data
    );
    $result = ['{', ...$lines, str_repeat(TAB, $depth) . '}'];

    return implode(PHP_EOL, $result);
}

function makeLine(array $node, int $depth = 0): string
{
    $types = ['children', 'value', 'expectedValue', 'currentValue'];
    $key = $node['name'];

    $currentTypes = array_filter(
        $types,
        fn ($type) =>
        array_key_exists($type, $node)
    );

    $lines = array_map(
        function ($type) use ($key, $node, $depth) {
            $currentNode = $node[$type];
            $stringKey = makeIndent($depth) . getPrefix($type) . $key . ": ";
            $value = is_array($currentNode) ? stylish($currentNode, $depth + 1) : toString([$currentNode]);
            return $stringKey . $value;
        },
        $currentTypes
    );

    return implode(PHP_EOL, $lines);
}

function makeIndent(int $depth): string
{
    return str_repeat(TAB, $depth);
}

function getPrefix(string $type): string
{
    switch ($type) {
        case 'expectedValue':
            return substr_replace(TAB, '- ', -2);
        case 'currentValue':
            return substr_replace(TAB, '+ ', -2);
    }
    return TAB;
}

function toString(array $data): string
{
    $value = $data[0];
    $string = json_encode($value);
    if ($string === false) {
        throw new \Exception("Unknown format");
    }
    return trim($string, '"');
}

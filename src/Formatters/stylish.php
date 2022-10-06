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
            $stringKey = makeIndentAndPrefix($depth, $type) . $key . ": ";
            $value = is_array($currentNode) ? stylish($currentNode, $depth + 1) : toString($currentNode);
            return $stringKey . $value;
        },
        $currentTypes
    );

    return implode(PHP_EOL, $lines);
}

function makeIndentAndPrefix(int $depth, string $type): string
{
    $indent = str_repeat(TAB, $depth + 1);

    switch ($type) {
        case 'expectedValue':
            $result = substr_replace($indent, '-', -2, 1);
            break;
        case 'currentValue':
            $result = substr_replace($indent, '+', -2, 1);
            break;
        default:
            $result = $indent;
    }
    return $result;
}

function toString(mixed $data): string
{
    $string = var_export($data, true);

    if (is_null($data)) {
        return 'null';
    }

    return trim($string, "'");
}

<?php

namespace Differ\Formatters;

function plain(array $data, string $path = ''): string
{
    $result = array_map(
        fn ($node) => makePlainLine($node, $path),
        $data
    );

    return implode(PHP_EOL, array_filter($result));
}

function makePlainLine(array $node, string $keys): string
{
    $path = $keys === '' ? $node['name'] : "{$keys}.{$node['name']}";
    $type = $node['type'] ?? '';

    switch ($type) {
        case 'object':
            return plain($node['children'], $path);
        case 'deleted':
            $message = "was removed";
            break;
        case 'added':
            $value = stringify($node['currentValue']);
            $message = "was added with value: {$value}";
            break;
        case 'updated':
            $value1 = stringify($node['expectedValue']);
            $value2 = stringify($node['currentValue']);
            $message = "was updated. From {$value1} to {$value2}";
            break;
        default:
            return '';
    }
    return "Property '{$path}' {$message}";
}

function stringify(mixed $data): string
{
    if (is_array($data)) {
        return '[complex value]';
    }

    if (is_null($data)) {
        return 'null';
    }

    return var_export($data, true);
}

<?php

$tree = [
    [
        'id' => '8',
        'parent_id' => '6',
    ],
    [
        'id' => '2',
        'parent_id' => '1',
    ],
    [
        'id' => '3',
        'parent_id' => '1',
    ],
    [
        'id' => '4',
        'parent_id' => '1',
    ],
    [
        'id' => '5',
        'parent_id' => '2',
    ],
    [
        'id' => '1',
        'parent_id' => '0',
    ],
    [
        'id' => '6',
        'parent_id' => '2',
    ],
    [
        'id' => '7',
        'parent_id' => '3',
    ],
];

// т.к. id всегда уникальны сделаем их ключами, а значением будет являться id родителя
$tree = array_combine(array_column($tree, 'id'), array_column($tree, 'parent_id'));
getTreeRecursive($tree);

function getTreeRecursive(array $tree, array $treePart = [], int $currentParentId = 0)
{
    foreach ($tree as $id => $parentId) {
        if ($currentParentId === (int)$parentId) {
            $updatedTreePart = array_merge($treePart, [$id]);
            echo implode('.', $updatedTreePart) . "\n";
            getTreeRecursive($tree, $updatedTreePart, $id);
        }
    }
}

<?php
$a = [ 1, 2, [ [ 9, 10, [ 11 ] ], 7, 8 ], 3, 5 ];

array_walk_recursive( $a, static function (&$item) {
    $item *= 2;
});

var_dump($a);

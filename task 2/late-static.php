<?php

/*
 * Для того чтобы выводилось корректное имя класса вместо __CLASS__ используем get_class($this)
 * Для корректного вывода константы используем позднее статическое связывание вместо self используем static
 */
class a {
    const TYPE = 'A Class';

    public function getType()
    {
        echo 'This is class: ' . get_class($this) . ', type ' . static::TYPE;
    }
}

class b extends a {
    const TYPE = 'B Class';
}

$a = new a();
$b = new b();
$a->getType();
$b->getType();

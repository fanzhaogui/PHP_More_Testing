<?php


$rules = [
    0 => ['rid' => 11, 'name1' => 'angle', 'age' => 11],
    1 => ['rid' => 22, 'name2' => 'angle2', 'age' => 12],
    2 => ['rid' => 33, 'name3' => 'angle3', 'age' => 11],
    3 => ['rid' => 11, 'name4' => 'angle4', 'age' => 44],
];

// $ret = [11, 12, 11]
$ret1 = array_column($rules, 'age');
var_dump($ret1);

// rid为键，子数组为值, rid值相同的，会覆盖
$ret2 = array_column($rules, null, 'rid');
var_dump($ret2);
// 以上相当于
$ret3 = [];
foreach ($rules as $r) {
    $ret3[$r['rid']] = $r;
}
var_dump($ret3);
// output
//$rules = [
//    11 => ['rid' => 11, 'name' => 'angle4', 'age' => 44],
//    22 => ['rid' => 22, 'name' => 'angle2', 'age' => 12],
//    33 => ['rid' => 33, 'name' => 'angle3', 'age' => 11],
//];


// rid为键，age 为值 rid值相同的，会覆盖
$ret4 = array_column($rules, 'rid', 'age');
var_dump($ret4);
// 以上相当于
$ret5 = [];
foreach ($rules as $r) {
    $ret5[$r['rid']] = $r['age'];
}
var_dump($ret5);


// 当取的下标对应的是数组
$a1 = [
    [
        'id' => 1,
        'room' => ['a', 'b', 'c'],
        'hotel' => [
            [1],
            [2],
            [3],
        ],
    ],
    [
        'id' => 2,
        'room' => ['q', 'r', 'y'],
        'hotel' => [
            [11],
            [22],
            [33],
        ],
    ],
];

$a1to2 = array_column($a1, 'hotel');
// $a1to2 = array_column($a1, 'id', 'room'); // 为room为数组时，新数组的下标从0开始自增
echo "<pre>";
print_r($a1to2);
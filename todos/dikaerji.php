<?php


// 笛卡尔积

$input = [
    ["16G", "128G", "64G"],
    ["深灰色", "银色", "金色"],
    ["XXX", "MM", "PPP"],
];


$output = array_reduce($input, function($result, $cross_item){
    if(!$result){
        return array_map(function($item){
            return [$item];
        }, $cross_item);
    }

    return array_reduce($cross_item, function($acc, $target) use ($result){

        return array_merge($acc, array_map(function($result_item) use ($target){
            $result_item[] = $target;

            return $result_item;
        }, $result));

    }, []);

}, []);


echo "<pre>";

print_r($output);
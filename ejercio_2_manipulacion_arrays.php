<?php

function orderBy($array, $orderBy) {
    $data = [];
    foreach ($orderBy as $campo=>$criterio) {
        $sortByCampo = array_filter($array, function($v) use ($campo){
            return !empty($v[$campo]);
        });
        $sortByCampo = array_shift($sortByCampo);
        if (!empty($sortByCampo)) {
            $arraySort = array_column($array, $campo);      
            if ($criterio == 'ASC') {
                array_multisort($arraySort,SORT_ASC, $array);    
            } else {
                array_multisort($arraySort,SORT_DESC, $array);    
            }
            $data["{$campo}_SORT_{$criterio}"] = $array;
        } else {
            if ($criterio == 'DESC') {
                $data = array_merge($data,["{$campo}_SORT_{$criterio}"=>[]]); 
            } else if ($criterio == 'ASC') {
                $data = array_merge(["{$campo}_SORT_{$criterio}"=>[]],$data); 
            } else {
                $data = array_merge($data,["{$campo}"=>'no sorting']); 
            }
        }
    }
    return $data;
}

$array = [ 
    ['user' => 'Oscar', 'age' => 18, 'scoring' => 40], 
    ['user' => 'Mario', 'age' => 45, 'scoring' => 10], 
    ['user' => 'Zulueta', 'age' => 33, 'scoring' => -78],  
    ['user' => 'Mario', 'age' => 45, 'scoring' => 78], 
    ['user' => 'Patricio', 'age' => 22, 'scoring' => 9], 
]; 

$sortCriterion = [
    'age' => 'DESC',
    'scoring'=>'DESC',
    'user'=>'ASC',
    'lastName'=>'daa'
]; 
$result = orderBy($array,$sortCriterion);
print_r($result);
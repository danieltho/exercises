<?php

function orderBy($array = [], $orderBy) {
    $data = [];
    if (!empty($orderBy)) {    
        if (!empty($orderBy['age'])) {
            $keys = array_column($array, 'age');
            $sort = "SORT_".$orderBy['age'];
            array_multisort($keys, SORT_DESC, $array);
            $data['age'] = $array;
            
        }
        
        if (!empty($orderBy['scoring'])) {
            $keys = array_column($array, 'scoring');
            $sort = "SORT_".$orderBy['scoring'];
            array_multisort($keys, SORT_DESC, $array);
            $data['scoring'] = $array;
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

$sortCriterion = ['age' => 'DESC', 'scoring' => 'DESC']; 
$result = orderBy($array, $sortCriterion); 

print_r($result);
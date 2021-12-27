<?php
/*
Implementar una función PHP que ordene un array de arrays. La función recibirá dos parámetros, el primero con el array a ordenar, y el segundo parámetro será otro array con el criterio de ordenación, donde la key de cada elemento de este segundo array indicará sobre que propiedad hay que ordenar, y el valor de cada elemento indicará la dirección de ordenamiento (ascendente(ASC) o descendente (DESC)). 

Por ejemplo, para el siguiente array y criterio de ordenación. 
$array = [ 
 ['user' => 'Oscar', 'age' => 18, 'scoring' => 40], 
 ['user' => 'Mario', 'age' => 45, 'scoring' => 10], 
 ['user' => 'Zulueta', 'age' => 33, 'scoring' => -78],  
 ['user' => 'Mario', 'age' => 45, 'scoring' => 78], 
 ['user' => 'Patricio', 'age' => 22, 'scoring' => 9], 
]; 
$sortCriterion = ['age' => 'DESC', 'scoring' => 'DESC']; 
$result = fn($array, $sortCriterion); 
// $result es  
[ 
 ['user' => 'Mario', 'age' => 45, 'scoring' => 78], 
 ['user' => 'Mario', 'age' => 45, 'scoring' => 10], 
 ['user' => 'Zulueta', 'age' => 33, 'scoring' => -78], 
 ['user' => 'Patricio', 'age' => 22, 'scoring' => 9], 
 ['user' => 'Oscar', 'age' => 18, 'scoring' => 40], 
];
Si alguno de los elementos del array a ordenar no contiene la key por la que se pide ordenar, el valor para esa key se considerará null y el elemento se devolverá al principio de la lista si el orden es ASC o al final si el orden es DESC. 
La función que desarrolles permitirá que el segundo parámetro puede ser null, pero en ese caso devolverá el resultado sin ningún tipo de reordenación. 
El caso mostrado es solo un ejemplo, se ha de tener en cuenta que podría aceptar cualquier otro array con keys diferentes.*/

function orderBy($array = [], $orderBy = []) {
    $columnOrder = [];
    foreach ($orderBy as $campo=>$criterio) {
        $sortByCampo = array_filter($array, function($v) use ($campo){
            return !empty($v[$campo]);
        });
        $sortByCampo = array_shift($sortByCampo);
        if (!empty($sortByCampo)) {
            $columnOrder[$campo] = [
                array_column($array, $campo)
                $criterio == 'ASC' ? SORT_ASC : SORT_DESC
            ];
        }
    }
    if (!empty($columnOrder)) {
        //$columns_1, SORT_ASC, $columns_2, SORT_DESC
        $orderBy = implode(',', $columnOrder);    
        array_multisort($orderBy, $array);
    }
    return $array;
}

$array = [ 
    ['user' => 'Oscar', 'age' => 18, 'scoring' => 40], 
    ['user' => 'Mario', 'age' => 45, 'scoring' => 10], 
    ['user' => 'Zulueta', 'age' => 33, 'scoring' => -78],  
    ['user' => 'Mario', 'age' => 45, 'scoring' => 78], 
    ['user' => 'Patricio', 'age' => 22, 'scoring' => 9], 
]; 

$sortCriterion = ['age' => 'DESC', 'scoring' => 'DESC','users'=>'DESC']; 
$result = orderBy($array, $sortCriterion); 

print_r($result);
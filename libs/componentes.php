<?php




// Función para pintar un checkbox con los valores que nos pasan por un array

function pintaCheck(array $valores, string $name){
    foreach($valores as $key=>$valor){
    echo '<label><input type="checkbox" name="'.$name.'[]" value='.$valor.'>'.$valor.'</label>';
    };
};

function pintaRadio(array $valores, string $name){
    foreach($valores as $key=>$valor){
        echo '<input type="radio" name="'.$name.'" value="'.$valor.'">'. $valor.'<br>';

    };
};





?>
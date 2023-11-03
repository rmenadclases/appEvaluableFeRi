<?php
/****
 * Librería con funciones generales y de validación
 * @author Heike Bonilla
 * 
 */

function cabecera($titulo="") // el archivo actual
{
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>	<?= $titulo ?> </title>
<meta charset="utf-8" />
</head>
<body>
<?php
}

function pie()
{
    echo "</body>
	</html>";
}


//***** Funciones de sanitización **** //


/**
 * funcion sinTildes
 *
 * Elimina caracteres con tilde de las cadenas
 * 
 * @param string $frase
 * @return string
 */

function sinTildes($frase):string
{
    $no_permitidas = array(
        "á",
        "é",
        "í",
        "ó",
        "ú",
        "Á",
        "É",
        "Í",
        "Ó",
        "Ú",
        "à",
        "è",
        "ì",
        "ò",
        "ù",
        "À",
        "È",
        "Ì",
        "Ò",
        "Ù"
    );
    $permitidas = array(
        "a",
        "e",
        "i",
        "o",
        "u",
        "A",
        "E",
        "I",
        "O",
        "U",
        "a",
        "e",
        "i",
        "o",
        "u",
        "A",
        "E",
        "I",
        "O",
        "U"
    );
    $texto = str_replace($no_permitidas, $permitidas, $frase);
    return $texto;
}

/**
 * Funcion sinEspacios
 * 
 * Elimina los espacios de una cadena de texto
 * 
 * @param string $frase
 * @param string $espacio
 * @return string
 */

function sinEspacios($frase)
{
    $texto = trim(preg_replace('/ +/', ' ', $frase));
    return $texto;
}


/**
 * Funcion recoge
 * 
 * Sanitiza cadenas de texto
 * 
 * @param string $var
 * @return string
 */

function recoge(string $var)
{
    if (isset($_REQUEST[$var])&&(!is_array($_REQUEST[$var]))){
        $tmp=sinEspacios($_REQUEST[$var]);
        $tmp = strip_tags($tmp);
    }
    else
        $tmp = "";

    return $tmp;
}

/**
 * Funcion recogeArray
 * 
 * Sanitiza arrays
 * 
 * @param string $var
 * @return array
 */

function recogeArray(string $var):array
{
    $array=[];
    if (isset($_REQUEST[$var])&&(is_array($_REQUEST[$var]))){
        foreach($_REQUEST[$var] as $valor)
        $array[]=strip_tags(sinEspacios($valor));
        
    }
    
    return $array;
}
   


//***** Funciones de validación **** //

/**
 * Funcion cTexto
 *
 * Valida una cadena de texto con respecto a una RegEx. Reporta error en un array.
 * 
 * @param string $text
 * @param string $campo
 * @param array $errores
 * @param integer $min
 * @param integer $max
 * @param bool $espacios
 * @param bool $case
 * @return bool
 */


function cTexto(string $text, string $campo, array &$errores, int $max = 30, int $min = 1, bool $espacios = TRUE, bool $case = TRUE):bool
{
    $case=($case===TRUE)?"i":"";
    $espacios=($espacios===TRUE)?" ":"";
    if ((preg_match("/^[a-zñ$espacios]{" . $min . "," . $max . "}$/u$case", sinTildes($text)))) {
        return true;
    }
    $errores[$campo] = "Error en el campo $campo";
     return false;
}
    
//***** Funciones de validación **** //

/**
 * Funcion cNum
 *
 * Valida que un string sea numerico menor o igual que un número y si es o no requerido
 * 
 * @param string $text
 * @param string $campo
 * @param array $errores
 * @param bool $requerido
 * @param integer $max
 * @return bool
 */    
function cNum(string $num, string $campo, array &$errores, bool $requerido=TRUE, int $max=PHP_INT_MAX):bool
{   $cuantificador= ($requerido)?"+":"*";
            if ((preg_match("/^[0-9]".$cuantificador."$/", $num))) {
    
            if ($num<=$max) return true;
        }
        $errores[$campo] = "Error en el campo $campo";
        return false;
}

function creayValidaConexion(string $nombre, string $password,string $campo,array &$errores){
    $userPrueba="rmenad";
$passWordPrueba="rmenad";
    if($nombre==$userPrueba && $password==$passWordPrueba){
        session_start();
        $_SESSION["username"]=$nombre;
        return true;
        //header("location:pagina1.php?");        
        }else{
            $errores[$campo] = "Los datos introducidos no son válidos";
            return false;            
        }        
}

/**
 * Funcion cRadio
 *
 * Valida que un string se encuentre entre los valores posibles. Si es requerido o no
 * 
 * @param string $text
 * @param string $campo
 * @param array $errores
 * @param array $valores
 * @param bool $requerido
 * 
 * @return boolean
 */
function cRadio (string $text, string $campo, array &$errores, array $valores, bool $requerido=TRUE)
{
        if (in_array($text, $valores)){
                return true;
            }
        if (!$requerido && $text==""){
        return true;
        }
        $errores[$campo] = "Error en el campo $campo";
        return false;


}

/**
 * Funcion cCheck
 *
 * Valida que los valores seleccionado en un checkbox array están dentro de los 
 * valores válidos dados en un array. Si es requerido o no
 * 
 * 
 * @param array $text
 * @param string $campo
 * @param array $errores
 * @param array $valores
 * @param bool $requerido
 * 
 * @return boolean
 */

function cCheck (array $text, string $campo, array &$errores, array $valores, bool $requerido=TRUE)
{
   
    if (($requerido) && (count($text)==0)){
        $errores[$campo] = "Error en el campo $campo";
        return false;
        }
    foreach ($text as $valor){
        if (!in_array($valor, $valores)){
            $errores[$campo] = "Error en el campo $campo";
            return false;
        }
        
    }
    return true;
}



/**
 * Funcion cFile
 * 
 * Valida la subida de un archivo a un servidor.
 *
 * @param string $nombre
 * @param array $extensiones_validas
 * @param string $directorio
 * @param integer $max_file_size
 * @param array $errores
 * @param boolean $required
 * @return boolean|string
 */
function cFile(string $nombre, array &$errores, array $extensiones_validas, string $directorio, int  $max_file_size,  bool $required = TRUE): bool|string
{

    if ((!$required) && $_FILES[$nombre]['error'] === 4)  // el campo de file no es requerido y no se intenta subir ningun archivo
        return true;

    if ($_FILES[$nombre]['error'] != 0) {                   // se comprueban los errores del servidor 
        $errores["$nombre"] = "Error al subir el archivo " . $nombre . ". Prueba de nuevo";
        return false;
    } else {

        $nombreArchivo_original = strip_tags($_FILES[$nombre]['name']);
        $filesize = $_FILES[$nombre]['size'];
        $directorioTemp = $_FILES[$nombre]['tmp_name'];
        $arrayInfoArchivo = pathinfo($nombreArchivo_original);

        $extension = $arrayInfoArchivo['extension'];
        if (!in_array($extension, $extensiones_validas)) {
            $errores["$nombre"] = "La extensión del archivo no es válida o no se ha subido ningún archivo";
        }
        // Comprobamos el tamaño del archivo
        if ($filesize > $max_file_size) {
            $errores["$nombre"] = "La imagen debe de tener un tamaño inferior a 50 kb";
        }

        // Almacenamos el archivo en ubicación definitiva si no hay errores ( al compartir array de errores TODOS LOS ARCHIVOS tienen que poder procesarse para que sea exitoso. Si cualquiera da error, NINGUNO  se procesa)

        if (empty($errores)) {
            $nombreArchivo = $arrayInfoArchivo['filename'] . time();
            $nombreCompleto = $directorio . $nombreArchivo . "." . $extension;
            // Movemos el fichero a la ubicación definitiva
            if (move_uploaded_file($directorioTemp, $nombreCompleto)) {

                return  $nombreArchivo;
            } else {
                $errores["$nombre"] = "Error: No se puede mover el fichero a su destino";
                return false;
            }
        } else {
            return false;
        }
    }
}

?>
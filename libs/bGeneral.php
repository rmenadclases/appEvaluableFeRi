<?php
/****
 * Librería con funciones generales y de validación
 * @author Heike Bonilla
 * 
 */

function cabecera($titulo = "") // el archivo actual
{
    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <title>
            <?= $titulo ?>
        </title>
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

function sinTildes($frase): string
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
    if (isset($_REQUEST[$var]) && (!is_array($_REQUEST[$var]))) {
        $tmp = sinEspacios($_REQUEST[$var]);
        $tmp = strip_tags($tmp);
    } else
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

function recogeArray(string $var): array
{
    $array = [];
    if (isset($_REQUEST[$var]) && (is_array($_REQUEST[$var]))) {
        foreach ($_REQUEST[$var] as $valor)
            $array[] = strip_tags(sinEspacios($valor));

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


function cTexto(string $text, string $campo, array &$errores, int $max = 30, int $min = 1, bool $espacios = TRUE, bool $case = TRUE): bool
{
    $case = ($case === TRUE) ? "i" : "";
    $espacios = ($espacios === TRUE) ? " " : "";
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
function cNum(string $num, string $campo, array &$errores, bool $requerido = TRUE, int $max = PHP_INT_MAX): bool
{
    $cuantificador = ($requerido) ? "+" : "*";
    if ((preg_match("/^[0-9]" . $cuantificador . "$/", $num))) {

        if ($num <= $max)
            return true;
    }
    $errores[$campo] = "Error en el campo $campo";
    return false;
}

$primeraVez = true;
function creayValidaConexion1(string $nombre, string $password, string $campo, array &$errores, string $nombreCompleto, string $correoElectronico,string $imagen,string $idioma)
{
    session_start();

    $tieneError = 0;

    // Verifica si la variable de sesión 'usuarios' existe
    if (isset($_SESSION['usuarios'])) {
        $datosSesion = $_SESSION['usuarios']; // Obtiene la variable de sesión 'usuarios'

        foreach ($datosSesion as $subarray) {
            // Verifica si el valor existe en el subarray "usuario"
            if (isset($subarray["usuario"]) && $subarray["usuario"] === $nombre) {
                // El valor se encontró en el subarray "usuario"
                $tieneError++;
            }
        }
    }

    if ($tieneError >= 1) {
        return false;
    } else {
        $_SESSION["username"] = $nombre;
        $_SESSION["password"] = $password;
        $_SESSION["nombreCompleto"] = $nombreCompleto;
        $_SESSION["correoElectronico"] = $correoElectronico;
        $_SESSION["foto"] = $imagen;
        $_SESSION["idioma"] = $idioma;

        $datos = array(
            "usuario" => $nombre,
            "datos" => array(
                "username" => $nombre,
                "password" => $password,
                "nombreCompleto" => $nombreCompleto,
                "correoElectronico" => $correoElectronico,
                "foto"=>$imagen,
                "idioma"=> $idioma
            )
        );

        if (isset($datosSesion) && is_array($datosSesion)) {
            // Si la variable de sesión 'usuarios' existe y es un array, agrega $datos a $datosSesion
            $datosSesion[] = $datos;
        } else {
            // Si la variable de sesión 'usuarios' no existe o no es un array, crea un nuevo array
            $datosSesion = array($datos);
        }

        $_SESSION["usuarios"] = $datosSesion;
        
        return true;
    }
}


function creayValidaConexion(string $nombre, string $password, string $campo,array &$errores, string $nombreCompleto, string $correoElectronico){
    session_start();
    if($_SESSION['usuarios']==""){
        $_SESSION['usuarios']="";
        $errores['username/password'] = 'Nombre de usuario o contraseña no existen';
        return false;
    }else{
    foreach ($_SESSION['usuarios'] as $usuario) {
        if ($usuario['datos']['correoElectronico'] === $nombre && $usuario['datos']['password'] === $password) {
            $_SESSION["username"] = $nombre;
            $_SESSION["password"] = $password;
            $_SESSION["nombreCompleto"] = $usuario['datos']['nombreCompleto'];
            $_SESSION["correoElectronico"] = $usuario['datos']['correoElectronico'];
            $_SESSION["foto"] = $usuario['datos']['foto'];
            $_SESSION["idioma"] = $usuario['datos']['idioma'];
            return true; // Las credenciales coinciden
        }
    }
}
    // Si llegamos aquí, significa que las credenciales no coinciden
    $errores['username/password'] = 'Nombre de usuario o contraseña incorrectos';
    return false;
}

function calcularFecha(string $fechaNacimiento,string $campo,array &$errores)
{
    // Calcula la edad a partir de la fecha de nacimiento
    $fechaNacimientoTimestamp = strtotime($fechaNacimiento);
    $hoyTimestamp = time();
    $edad = date('Y', $hoyTimestamp) - date('Y', $fechaNacimientoTimestamp);

    // Verifica si la edad es mayor o igual a 18 años
    if ($edad >= 18) {
        return true;
    } else {
        $errores[$campo] = 'El usuario es menor y no puede crearse una cuenta';
        return false;
        
    }
}
function comprobarCorreo(string $correoElectronico,string $campo,array &$errores){
    if (filter_var($correoElectronico, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        $errores[$campo] = 'El correo no es correcto';
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
function cRadio(string $text, string $campo, array &$errores, array $valores, bool $requerido = TRUE)
{
    if (in_array($text, $valores)) {
        return true;
    }
    if (!$requerido && $text == "") {
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

function cCheck(array $text, string $campo, array &$errores, array $valores, bool $requerido = TRUE)
{

    if (($requerido) && (count($text) == 0)) {
        $errores[$campo] = "Error en el campo $campo";
        return false;
    }
    foreach ($text as $valor) {
        if (!in_array($valor, $valores)) {
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
function cFile(string $nombre, array &$errores, array $extensionesValidas, string $directorio, int  $max_file_size,  bool $required = false)
{
    $nombreArchivo = $_FILES['imagen']['name'];

    $_FILES["archivo"];
    // Caso especial que el campo de file no es requerido y no se intenta subir ningun archivo
    if ((!$required) && $_FILES[$nombre]['error'] === 4)
        return true;
    // En cualquier otro caso se comprueban los errores del servidor 
    if ($_FILES[$nombre]['error'] != 0) {
        $errores["$nombre"] = "Error al subir el archivo " . $nombre . ". Prueba de nuevo";
        return false;
    } else {

        $nombreArchivo = strip_tags($_FILES[$nombre]['name']);
        /*
             * Guardamos nombre del fichero en el servidor
            */
        $directorioTemp = $_FILES["$nombre"]['tmp_name'];
        /*
             * Calculamos el tamaño del fichero
            */
        $tamanyoFile = filesize($directorioTemp);
        
        /*
            * Extraemos la extensión del fichero, desde el último punto.
            */
        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        /*
            * Comprobamos la extensión del archivo dentro de la lista que hemos definido al principio
            */
        if (!in_array($extension, $extensionesValidas)) {
            $errores["$nombre"] = "La extensión del archivo no es válida";
            return false;
        }
        /*
            * Comprobamos el tamaño del archivo
            */
        if ($tamanyoFile > $max_file_size) {
            $errores["$nombre"] = "La imagen debe de tener un tamaño inferior a $max_file_size kb";
            return false;
        }

        // Almacenamos el archivo en ubicación definitiva si no hay errores ( al compartir array de errores TODOS LOS ARCHIVOS tienen que poder procesarse para que sea exitoso. Si cualquiera da error, NINGUNO  se procesa)

        if (empty($errores)) {
            /**
             * Comprobamos si el directorio pasado es válido
             */
            if (is_dir($directorio)) {
                /**
             * Tenemos que buscar un nombre único para guardar el fichero de manera definitiva.
             * Podemos hacerlo de diferentes maneras, en este caso se hace añadiendo microtime() al nombre del fichero 
             * si ya existe un archivo guardado con ese nombre.
             * */
                $nombreArchivo = is_file($directorio . DIRECTORY_SEPARATOR . $nombreArchivo) ? time() . $nombreArchivo : $nombreArchivo;
                $nombreCompleto = $directorio . DIRECTORY_SEPARATOR . $nombreArchivo;
                /**
                 * Movemos el fichero a la ubicación definitiva.
                 * */
                if (move_uploaded_file($directorioTemp, $nombreCompleto)) {
                    /**
                     * Si todo es correcto devuelve la ruta y nombre del fichero como se ha guardado
                     */


                    return $nombreCompleto;
                } else {
                    $errores["$nombre"] = "Ha habido un error al subir el fichero";
                    return false;
                }
            }else {
                $errores["$nombre"] = "Ha habido un error al subir el fichero";
                return false;
            }
        }
        return true;

    }
}



?>
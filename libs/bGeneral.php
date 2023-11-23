<?php
/****
 * Librería con funciones generales y de validación
 * 
 */

//function cabecera($titulo = "") // el archivo actual
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

//function pie()
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
 * @param string $num
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

//función para guardar el servicio en el servicios.txt
function crearServicio(string $titulo, string $categoria, string $descripcion, string $tipo, ?string $precioPorHora, string $ubicacion, array $disponibilidad, ?string $foto): bool {
    
    $datosServicio = "\nTítulo: $titulo\nCategoría: $categoria\nDescripción: $descripcion\nTipo: $tipo\nPrecio por hora: $precioPorHora\nUbicación: $ubicacion\nDisponibilidad: " . implode(", ", $disponibilidad) . "\n";

    //indico la ruta del archivo
    $rutaArchivo = "../almacenamientoFicheros/servicios.txt";

    //y guardamos los datos en el archivo
    if (is_file($rutaArchivo)) {
        $fp = fopen($rutaArchivo, "r");
        $escribir = fopen($rutaArchivo, "a");
        $fecha_actual = date("Y-m-d H:i:s");
        fwrite($escribir, $datosServicio.$fecha_actual.PHP_EOL);
        fclose($escribir);
        fclose($fp);
    }else{
        //si el archivo no existe se crea
        $fp = fopen($rutaArchivo, "w");
        fwrite($fp, $datosServicio.PHP_EOL);
        fclose($fp);
    }
        return true;
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
        //NUEVA FUNCIONALIDAD GUARDAMOS LOS DATOS EN UN FICHERO
        $archivo="../almacenamientoFicheros/usuarios.txt";
        if (is_file($archivo)) {
            $fp = fopen($archivo, "r");
            $escribir = fopen($archivo, "a");
            while (!feof($fp)){
                //Lectura
                $linea = fgets($fp);                                     
            }
            $fecha_actual = date("Y-m-d H:i:s");
            fwrite($escribir, $nombreCompleto."?".$password."?".$nombre."?".$correoElectronico."?".$imagen."?".$idioma."?".$fecha_actual.PHP_EOL); 
            fclose($fp);
            fclose($escribir);
            
        }else{
            //Si no que cree el archivo
        }
        return true;
    }
}


function creayValidaConexion(string $correoElectronico, string $password, string $campo,array &$errores){
    session_start();
    $valido=false;
    $archivo="../almacenamientoFicheros/usuarios.txt";
    $fp = fopen($archivo, "r");
    while (!feof($fp)){
        //Lectura
        $linea = fgets($fp);   
        $datos = explode('?', $linea);  
        $correo = $datos[3];
        $contrasenia = $datos[1];   
        // Almacena los datos en el array de usuarios
        if ($correo == $correoElectronico && $contrasenia == $password) {
            //Para guardar en logLogin
            $fecha_actual = date("Y-m-d H:i:s");
            $archivo="../almacenamientoFicheros/logLogin.txt";
            $escribir = fopen($archivo, "a");
            fwrite($escribir, $correoElectronico." ".$password." ".$fecha_actual.PHP_EOL);
            fclose($escribir);
            //fwrite($escribir, $nombreCompleto."?".$password."?".$nombre."?".$correoElectronico."?".$imagen."?".$idioma.PHP_EOL); 
            $_SESSION["nombreCompleto"] = $datos[0];
            $_SESSION["password"] = $datos[1];
            $_SESSION["username"] = $datos[2];
            $_SESSION["correoElectronico"] = $datos[3];
            $_SESSION["foto"] = $datos[4];
            $_SESSION["idioma"] = $datos[5];
            return true; // Las credenciales coinciden
        }
        }
        /*
        $usuarios[] = array(
            "correoElectronico" => $correo,
            "contrasenia" => $contrasenia
        );*/
    
   if($valido===false){
        $errores['username/password'] = 'Nombre de usuario o contraseña incorrectos';
        //Escribe el usuairo y contraseña y fecha actual en el archivo logLogin.txt
        $fecha_actual = date("Y-m-d H:i:s");
        $archivo="../almacenamientoFicheros/logLogin.txt";
        $escribir = fopen($archivo, "a");
        fwrite($escribir, $correoElectronico." ".$password." ".$fecha_actual.PHP_EOL);
        fclose($escribir);
        return false;
    }

    
    /*
    foreach ($usuarios as $usuario) {
        $correo = $usuario["correoElectronico"];
        $contrasenia = $usuario["contrasenia"];
        if ($correo == $correoElectronico && $contrasenia == $password) {
            //Volver abrir el archivo para acceder a la informacion del usuario o posiicon del usuairo
            $_SESSION["correoElectronico"] = $correoElectronico;
            $_SESSION["password"] = $password;
            $_SESSION["nombreCompleto"] = $usuario['datos']['nombreCompleto'];
            $_SESSION["username"] = $usuario['datos']['username'];
            $_SESSION["foto"] = $usuario['datos']['foto'];
            $_SESSION["idioma"] = $usuario['datos']['idioma'];
            return true; // Las credenciales coinciden
        }else{
            $errores['username/password'] = 'Nombre de usuario o contraseña incorrectos';
            //Escribe el usuairo y contraseña y fecha actual en el archivo logLogin.txt
            $fecha_actual = date("Y-m-d H:i:s");
            $archivo="../almacenamientoFicheros/logLogin.txt";
            $escribir = fopen($archivo, "a");
            fwrite($escribir, $correoElectronico." ".$password." ".$fecha_actual.PHP_EOL);
            fclose($escribir);
            return false;
        }
    }*/        
}

function creayValidaConexion2(string $correoElectronico, string $password, string $campo, array &$errores, string $idioma, string $imagen) {
    session_start();
    $archivo = "../almacenamientoFicheros/usuarios.txt";
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES); // Leer todas las líneas del archivo en un array

    foreach ($lineas as $indice => $linea) {
        $datos = explode('?', $linea);
        $correo = $datos[3];
        $contrasenia = $datos[1];

        // Verificar credenciales
        if ($correo === $correoElectronico) {
            $fecha_actual = date("Y-m-d H:i:s");
            // Modificar la línea actual en el array            
            $lineas[$indice] = $_SESSION["nombreCompleto"] . "?" .$password . "?" . $_SESSION["username"] . "?" . $_SESSION["correoElectronico"] . "?".$imagen."?" .$idioma . "?" . $fecha_actual;
            // Escribir el contenido actualizado de vuelta al archivo
            file_put_contents($archivo, implode(PHP_EOL, $lineas));
            $_SESSION["nombreCompleto"] = $datos[0];
            $_SESSION["password"] = $password;
            $_SESSION["username"] = $datos[2];
            $_SESSION["correoElectronico"] = $datos[3];
            $_SESSION["foto"] = $imagen;
            $_SESSION["idioma"] = $idioma;
            
            return true; // Credenciales válidas
        }
    }
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

   // $_FILES["archivo"];
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
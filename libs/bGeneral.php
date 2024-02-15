<?php

/****
 * Librería con funciones generales y de validación
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

//función para guardar el servicio en la bbdd
function crearServicio(string $titulo, string $categoria, string $descripcion, string $tipo, ?string $precioPorHora, string $ubicacion, array $disponibilidad, ?string $rutaFoto,string $correoElectronico): bool
{
    include('../config/config.php');
    //Verificamos si el ID del usuario está en la sesión
    $sql = "SELECT id_user FROM usuario WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $correoElectronico);
    
    
    //Ejecutamos la consulta
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!isset($result)) {
        echo "Usuario no identificado. No se puede crear el servicio.";
        return false;
    }

    //$idUsuario = $_SESSION['id_user'];

    try {
        //Iniciamos la transacción, las transacciones son útiles cuando quieres ejecutar múltiples operaciones en una base de datos de forma atómica;
        //es decir, o tadas las operaciones tiene éxito, o si alguna falla, se pueden revertir todas ellas para mantener la integridad de la base de datos.
        //$pdo->beginTransaction();

        //Preparamos la consulta SQL
        $sql = "INSERT INTO servicios (titulo, id_user, descripcion, precio, tipo, foto_servicio) 
        VALUES (:titulo, :id_user, :descripcion, :precio, :tipo, :foto)";
        $stmt = $pdo->prepare($sql);

        //Vinculación de parámetros
        $stmt->bindParam(':titulo', $titulo);
        $id_user = $result[0]["id_user"];
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precioPorHora);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':foto', $rutaFoto);

        //Ejecutamos la consulta
        $stmt->execute();

        //FInalizamos la transacción
        //$pdo->commit();
        return true;
    } catch (PDOException $e) {
        //Manejamos el error
        echo "Error al crear el servicio: " . $e->getMessage();
        //error_log('PDOException - ' . $e->getMessage(), 0);
        //Por lo que he visto en un entorno de producción, lo mejor sería no mostrar los detalles de los errores en una base de datos.
        //die('Error de base de datos: ' . $e->getMessage());
        return false;
    }
}

$primeraVez = true;
/**
Esta función hace demasiadas cosas
debo eliminar el verifica si la variable de sesion existe, ahora comprobamaremos del fichero/bbdd
 **/
function encriptar($password, $cost = 10)
{
    return password_hash($password, PASSWORD_DEFAULT, ['cost' => $cost]);
}
function crearCuenta(string $nombre, string $password, string $campo, array &$errores, string $nombreCompleto, string $correoElectronico, string $imagen, string $idioma, string $descripcion, string $cFecha)
{
    session_start();
    $nivel = 1;

    include('../config/config.php');
    // Utilizamos prepared statements para evitar la inyección SQL
    $sql = "SELECT email FROM usuario WHERE email = :email";
    ////////////////
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $correoElectronico);
    //$stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //SI QUE FUNCIONA
    if (!$result) {
        $sql = "INSERT INTO usuario (nombre, email, pass, f_nacimiento, foto_perfil, descripcion, nivel)
        VALUES (:nombre, :email, :pass, :f_nacimiento, :foto_perfil, :descripcion, :nivel)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $correoElectronico);
        $stmt->bindParam(':nivel', $nivel);

        $password = encriptar($password, 10); // password_hash($password, PASSWORD_DEFAULT);//Usar la funcion de encriptar seguridad.php
        $stmt->bindParam(':pass', $password);
        $stmt->bindParam(':f_nacimiento', $cFecha);
        $stmt->bindParam(':foto_perfil', $imagen);
        $stmt->bindParam(':descripcion', $descripcion);

        $stmt->execute();
        //$stmt->commit();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $token = bin2hex(random_bytes(64));
        //Insertar el token en la tabla
        //$pdo->lastInsertID
        $id = $pdo->lastInsertId();
        $validez = time() + 86400; //Cambiar la validez
        $sql = "INSERT INTO tokens (token, validez, id_user) VALUES (:token, :validez, :id_user)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':validez', $validez); //24 Horas
        $stmt->bindParam(':id_user', $id); //24 Horas
        $stmt->execute();
        $errores['mensajeCorreo'] = "Por favor, revise su correo para activar la cuenta";
        return $token;
    } else {
        $errores['errorBD'] = "El correo electrónico ya está registrado";
    }
}
function comprobarhash($pass, $passBD)
{
    // Primero comprobamos si se ha empleado una contraseña correcta:
    return password_verify($pass, $passBD);
}


function creayValidaConexion(string $correoElectronico, string $password, string $campo, array &$errores)
{
    session_start();
    include('../config/config.php');
    // Utilizamos prepared statements para evitar la inyección SQL
    $sql = "SELECT * FROM usuario WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $correoElectronico);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // Verificamos si hay algún registro
    if ($result !== false) {
        // Accedemos al email del primer registro (ya que la consulta devuelve todos los registros que cumplan con las condiciones)
        $activo = $result['activo'];
        $contraseniaBd = $result['pass'];
        //Compruebo que la cuenta sea activa 
        if ($activo === 1) {
            if (comprobarhash($password, $contraseniaBd)) {
                //Para guardar en logLogin
                $fecha_actual = date("Y-m-d H:i:s");
                $archivo = "../almacenamientoFicheros/logLogin.txt";
                $escribir = fopen($archivo, "a");
                fwrite($escribir, $correoElectronico . " " . $password . " " . $fecha_actual . PHP_EOL);
                fclose($escribir);
                //fwrite($escribir, $nombreCompleto."?".$password."?".$nombre."?".$correoElectronico."?".$imagen."?".$idioma.PHP_EOL); 
                $_SESSION["nombreCompleto"] = $result['nombre'];
                $_SESSION["password"] = $result['pass'];
                //        $_SESSION["username"] = $datos[2];
                $_SESSION["correoElectronico"] = $result['email'];
                $_SESSION["foto"] = $result['foto_perfil'];
                $_SESSION["descripcion"] = $result['descripcion'];
                //$_SESSION["idioma"] = $datos[5];
                //Ponemos a time() el contador de inactividad
                $_SESSION["timeout"] = time();
                // Obtiene la dirección IP real del cliente detrás de un proxy
                $ip = $_SERVER['REMOTE_ADDR'];
                $_SESSION['ip'] = $ip;
                return true; // Las credenciales coinciden
            } else {
                $errores['errorBD'] = "El usuario o contraseña no son correctos";
                return false;
            }
        } else {
            $errores['errorBD'] = "El usuario no está activo, por favor, revise su correo para activar la cuenta";
            return false;
        }
    } else {
        // No se encontraron registros
        $errores['errorBD'] = "No se encontró el usuario con el correo electrónico y la contraseña ingresados.";
        return false;
    }
}

function creayValidaConexion2(string $correoElectronico, string $password, string $campo, array &$errores, string $idioma, string $imagen, string $descripcionPersonal)
{
    session_start();
    include('../config/config.php');

    $sql = "SELECT * FROM usuario WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $correoElectronico);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $contraseniaBd = $result['pass'];

    // Comprobamos si las contraseñas son iguales
    if ($password === $contraseniaBd) {
        // Las contraseñas son iguales, actualizamos sin cambiar la contraseña
        $sql = "UPDATE usuario SET descripcion = :descripcion, foto_perfil = :foto_perfil WHERE email = :email";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $correoElectronico);
        $stmt->bindParam(':foto_perfil', $imagen);
        $stmt->bindParam(':descripcion', $descripcionPersonal);
        $stmt->execute();
        $_SESSION['imagen'] = $imagen;
        $_SESSION['descripcion'] = $descripcionPersonal;
    } else {
        // Las contraseñas son distintas, actualizamos con la nueva contraseña
        $sql = "UPDATE usuario SET pass = :pass, descripcion = :descripcion, foto_perfil = :foto_perfil WHERE email = :email";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $correoElectronico);
        $password = encriptar($password, 10);
        $stmt->bindParam(':pass', $password);
        $stmt->bindParam(':foto_perfil', $imagen);
        $stmt->bindParam(':descripcion', $descripcionPersonal);
        $stmt->execute();
        $_SESSION["password"] = $password;
        $_SESSION['foto'] = $imagen;
        $_SESSION['descripcion'] = $descripcionPersonal;
    }

    // No es necesario realizar un fetch después de una operación UPDATE.
    // Además, las operaciones UPDATE no devuelven registros.

    // Finalmente, puedes retornar algo según tus necesidades

    return true; // Operación exitosa, por ejemplo
}

function calcularFecha(string $fechaNacimiento, string $campo, array &$errores)
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
function comprobarCorreo(string $correoElectronico, string $campo, array &$errores)
{
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
function cFile(string $nombre, array &$errores, array $extensionesValidas, string $directorio, int  $max_file_size,  bool $required = TRUE): bool|string
{
    // Caso especial que el campo de file no es requerido y no se intenta subir ningun archivo
    if ((!$required) && $_FILES[$nombre]['error'] === 4)
        return true;
    // En cualquier otro caso se comprueban los errores del servidor
    if ($_FILES[$nombre]['error'] != 0) {
        $errores["$nombre"] = "Error al subir el archivo " . $nombre . ". Prueba de nuevo";
        return false;
    } else {
        $nombreArchivo = strip_tags($_FILES["$nombre"]['name']);//= ""
        /*
             * Guardamos nombre del fichero en el servidor
        */
        $directorioTemp = $_FILES["$nombre"]['tmp_name'];//= null
        /*
             * Calculamos el tamaño del fichero
            */
        $tamanyoFile = filesize($directorioTemp);//= false
        /*
            * Extraemos la extensión del fichero, desde el último punto.
        */
        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));//=""
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
            /*
                * Comprobamos si el directorio pasado es válido
            */
            if (is_dir($directorio)) {
                /*
                    * Tenemos que buscar un nombre único para guardar el fichero de manera definitiva.
                    * Podemos hacerlo de diferentes maneras, en este caso se hace añadiendo microtime() al nombre del fichero
                    * si ya existe un archivo guardado con ese nombre.
                **/
                $nombreArchivo = is_file($directorio . DIRECTORY_SEPARATOR . $nombreArchivo) ? time() . $nombreArchivo : $nombreArchivo;
                $nombreCompleto = $directorio . DIRECTORY_SEPARATOR . $nombreArchivo;
                /*
                    * Movemos el fichero a la ubicación definitiva.
                 * */
                if (move_uploaded_file($directorioTemp, $nombreCompleto)) {
                    /*
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
    }
}

?>
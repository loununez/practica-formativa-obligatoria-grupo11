<?php
// Configurar cabeceras para permitir CORS y aceptar JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Obtener los datos enviados desde el frontend
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Validar que se hayan recibido los campos
if(isset($data['usuario']) && isset($data['contraseña'])) {

    $usuario = $data['usuario'];
    $contraseña = $data['contraseña'];

    // Simulación de validación básica (no vacío)
    if(!empty($usuario) && !empty($contraseña)) {
        // Respuesta de éxito
        $respuesta = array(
            "status" => "ok",
            "message" => "Usuario recibido correctamente",
            "usuario" => $usuario
        );
        echo json_encode($respuesta);
    } else {
        // Error: algún campo vacío
        http_response_code(400);
        echo json_encode(array(
            "status" => "error",
            "message" => "Los campos no pueden estar vacíos"
        ));
    }

} else {
    // Error: campos no enviados
    http_response_code(400);
    echo json_encode(array(
        "status" => "error",
        "message" => "Datos incompletos"
    ));
}
?>

<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST["message"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "error" => "Email inválido"]);
        exit();
    }

    $to = "florenciamorelliIT@gmail.com";
    $subject = "Nuevo mensaje de contacto";
    $headers = "From: " . $email . "\r\n" . "Reply-To: " . $email . "\r\n" . "Content-Type: text/plain; charset=UTF-8";
    $body = "Has recibido un mensaje de $email:\n\n$message";

    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(["success" => true, "message" => "Correo enviado"]);
    } else {
        echo json_encode(["success" => false, "error" => "Error al enviar el correo"]);
    }

} else {
    echo json_encode(["success" => false, "error" => "Método no permitido"]);
}
?>

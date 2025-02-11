<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST["message"]);

    if (!$email || !$message) {
        echo json_encode(["success" => false, "error" => "Email y mensaje son requeridos"]);
        exit;
    }

    $to = "florenciamorelliIT@gmail.com";
    $subject = "Nuevo mensaje desde tu portfolio";
    $headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/html; charset=UTF-8";

    $body = "<p><strong>Email:</strong> $email</p><p><strong>Mensaje:</strong> $message</p>";

    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Error al enviar el correo"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Método no permitido"]);
}
?>

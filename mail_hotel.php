<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Variável global para a conexão persistente SMTP
$mail = null;

// Função para obter uma conexão persistente SMTP
function getMailConnection()
{
    global $mail;

    if ($mail === null) {
        $smtp_server = 'smtp.kinghost.net';
        $port = 587;
        $username = 'nao_responder@obahvillage.com.br';
        $password = 'Obah@0307';

        // Inicialização do PHPMailer
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $smtp_server;
        $mail->Port = $port;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = $username;
        $mail->Password = $password;
    }

    return $mail;
}

function enviarMensagemEmail($checkin, $checkout, $nights, $guests, $name, $email, $phone)
{
    // Limpa Telefone do Cliente
    $cleaned_phone_number = preg_replace("/[\(\)\-\s]/", "", $phone);
    $contact_phone_number = $cleaned_phone_number;

    // Configurações do e-mail
    $from_email = 'nao_responder@obahvillage.com.br';
    $to_email = 'reservas@obahvillage.com.br';
    $subject = 'Pedido de Reserva pelo Site';
    $message = "
        <html>
        <head>
            <style>
                .p-30 { padding: 30px }
                .text-obah { color: #2c3f58 }
                .text-danger { color: red }
                .fw-bold { font-weight: bold }
            </style>
        </head>
        <body class='p-30'>
            <p class='text-obah'>Atenção!</p>
            <p class='text-obah fw-bold'>Foi recebido um pedido de reserva para $nights diária(s). Seguem abaixo os detalhes:</p>
            <ul class='text-obah'>
                <li>Check-in: $checkin</li>
                <li>Check-out: $checkout</li>
                <li>Hóspedes: $guests</li>
                <li>Nome: $name</li>
                <li>Telefone: $contact_phone_number</li>
                <li>E-mail: $email</li>
            </ul>
            <p><span class='text-danger'>**</span> Não é necessário responder a este email.</small></p>
            <img src='https://www.obahvillage.com.br/assets/images/logo_mail.png' alt='Obah Village'>
        </body>
        </html>
    ";

    // Inicialização do PHPMailer e uso da conexão persistente
    $mail = getMailConnection();

    try {
        // Configurações do e-mail
        $mail->setFrom($from_email);
        $mail->addAddress($to_email);
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Body = $message;

        // Envio do e-mail
        $mail->send();
        return array('status' => 'success', 'message' => 'E-mail enviado com sucesso.');
    } catch (Exception $e) {
        return array('status' => 'error', 'message' => 'Ocorreu um erro ao enviar o e-mail: ' . $mail->ErrorInfo);
    }
}
?>

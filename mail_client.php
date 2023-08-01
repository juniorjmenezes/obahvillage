<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviarMensagemEmail($checkin, $checkout, $nights, $guests, $name, $email, $phone) {
    // Configurações do servidor SMTP
    $smtp_server = 'smtp.kinghost.net';

    $port = 587;
    $username = 'nao_responder@obahvillage.com.br';
    $password = 'Obah@0307';

    // Limpa Telefone do Cliente
    $cleaned_phone_number = preg_replace("/[\(\)\-\s]/", "", $phone);
    $contact_phone_number = $cleaned_phone_number;

    // Configurações do e-mail
    $from_email = 'nao_responder@obahvillage.com.br';
    $to_email = $email;
    $subject = 'Pedido de Reserva';
    $message = "
        <html>
        <body style='padding: 20px'>
            <p style='color: #2C3F58'>Olá $name,</p>
            <p style='color: #2C3F58; font-weight: bold'>Já recebemos o seu pedido de reserva para $nights diária(s) em nossa Pousada. Seguem abaixo os detalhes:</p>
            <ul style='color: #2C3F58'>
                <li>Check-in: $checkin</li>
                <li>Check-out: $checkout</li>
                <li>Hóspedes: $guests</li>
                <li>Nome: $name</li>
                <li>Telefone: $contact_phone_number</li>
                <li>E-mail: $email</li>
            </ul>
            <p style='color: #2C3F58; font-weight: bold'>Aguarde nosso contato para confirmar o seu pedido, ou se preferir, fale diretamente conosco através do telefone/WhatsApp: +55 88 99664-2583.</p>
            <p><small style='color: #2C3F58'><span style='color: red'>*</span> Lembramos que até o momento não foi efetuado nenhum bloqueio de disponibilidade de apartamento ou tarifa e os mesmos estão sujeitos à alteração sem aviso prévio. <br><span style='color: red'>**</span> Não é necessário responder a este email.</small></p>
            <img src='https://www.obahvillage.com.br/mail/logo_mail.png' alt='Obah Village'>
        </body>
        </html>
    ";

    // Inicialização do PHPMailer
    $mail = new PHPMailer();

    // Configuração do servidor SMTP
    $mail->isSMTP();
    $mail->Host = $smtp_server;
    $mail->Port = $port;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = $username;
    $mail->Password = $password;
    //$mail->Sender = $from_email;

    //$mail->SMTPDebug = 3;

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

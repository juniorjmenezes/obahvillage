<?php
// Inclua o arquivo whatsapp.php que contém a função enviarMensagemWhatsApp
include 'whatsapp_client.php';

// Verifica se a solicitação é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $nights = $_POST['nights'];
    $guests = $_POST['guests'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Chamar a função enviarMensagemWhatsApp para enviar a mensagem
    $response = enviarMensagemWhatsApp($checkin, $checkout, $nights, $guests, $name, $email, $phone);

    // Enviar a resposta para o frontend
    echo $response;
}
?>
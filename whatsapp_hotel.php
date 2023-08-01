<?php

function enviarMensagemWhatsApp($checkin, $checkout, $nights, $guests, $name, $email, $phone) {

    // URL da API
    $url = 'https://app.whatsgw.com.br/api/WhatsGw/Send';

    // Chave da API
    $apikey = '9d282542-6699-4b2f-97bc-5690aa1867b2';

    // Número de telefone para enviar a mensagem
    $phone_number = '5588996452212';

    // Número de telefone do contato
    $contact_phone_number = '5588996452212';

    // ID personalizado da mensagem
    $message_custom_id = 'mysoftwareid';

    // Tipo de mensagem
    $message_type = 'text';

    // Limpa Telefone do Cliente
    $cleaned_phone_number = preg_replace("/[\(\)\-\s]/", "", $phone);

    // Corpo da mensagem
    $message_body = "🚨 *Pedido de Reserva!!*\n*⚠ Tente retornar para o cliente o mais breve possível!*\n\nCheck-in: *$checkin*\nCheck-out: *$checkout*\nDiárias: *$nights*\nHóspedes: *$guests*\nNome: *$name*\nTelefone: $cleaned_phone_number\nE-mail: $email\n\n_Enviado por: www.obahvillage.com.br_";

    // Verificar status da mensagem (1 para sim, 0 para não)
    $check_status = 1;

    // Data e hora do agendamento (opcional, defina como null se não for necessário)
    $schedule = null;

    // Enviar mensagem para um grupo (1 para sim, 0 para não)
    $message_to_group = 0;

    // Preparar os dados a serem enviados
    $data = array(
        'apikey' => $apikey,
        'phone_number' => $phone_number,
        'contact_phone_number' => $contact_phone_number,
        'message_custom_id' => $message_custom_id,
        'message_type' => $message_type,
        'message_body' => $message_body,
        'check_status' => $check_status,
        'schedule' => $schedule,
        'message_to_group' => $message_to_group,
    );

    // Inicializar a sessão cURL
    $ch = curl_init();

    // Definir as opções do cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

    // Executar a sessão cURL
    $response = curl_exec($ch);

    // Verificar erros do cURL
    if (curl_errno($ch)) {
        echo 'Erro: ' . curl_error($ch);
    }

    // Fechar a sessão cURL
    curl_close($ch);

    // Retornar a resposta
    return $response;
}

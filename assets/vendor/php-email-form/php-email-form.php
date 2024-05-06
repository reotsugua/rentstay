<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Configurações do servidor
    $mail->isSMTP();                                      // Definir o uso de SMTP
    $mail->Host       = 'smtp.titan.email';               // Especificar servidores SMTP
    $mail->SMTPAuth   = true;                             // Ativar autenticação SMTP
    $mail->Username   = 'noreply@rentstay.com.br';        // SMTP username
    $mail->Password   = 'xUjabr(h';                       // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      // Ativar criptografia TLS ou SSL
    $mail->Port       = 465;                              // Porta TCP para conectar

    // Recipients
    $mail->setFrom('noreply@rentstay.com.br', 'Rent Stay');
    $mail->addAddress('otsugua.renan@gmail.com');         // Adicionar um destinatário

    // Conteúdo
    $mail->isHTML(true);                                  // Definir o formato de e-mail para HTML
    $mail->Subject = $_POST['subject'];
    $mail->Body    = 'Nome: ' . $_POST['name'] . '<br>Email: ' . $_POST['email'] . '<br>Mensagem: ' . $_POST['message'];

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

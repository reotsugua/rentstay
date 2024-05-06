<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMAIL/src/Exception.php';
require '../PHPMAIL/src/PHPMailer.php';
require '../PHPMAIL/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.titan.email';
    $mail->SMTPAuth = true;
    $mail->Username = 'noreply@rentstay.com.br'; // Assegure-se de que este é o e-mail correto para autenticação SMTP
    $mail->Password = 'xUjabr(h'; // Certifique-se de que a senha está correta
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom('noreply@rentstay.com.br', 'Rent Stay');
    $mail->addAddress('otsugua.renan@gmail.com'); // Substitua pelo destinatário correto

    $mail->isHTML(true);
    $mail->Subject = $_POST['subject'];
    $mail->Body    = 'Nome: ' . $_POST['name'] . '<br>Email: ' . $_POST['email'] . '<br>Mensagem: ' . $_POST['message'];

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

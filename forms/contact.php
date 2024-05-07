<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configurações do servidor
    $mail->isSMTP();
    $mail->Host       = 'smtp.titan.email';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'noreply@rentstay.com.br';
    $mail->Password   = 'xUjabr(h'; 
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    // Quem está enviando o e-mail
    $mail->setFrom('noreply@rentstay.com.br', 'Formulario de Contato');

    // Destinatário
    $mail->addAddress('contato@rentstay.com.br', 'formulario de contato');

    // Conteúdo
    $mail->isHTML(true);
    $mail->Subject = $_POST['subject'];
    $mail->Body    = 'Nome: ' . $_POST['name'] . '<br>Email: ' . $_POST['email'] . '<br>Mensagem: ' . $_POST['message'];

    $mail->send();
    echo 'OK';
} catch (Exception $e) {
    echo "A mensagem não pôde ser enviada. Erro de envio: {$mail->ErrorInfo}";
}
?>

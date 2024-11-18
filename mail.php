<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

function enviarCodigoEmail($destinatario, $codigo) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = getenv('SMTP_HOST'); //Preencher
        $mail->SMTPAuth = true;
      		
		$mail->Username = getenv('SMTP_USERNAME'); //Preencher com e-mail para envio
        $mail->Password = getenv('SMTP_PASSWORD'); //Preencher a senha do app
		
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = (int)getenv('SMTP_PORT'); //Preencher
		
		// Define o idioma e o charset
        $mail->setLanguage('pt_br');
        $mail->CharSet = 'UTF-8';

        $mail->setFrom(getenv('SMTP_FROM_EMAIL'), getenv('SMTP_FROM_NAME')); //Preencher com e-mail para envio
        $mail->addAddress($destinatario);

        $mail->isHTML(true);
        $mail->Subject = 'Código de Verificação';
        $mail->Body = "Seu código de verificação é: <b>$codigo</b>";

        $mail->send();
        echo 'Código enviado com sucesso!';
    } catch (Exception $e) {
        echo "Erro ao enviar código: {$mail->ErrorInfo}";
    }
}
?>

<?php

// Use este require se você usou o Git
require './phpmailer/PHPMailerAutoload.php';

$Mailer = new PHPMailer();

// define que será usado SMTP
$Mailer->IsSMTP();

// envia email HTML
$Mailer->isHTML(true);

// codificação UTF-8, a codificação mais usada recentemente
$Mailer->Charset = 'UTF-8';

// Configurações do SMTP
$Mailer->SMTPAuth = true;
$Mailer->SMTPSecure = 'ssl';
$Mailer->Host = 'smtp.gmail.com';
$Mailer->Port = 465;
$Mailer->Username = 'lucasgdutra@gmail.com';
$Mailer->Password = 'qxyspbafjtjplmco';

// E-Mail do remetente (deve ser o mesmo de quem fez a autenticação
// nesse caso seu_login@gmail.com)
$Mailer->From = 'lucasgdutra@gmail.com';

// Nome do remetente
$Mailer->FromName = 'Seu Nome';

// assunto da mensagem
$Mailer->Subject = 'Teste';

// corpo da mensagem
$Mailer->Body = 'Mensagem em HTML';

// corpo da mensagem em modo texto
$Mailer->AltBody = 'Mensagem em texto';

// adiciona destinatário (pode ser chamado inúmeras vezes)
$Mailer->AddAddress('lucasgdutra@gmail.com');

// adiciona um anexo
$Mailer->AddAttachment('Perrier.jpg');

// verifica se enviou corretamente
if ($Mailer->Send()) {
    echo "Enviado com sucesso";
} else {
    echo 'Erro do PHPMailer: ' . $Mailer->ErrorInfo;
}
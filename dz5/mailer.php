<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

$transport = (new Swift_SmtpTransport(SMTP_HOST, SMTP_PORT, SMTP_ENCRYPTION))
    ->setUsername(SMTP_USERNAME)
    ->setPassword(SMTP_PASSWORD)
;

$mailer = new Swift_Mailer($transport);

$message = (new Swift_Message('Loft School Work #5'))
    ->setFrom(['r.hammerok@yandex.ru' => 'Roman'])
    ->setTo(['ivannikov.roman@mail.ru' => 'Roman'])
    ->setBody('I could do it')
;

// Send the message
if ($mailer->send($message)) {
    echo 'Email sent successfully';
} else {
    echo 'Failed to send email';
}

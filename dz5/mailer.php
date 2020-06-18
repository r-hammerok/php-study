<?php
require_once 'vendor/autoload.php';

$transport = (new Swift_SmtpTransport('smtp.yandex.ru', 465, 'ssl'))
    ->setUsername('r.hammerok')
    ->setPassword('pEaLNvEKVZ8aqozMAmqL')
;

$mailer = new Swift_Mailer($transport);

$message = (new Swift_Message('Loft School Work #5'))
    ->setFrom(['r.hammerok@yandex.ru' => 'Roman'])
    ->setTo(['roman.y.ivannikov@gmail.com', 'ivannikov.roman@mail.ru' => 'Roman'])
    ->setBody('I could do it')
;

// Send the message
echo $result = $mailer->send($message);
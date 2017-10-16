<?php

require_once('./LINEBot.php');

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('721szhlnKcqiywE45a+x50db4xAn9thVwe9YFKesQRV0dd06rwMsknLaCk+toRzbvpKyIUgBNMnWWw0OYDcoonrhR+XZH8Jk/eV5irg2qvt1bJ1L/RRHX2fAErs+f6gZ9YrkIH6KV3QYcVadV6CawwdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'bf8c23763d219001b1966809f1d3d7b8
']);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello, bot testing');
$response = $bot->pushMessage('U7fc79408bcc23bd23ca455670086f464', $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
?>
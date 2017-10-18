<?php

require_once('./LINEBot/HTTPClient/CurlHTTPClient.php');
require_once('./LINEBot/MessageBuilder\TextMessageBuilder.php');
require_once('LINEBot.php');


$channel_access_token = '721szhlnKcqiywE45a+x50db4xAn9thVwe9YFKesQRV0dd06rwMsknLaCk+toRzbvpKyIUgBNMnWWw0OYDcoonrhR+XZH8Jk/eV5irg2qvt1bJ1L/RRHX2fAErs+f6gZ9YrkIH6KV3QYcVadV6CawwdB04t89/1O/w1cDnyilFU=';

$channel_secret = 'bf8c23763d219001b1966809f1d3d7b8';

$message2send = 'Hello, bot testing';

$dest_Ids = 'U7fc79408bcc23bd23ca455670086f464';

$httpClient = new Git\LINEBot\HTTPClient\CurlHTTPClient($channel_access_token);
$bot = new Git\LINEBot($httpClient, ['channelSecret' => $channel_secret]);

$textMessageBuilder = new Git\LINEBot\MessageBuilder\TextMessageBuilder($message2send);
$response = $bot->pushMessage($dest_Ids, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

?>
<?php

	//echo "Hello Heroku";
	
	require_once('./line_tiny.php');
	$channelAccessToken = '721szhlnKcqiywE45a+x50db4xAn9thVwe9YFKesQRV0dd06rwMsknLaCk+toRzbvpKyIUgBNMnWWw0OYDcoonrhR+XZH8Jk/eV5irg2qvt1bJ1L/RRHX2fAErs+f6gZ9YrkIH6KV3QYcVadV6CawwdB04t89/1O/w1cDnyilFU='; //sesuaikan 
	$channelSecret = 'bf8c23763d219001b1966809f1d3d7b8';//sesuaikan
	$client = new LINEBotTiny($channelAccessToken, $channelSecret);

	$tempdump = var_dump($client->parseEvents());
	
	file_put_contents("php://stderr", "$tempdump\n");

?>
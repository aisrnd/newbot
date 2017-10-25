<?php

	//echo "Hello Heroku";
	
	require_once('./line_tiny.php');
	$channelAccessToken = '721szhlnKcqiywE45a+x50db4xAn9thVwe9YFKesQRV0dd06rwMsknLaCk+toRzbvpKyIUgBNMnWWw0OYDcoonrhR+XZH8Jk/eV5irg2qvt1bJ1L/RRHX2fAErs+f6gZ9YrkIH6KV3QYcVadV6CawwdB04t89/1O/w1cDnyilFU='; //sesuaikan 
	$channelSecret = 'bf8c23763d219001b1966809f1d3d7b8';//sesuaikan
	$client = new LINEBotTiny($channelAccessToken, $channelSecret);

	$debug_export = var_export($client->parseEvents(), true);
	//$tempdump = var_dump($client->parseEvents());
	//$tempdump = $client->parseEvents();
	
	file_put_contents("php://stderr", "this is dump : $debug_export\n");
	
	/*
array (
   0 => 
   array (
     'type' => 'message',
     'replyToken' => '591d0f96eca74a8a934a723613c5cd48',
     'source' => 
     array (
       'groupId' => 'C435bf7d3def4649b8a600398bdbcbd62',
       'userId' => 'U7fc79408bcc23bd23ca455670086f464',
       'type' => 'group',
     ),
     'timestamp' => 1508815544665,
     'message' => 
     array (
       'type' => 'text',
       'id' => '6886494320454',
       'text' => 'Tes',
     ),
   ),
 )
 */
 
	// id processing
	$newUserId = $client->parseEvents()[0]['source']['userId'];
	$data_to_write = "";
	$file_path = 'userIdList.txt';
	
	$profil = $client->profil($userId);
	
	// received message processing
	$message = $client->parseEvents()[0]['message'];
	$pesan_datang = $message['text'];
	
	// received reply token
	$replyToken = $client->parseEvents()[0]['replyToken'];
	
	
	// check if user exist
	$handle = fopen($file_path, 'r');
	$isUserExist = false; // init as false
	while (($buffer = fgets($handle)) !== false) {
		if (strpos($buffer, $newUserId) !== false) {
			$isUserExist = TRUE;
			$data_to_write = $newUserId;
			break; // Once you find the string, you should break out the loop.
		}      
	}
	fclose($handle);
	
	// parsing incoming message
	if($message['type']=='text')
	{
		if($pesan_datang=='REG BOT')
		{
			$resultMessage="";
			if($isUserExist == false){ // new user
				$this->saveUserId();
				$resultMessage= ", Registrasi berhasil";
			}
			else
			{
				$resultMessage= ", Anda telah teregistrasi";
			}
			$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Halo '.$profil->displayName.$resultMessage
									)
							)
						);
		}
		else
		{
			$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Halo '.$profil->displayName.', Menu tidak tersedia'
									)
							)
						);
		}
	}
	else // if the incoming message type != text
	{
		$balas = array(
							'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Halo '.$profil->displayName.', Anda Mengirim Pesan Bukan Text'
									)
							)
						);
	}
	
	// write new user id to the list
	function saveUserId(){
		
		$file_handle = fopen($file_path, 'a');
		fwrite($file_handle, "\n".$data_to_write);
		fclose($file_handle);
		
	}
 
?>
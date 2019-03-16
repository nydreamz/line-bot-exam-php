<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'py3bWWGF1GZ+RDlvVeumW3vRFpnXFeOigvIuekh0iMCNJ08DGIKdbrvU/WuqO70TQiPjUPJI29IXnwg7B7oSU8NEcnsOnU6Yk5lH465fnm8dEiXuT/UYV9OpIw1g04BlpyM9qHdMLskRWHUrjUptJQdB04t89/1O/w1cDnyilFU=';
$channelSecret = '7027b55573a066bc6deb9f497ea80dc8';
$idPush = 'U41dce961faea3f904c6377f122383327';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("Hello");
$response = $bot->pushMessage($idPush, $textMessageBuilder);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("Hello");
$response = $bot->pushMessage($idPush, $textMessageBuilder);


echo $response->getHTTPStatus() . ' ' . $response->getRawBody();



// Get POST body content
$content = file_get_contents('php://input');




/*
{
"events":[
     {
       "type":"message",
       "replyToken":"1cf19778ea854dca9457618c26b89926",
       "source":
           {
          "userId":"U41dce961faea3f904c6377f122383327",
          "type":"user"
           },
	"timestamp":1552725143541,
        "message":		
           {
	 	"type":"text",
		"id":"9523813032026",
		"text":"cat"
            }
		}],
		"destination":"U2a981f502a281a2d7fd0915d9cbd72f4"
}

content['event',
*/







// Parse JSON
$events = json_decode($content, true);

$str = print_r($events, true);
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($str);
$response = $bot->pushMessage($idPush, $textMessageBuilder);

echo "11";
// Validate parsed JSON data
if (!is_null($events['events'])) { 
	echo "22";
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		$replyToken = "DOG";
		if($event['message']['text'] == 'abc')
			$replyToken = "XYZ";
		
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
					

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text,
				
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}

echo "OK";

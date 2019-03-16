<?php



require "vendor/autoload.php";

$access_token = 'py3bWWGF1GZ+RDlvVeumW3vRFpnXFeOigvIuekh0iMCNJ08DGIKdbrvU/WuqO70TQiPjUPJI29IXnwg7B7oSU8NEcnsOnU6Yk5lH465fnm8dEiXuT/UYV9OpIw1g04BlpyM9qHdMLskRWHUrjUptJQdB04t89/1O/w1cDnyilFU=':
$channelSecret = '7027b55573a066bc6deb9f497ea80dc8';

$pushID = 'U41dce961faea3f904c6377f122383327';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();








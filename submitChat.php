<?php
session_start();
require_once 'lib/functions.php';

if(isset($_POST['message'])){
    $_POST['username'] = $_SESSION['username'];
    // saveChat(chooseXMLFile());
}

//Get curernt Time;
date_default_timezone_set('Canada/Eastern');
$time = new DateTime();

$doc = new DOMDocument('1.0', 'utf-8');
$doc->preserveWhiteSpace = false;
$doc->formatOutput = true;

$doc->load(chooseXMLFile());

//Get root
$root = $doc->documentElement;

//Get next MsgId
$nextMsgId = count($doc->getElementsByTagName('message'));


//Create message node
//Create message text node.
$message = $doc->createElement("message");
$messageIdNode = $doc->createElement("messageId");

//If messageId node doesn't already exist, messageId will be given the value of 0.
//Else, the value of messageId will be the max value of the idArr plus 1.
if (count($doc->getElementsByTagName('messageId')) == 0) {
    $messageIdTextNode = $doc->createTextNode(strVal(0));
} else {
    //Initiate idArr to store Message Ids.
    $idArr = [];
    foreach($doc->getElementsByTagName('messageId') as $node) {
        //get text condtent from getElementsByTagName Object
        //https://stackoverflow.com/questions/6399924/getting-nodes-text-in-php-dom
        array_push($idArr, $node->textContent);
    }
    $messageIdTextNode = $doc->createTextNode(max($idArr)+1);
}

$messageIdNode->appendChild($messageIdTextNode);
$message->appendChild($messageIdNode);


//Create date node
//Create date text node
$dateNode = $doc->createElement('date', $time->format('Y-m-d H:i:s'));


//Create user node
//Create user text node
$user = $doc->createElement('user');

$userNameNode = $doc->createElement('username');
$userNameText = $doc->createTextNode($_SESSION['username']);
$userNameNode->appendChild($userNameText);

$userIdNode = $doc->createElement('userId');
$userIdTextNode = $doc->createTextNode($_SESSION['userId']);
$userIdNode->appendChild($userIdTextNode);

$user->appendChild($userIdNode);
$user->appendChild($userNameNode);

$content = $doc->createElement('content');
$messageContent = $doc->createTextNode($_POST['chat__input']);

$content->appendChild($messageContent);

//Append nodes appropriately
$message->appendChild($dateNode);
$message->appendChild($user);
$message->appendChild($content);



$root->appendChild($message);

// $doc->appendChild($root);
$doc->save(chooseXMLFile());   



echo loadChat(chooseXMLFile());

?>
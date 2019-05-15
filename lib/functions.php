<?php

//function to create xml for chatroom.
//http://consistentcoder.com/create-an-xml-file-with-php
function createChatroomXML($id, $filename) {
    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->formatOutput = true;
            
    $xmlRoot = $dom->createElement("Room");
    $xmlRoot = $dom->appendChild($xmlRoot);
    $roomIdAtt = $xmlRoot->setAttribute('id', $id);
    $dom->save("xml/$filename");
}

//Choose chatroom xml file to load/save
//Check if xml file already exists.
//If not, create xml file.
//https://www.geeksforgeeks.org/php-file_exists-function/
function chooseXMLFile() {
    if($_SESSION['chatroom'] === "Weather") {
        if(file_exists("xml/weather.xml")) {
            return "xml/weather.xml";
        } else { 
            createChatroomXML('1', 'weather.xml');
        }
    } else if ($_SESSION['chatroom'] === "Music") {
        if(file_exists("xml/music.xml")) {
            return "xml/music.xml";
        } else { 
            createChatroomXML('2', 'music.xml');
        }    
    } else if ($_SESSION['chatroom'] === "Games") {
        if(file_exists("xml/games.xml")) {
            return "xml/games.xml";
        } else { 
            createChatroomXML('3', 'games.xml');
        }
    }
}

function handleIndexRouting() {
    if(isset($_POST['username'])) {
        $_SESSION['username'] = $_POST['username'];
    }
    
    if(isset($_POST['logout']) ) {
        unset($_SESSION['username']);
        unset($_SESSION['chatroom']);
    }
    
    if(!isset($_SESSION['username'])) {
        header('Location: login.php');
    } 
    
    if(!isset($_SESSION['chatroom'])) {
        header('Location: chatrooms.php');
    }
    
    if(isset($_POST['changeChatroom'])) {
        unset($_SESSION['chatroom']);
        header('Location: chatrooms.php');
    }
}

function handleChatroomRouting() {
    if(isset($_POST['username'])) {
        $_SESSION['username'] = $_POST['username'];
    }
    
    if(isset($_POST['chatroom'])) {
        $_SESSION['chatroom'] = $_POST['chatroom'];
        header('Location: index.php');
    }
    
    if(!isset($_SESSION['username'])){
        header('Location: login.php');
    }
}

function handleLoginRouting() {
    if(isset($_SESSION['username'])){
        header('Location: chatrooms.php');
    } 
    
    if (isset($_SESSION['chatroom'])) {
        header('Location: index.php');
    }
}

//Load chat xml file.
function loadChat($file) {
    $string = '';
    $xml = simplexml_load_file($file);
    $messages = $xml->message;
    foreach($messages as $m) {
       $string .=  "<span class='userDisp'>" . 
                    $m->user->username . 
                    "</span>: " . 
                    "$m->content<br>";
    }
    return $string;
}

function loadRooms() {
    $xml = simplexml_load_file('xml/chatRooms.xml');
    $rooms = $xml->Room;
    foreach($rooms as $r) {
        echo "<button class='primary-btn' type='submit' name='chatroom' value=$r->name> $r->name Chatroom </button>";
    }
}

?>
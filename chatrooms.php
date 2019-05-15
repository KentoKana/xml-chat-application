<?php
require_once 'header.php';
require_once 'lib/functions.php';

handleChatroomRouting();
?>
<!DOCTYPE <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Chat Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="body-wrap">
        <div class="wrapper">
            <p>Please choose a chatroom to join: </p>
            <form action="" method='POST'>
                <?php loadRooms();?>
            </form>
        </div>
    </div>
</body>

</html>
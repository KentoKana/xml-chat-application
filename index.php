<?php
require_once 'header.php';

handleIndexRouting(chooseXMLFile());
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= $_SESSION['chatroom']?> Chat Room</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="body-wrap">
        <div class="wrapper">
            <h1><?=$_SESSION['chatroom'];?> Chatroom</h1>
            <!-- apologies for the inline styling - temporarily testing styling. -->
            <div id="chat__display">

                <?php
        echo loadChat(chooseXMLFile());
    ?>
            </div>
            <div id="chat__formDiv">
                <form action="" method="POST" id="chat__form">
                    <div class="chatConsoleWrap">
                        <div id="chat__username-disp">
                            <label>Username:</label>
                            <div>
                                <span class="usernameDisp"><?=$_SESSION['username'];?></span>
                            </div>
                        </div>
                        <div>
                            <label for="chat__input">Type Message Here: </label>
                        </div>
                        <div>
                            <input placeholder="Type message..." type="text" name="chat__input" id="chat__input">
                            <button id="chat__submit-btn" class="primary-btn" type="submit" name="submit">Send</button>
                        </div>
                    </div>

                </form>

                <form action="" method="POST" id="chat__page-aciton-form">
                    <div>
                        <button class="secondary-btn" type="submit" name="changeChatroom">Change Chatroom</button>
                    </div>
                    <div>
                        <button id="logoutBtn" class="secondary-btn" type="submit" onclick="singOut()"
                            name="logout">Logout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script src="lib/script.js"></script>
</body>

</html>
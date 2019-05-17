<?php
require_once 'header.php';
//google auth client id;
$CLIENT_ID = '975321287994-8r65ehh113ai7qkkvffi2cbnqfd4gtsr.apps.googleusercontent.com';
if(isset($_SESSION['username'])) {
    header('Location: index.php');
}
?>

<!DOCTYPE <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Chat Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-signin-client_id" content="<?= $CLIENT_ID?>">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="body-wrap">
        <div class="wrapper">
            <h1>Welcome!</h1>
            <form action="" method="POST">
                <div class="login-form-div">
                    <div>
                        <div>
                            <label for="username">Enter your Username:</label>
                        </div>
                        <div>
                            <input id="username" type="text" name="username">
                            <input id="gauth_username" name="gauth_username" type="hidden" value="">
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="password">Enter your Password:</label>
                        </div>
                        <div>
                            <input type="password" name="password">
                        </div>
                    </div>

                    <button class="primary-btn" id="loginFormBtn" type="submit" name="login">Login</button>
                </div>
            </form>

            <?php
    if(isset($_POST['login'])) {
        $xml = simplexml_load_file('xml/users.xml');
        $users = $xml->user;
        // $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        foreach ($users as $user) {
            if((string)$user->username === $_POST['username'] && password_verify($_POST['password'], (string)$user->password) == true) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['userId'] = strVal($user->userId);
                handleLoginRouting();
            } //If Google Auth username form is submitted, set the username session to the google profile name.
            else if ($_POST['gauth_username']) {
                $_SESSION['username'] = $_POST['gauth_username'];
                handleLoginRouting();                
            }
        }
        echo "<div class='invalid'>Please enter valid credentials</div>";
    }

    ?>
           <!-- <div class="google-login">
                <p>Sign in with Google:</p>

                <div class="g-signin2" data-onsuccess="onSignIn"></div>
            </div>
	   -->
            <script src="https://apis.google.com/js/platform.js" async defer></script>
            <!-- JQuery -->
            <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
            <script src="lib/script.js"></script>
        </div>
    </div>

</body>

</html>

//Sign in/out logic
function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    //Get id token from google authentication.
    //https://stackoverflow.com/questions/29765905/how-to-get-the-access-token-from-google-sign-in-javascript-sdk
    //If login token exists,
    //Get username from google auth.
    //Submit the form.
    if (googleUser.getAuthResponse().id_token) {
        document.getElementById('gauth_username').value = profile.getName();
        document.getElementById('loginFormBtn').click();
    }
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}

function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        console.log('User signed out.');
        document.cookie = "G_AUTHUSER_H=0; expires= Thu, 23 March 1999 20:00:00 UTC;";
        location.reload();
    });
}

//Chat Logic
$('#chat__display').scrollTop($('#chat__display')[0].scrollHeight);

//AJAX
$('#chat__form').submit(function (event) {
    event.preventDefault();

    var message = $('#chat__input').val();
    console.log(message);

    $.post('submitChat.php',
        { chat__input: message },
        function (data) {
            // console.log(data);
            $('#chat__display').html(
                data
            );
            $('#chat__input').val("");
        }
    )
});

//Refresh portion of a page with jquery
function refreshChat() {
    //https://stackoverflow.com/questions/17886578/refresh-part-of-page-div
    $('#chat__display').load(document.URL +  ' #chat__display');
    // console.log("Chat Refreshed!");
}
//Refresh page every 5 seconds.
setInterval(refreshChat, 5000);




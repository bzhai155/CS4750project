<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('425904799058-ke9supq1igbp7r785iebktrm8k8itaeh.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://www.cs.virginia.edu/~blz4mv/CS4750/main.php');
//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();

?>
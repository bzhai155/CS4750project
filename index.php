<?php
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/':                   // URL (without file name) to a default screen
        require 'main.php';
        break;
    case '/main.php':     // if you plan to also allow a URL with the file name 
        require 'main.php';
        break;
    case '/index.php':     // if you plan to also allow a URL with the file name 
        require 'main.php';
        break;
    case '/home.php':
        require 'home.php';
        break;
    case '/logout.php':
        require 'logout.php';
        break;
    case '/request.php':
        require 'request.php';
        break;
    case '/signup.php':
        require 'signup.php';
        break;
    case '/login.php':
        require 'login.php';
        break;
    case 'rating.php':
        require 'rating.php';
        break;
    default:
        http_response_code(404);
        exit('Not Found');
}

?>
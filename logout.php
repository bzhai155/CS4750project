<?php
session_start();

if(!isset($_SESSION['token'])){
  header('Location: index.php');
  exit;
}

require('./config.php');

$google_client->revokeToken();

session_destroy();
header("Location: index.php");
exit;
?>
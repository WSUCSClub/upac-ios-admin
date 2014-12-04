<?php
include_once('fb_helper.php');
include_once('parse_helper.php');

use Parse\ParseUser;

if (ParseUser::getCurrentUser() == null) {
  header('Location: /login.php');
  die();     // bots can make it past a header redirect
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow" />
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <link rel="stylesheet" type="text/css" href="small-screen.css" />
    <link rel="stylesheet" type="text/css" href="large-screen.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//www.parsecdn.com/js/parse-1.3.2.min.js"></script>
    <script type="text/javascript" src="parse_init.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <link rel="icon" href="favicon.png" />
    <link rel="apple-touch-icon-precomposed" href="favicon.png" />
    <?php if (isset($miscellaneous)) echo $miscellaneous; ?>
  </head>
  <body>
    <div id="shade">
      <div id="cancel" class="button red" onclick="$('#shade').hide();$('.modal').hide();">Cancel</div>
    </div>
    <div id="container">
      <header>
        <div id="logo">
          <img src="wsu_logo.png" alt="WSU" />
          <h1>WSU UPAC</h1>
        </div>
        <nav>
          <ul>
            <li><a href="index.php">Raffles</a></li>
            <li><a href="board_members.php">Board Members</a></li>
            <li><a href="users.php">Admins</a></li>
          </ul>
        </nav>
        <div style="clear:both;"></div>
      </header>
      <main>

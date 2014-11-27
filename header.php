<?php
//include_once('../cgi-bin/mysql_connect.php');
session_start();
include_once('fb_helper.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow" />
    <title>WSU UPAC App Administration - <?php echo $page_title; ?></title>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <script type="text/javascript" src="main.js"></script>
    <link rel="icon" href="favicon.png" />
    <link rel="apple-touch-icon-precomposed" href="favicon.png" />
    <?php if (isset($miscellaneous)) echo $miscellaneous; ?>
  </head>
  <body>
    <div id="container">
      <header>
        <div id="logo">
          <img src="wsu_logo.png" alt="WSU" />
          <h1>WSU UPAC App Administration</h1>
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

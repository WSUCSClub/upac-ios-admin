<?php
include_once('parse_helper.php');

use Parse\ParseUser;

ParseUser::logOut();
header('Location: /login.php');

?>

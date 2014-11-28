<?php
include_once('parse_helper.php');

use Parse\ParseUser;
use Parse\ParseObject;
use Parse\ParseQuery;

ParseUser::getCurrentUser()->destroy();

header('Location: /logout.php');
die();

?>

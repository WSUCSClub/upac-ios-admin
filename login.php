<?php
include_once('parse_helper.php');

use Parse\ParseUser;

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST['email'] && $_POST['password']) {
    // Try logging in
    try {
      $user = ParseUser::logIn($_POST['email'], $_POST['password']);

      // Successful login
      header('Location: /index.php');
    } catch (Exception $e) {
      $error = $e->getMessage();
    }
  } else {
    $error = 'Please enter both a username and password';
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow" />
    <title>WSU UPAC App Administration</title>
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
  </head>
  <body>
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

      <div id="login">
        <h1>Login</h1>
        <?=$error?><br/><br/>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
          <div id="form">
            <input id="email" name="email" value="email" type="text"><br/>
            <input id="password" name="password" value="password" type="password"><br/>
          </div>
          <input class="green button bigButton" type="submit" value="Login">
        </form>
      </div>

      </main>
      <footer>
          <p>Need help? Shoot me an email at <a href="mailto:rmarquez14@winona.edu?subject=WSU%20UPAC%20App%20administration%20help">rmarquez14@winona.edu</a></p>
      </footer>
    </div> <!-- END CONTAINER -->
  </body>
</html>


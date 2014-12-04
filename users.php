<?php
    $page_title = 'Users';
    include('header.php');

    use Parse\ParseObject;
    use Parse\ParseQuery;
    use Parse\ParseUser;
?>

<div class="green button centerButton" onclick="$('#addAdmin').toggle();$('#shade').toggle();">Add Admin</div>

<div id="addAdmin" class="modal">
  <h1>Add Admin</h1>

  <div id="form">
    Email: <input id="email" type="text"><br/>
    Password: <input id="pass" type="password"><br/>
    Confirm Password: <input id="confirmPass" type="password"><br/>
  </div>

  <div class="green button bigButton" onclick="addUser();">Submit</div>
</div>


<ul id="mainList">
<?php
    $userQuery = new ParseQuery('_User');
    $users = $userQuery->find();

    for ($i = 0; $i < sizeOf($users); $i++) {
      $email = $users[$i]->get('email');

      $isCurrentUser = false;
      if (ParseUser::getCurrentUser()->get('email') == $email) {
        $isCurrentUser = true;
      }
?>

      <li>
        <?php if ($isCurrentUser) { ?>
        <div class="modal">
          <div class="actions">
            <div class="green button" onclick="resetPassword('<?=$email?>');">Reset Password</div>
            <div class="red button" onclick="deleteUser();">Delete</div>
          </div>
        </div>
        <?php } ?>

        <h3><?=$email?></h3>

        <div style="clear:both;"></div>
      </li>

<?php } ?>
</ul>

<?php include('footer.php'); ?>


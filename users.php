<?php
    $page_title = 'Users';
    include('header.php');

    use Parse\ParseObject;
    use Parse\ParseQuery;
?>

<div class="green button centerButton" onclick="$('#modal').toggle();$('#shade').toggle();">Add User</div>

<div id="modal">
  <h1>Add User</h1>

  <div id="form">
    Email: <input id="email" type="text"><br/>
    Password: <input id="pass" type="password"><br/>
    Confirm Password: <input id="confirmPass" type="password"><br/>
  </div>

  <div class="green button bigButton" onclick="addUser();">Submit</div>
  <div class="red button bigButton" onclick="$('#modal').toggle(); $('#shade').toggle();">Cancel</div>
</div>


<ul id="mainList">
<?php
    $userQuery = new ParseQuery('_User');
    $users = $userQuery->find();

    for ($i = 0; $i < sizeOf($users); $i++) {
      $email = $users[$i]->get('email');
?>

      <li>
        <div class="actions">
          <div class="red button" onclick="deleteUser('<?=$email?>');">Delete</div>
        </div>

        <h3><?=$email?></h3>

        <div style="clear:both;"></div>
      </li>

<?php } ?>
</ul>

<?php include('footer.php'); ?>


<?php
    $page_title = 'Board Members';
    include('header.php');

    use Parse\ParseObject;
    use Parse\ParseQuery;
?>

<div id="addMember" class="green button" onclick="$('#modal').toggle();$('#shade').toggle();">Add Member</div>

<div id="modal">
  <h1>Add Member</h1>

  <div id="form">
    Name: <input type="text"><br/>
    Position: <input type="text"><br/>
    Email: <input type="text"><br/>
    <input type="file" accept="image/*">
  </div>

  <div class="green button bigButton" onclick="addMember();">Submit</div>
  <div class="red button bigButton" onclick="$('#modal').toggle(); $('#shade').toggle();">Cancel</div>
</div>


<ul id="mainList">
<?php
    $memberQuery = new ParseQuery('Member');
    $members = $memberQuery->find();

    for ($i = 0; $i < sizeOf($members); $i++) {
      $name     = $members[$i]->get('name');
      $position = $members[$i]->get('position');
      $email    = $members[$i]->get('email');
      $picture  = $members[$i]->get('picture')->getURL();
?>

      <li>
        <div class="actions">
          <div class="red button" onclick="deleteMember('<?=$name?>');">Delete</div>
        </div>

        <img src="<?=$picture?>" alt="" />
        <h3><?=$name?></h3>
        <h4><?=$position?></h4>
        <h4><?=$email?></h4>

        <div style="clear:both;"></div>
      </li>

<?php } ?>
</ul>

<?php include('footer.php'); ?>


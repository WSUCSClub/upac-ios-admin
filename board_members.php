<?php
    $page_title = 'Board Members';
    include('header.php');

    use Parse\ParseObject;
    use Parse\ParseQuery;
?>

<div id="addMember" class="green button" onclick="addMember();">Add Member</div>

<ul id="mainList">
<?php
    $memberQuery = new ParseQuery('Member');
    $members = $memberQuery->find();

    for ($i = 0; $i < sizeOf($members); $i++) {
      $name     = $members[$i]->get('name');
      $position = $members[$i]->get('position');
      $email    = $members[$i]->get('email');
      $picture  = $members[$i]->get('picture');
?>

      <li>
        <div class="actions">
          <div class="red button" onclick="deleteMember('<?=$name?>');">Delete</div>
        </div>

        <img src="<?=$name?>" alt="" />
        <h3><?=$name?></h3>
        <h4><?=$position?></h4>
        <h4><?=$email?></h4>

        <div style="clear:both;"></div>
      </li>

<?php } ?>
</ul>

<?php include('footer.php'); ?>


<?php
    $page_title = 'Raffles';
    include('header.php');
   
    use Facebook\FacebookRequest;
    use Facebook\GraphUser;
    use Facebook\GraphObject;

    use Parse\ParseObject;
    use Parse\ParseQuery;
?>

<div id="winners">
  <h1>Winners</h1>

  <ol>
  </ol>

  <div id="close" class="button" onclick="$('#winners').toggle(); $('#shade').toggle();">Got 'em!</div>
</div>

<ul id="mainList">
<?php
    try {
      $events = (new FacebookRequest(
        $session,
        'GET',
        '/322196472693/events',
        [ "fields" => "id,name,location,start_time,cover",
        "since" => (getdate()[0] - 5000000) ] // get max events since 2 months ago
      ))->execute()->getGraphObject();

      for ($i = 0; $i < sizeof($events->getProperty('data')->getPropertyNames()); $i++) {
        $id       = $events->getPropertyAsArray('data')[$i]->getProperty('id'); 
        $name     = $events->getPropertyAsArray('data')[$i]->getProperty('name'); 
        $location = $events->getPropertyAsArray('data')[$i]->getProperty('location'); 

        $date     = $events->getPropertyAsArray('data')[$i]->getProperty('start_time'); 
        
        $timestamp = strtotime($date);

        $pic      = $events->getPropertyAsArray('data')[$i]->getProperty('cover')->getProperty('source'); 

        // Check if event has a raffle
        $hasRaffle = '';

        $raffleQuery = new ParseQuery('Raffle');
        $raffleQuery->equalTo('eventId', $id);
        $raffle = $raffleQuery->first();

        if ($raffle != []) {
          $hasRaffle = 'hasRaffle';
          $entries = $raffle->get('entries');
          $numContestants = sizeOf($entries);
        }
?>

<li id="<?=$id?>" class="<?=$hasRaffle?>">
  <?php if ($hasRaffle != '') { ?>
    <!-- Place for JS to access data pulled from Parse via PHP -->
    <div class="entries" style="display: none;">
    <?php
          if ($numContestants > 0) {
            foreach ($entries as &$entry) {
              echo '<span>' . $entry . '</span><br/>';
            }

            unset($entry);
          }
    ?>
    </div>

    <div class="actions yesRaffle">
      <div class="contestants">
        <span class="green button" onclick="drawWinners('<?=$id?>');">Draw</span>
        <input type="number" value="2" size="2" />
        of <?=$numContestants?>
      </div>
      <div class="red button" onclick="deleteRaffle('<?=$id?>');">Delete</div>
    </div>

  <?php } else { ?>
    <div class="actions noRaffle">
    <div class="green button" onclick="createRaffle('<?=$id?>');">Create Raffle</div>
    </div>
  <?php } ?>

  <img src="<?=$pic?>" alt="" />
  <h3><?=$name?></h3>
  <h4><?=$location?></h4>
  <h4 class="date" title="<?=$timestamp?>"><?=$date?></h4>

  <div style="clear:both;"></div>
</li>

<?php
      } // END EVENTS LOOP

    } catch (FacebookRequestException $e) {
      echo $e->getMessage();
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
?>
</ul>

<?php include('footer.php'); ?>


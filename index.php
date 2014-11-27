<?php
    $page_title = 'Raffles';
    include('header.php');
    use Facebook\FacebookRequest;
    use Facebook\GraphUser;
    use Facebook\GraphObject;
?>

<ul id="events">
<?php
    try {
      $events = (new FacebookRequest(
        $session,
        'GET',
        '/322196472693/events',
        [ "fields" => "id,name,location,start_time,cover",
        "since" => (getdate()[0] - 5000000) ] // get max events since 2 months ago
      ))->execute()->getGraphObject();

      //var_dump($events);

      for ($i = 0; $i < sizeof($events->getProperty('data')->getPropertyNames()); $i++) {
        $id       = $events->getPropertyAsArray('data')[$i]->getProperty('id'); 
        $name     = $events->getPropertyAsArray('data')[$i]->getProperty('name'); 
        $location = $events->getPropertyAsArray('data')[$i]->getProperty('location'); 
        $date     = $events->getPropertyAsArray('data')[$i]->getProperty('start_time'); 
        $pic      = $events->getPropertyAsArray('data')[$i]->getProperty('cover')->getProperty('source'); 
?>

<li id="<?=$id?>">
  <img src="<?=$pic?>" alt="" />
  <h3><?=$name?></h3>
  <h4><?=$location?></h4>
  <h4><?=$date?></h4>
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


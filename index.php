<?php
    $page_title = 'Raffles';
    include('header.php');
    use Facebook\FacebookRequest;
    use Facebook\GraphUser;
    use Facebook\GraphObject;
?>

<h1>Edit Raffles</h1>

<?php
    try {
      $events = (new FacebookRequest(
        $session,
        'GET',
        '/322196472693/events',
        [ "since" => (getdate()[0] - 5000000) ] // get max events since 2 months ago
      ))->execute()->getGraphObject();

      //var_dump($events);

      for ($i = 0; $i < sizeof($events->getProperty('data')->getPropertyNames()); $i++) {
        echo $events->getPropertyAsArray('data')[$i]->getProperty('id') . '<br/>';
        echo $events->getPropertyAsArray('data')[$i]->getProperty('name') . '<br/>';
        echo $events->getPropertyAsArray('data')[$i]->getProperty('location') . '<br/>';
        echo $events->getPropertyAsArray('data')[$i]->getProperty('start_time');
        echo '<br/><br/>';
      }

    } catch (FacebookRequestException $e) {
      echo $e->getMessage();
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
?>

<?php include('footer.php'); ?>


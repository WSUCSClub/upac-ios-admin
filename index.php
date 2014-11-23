<?php
    $page_title = 'Raffles';
    include('header.php');
    use Facebook\FacebookRequest;
    use Facebook\GraphUser;
    use Facebook\GraphObject;
?>

<h1>Edit Raffles</h1>

<p>Hello, world.</p>

<?php
    try {
      $events = (new FacebookRequest(
        $session,
        'GET',
        '/322196472693/events'
      ))->execute()->getGraphObject();

      var_dump($events);
      for ($i = 0; $i < sizeof($events->getPropertyNames()); $i++) {
        echo $events->getPropertyNames()[$i] . '<br/>';
      }

    } catch (FacebookRequestException $e) {
      echo $e->getMessage();
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
?>

<?php include('footer.php'); ?>


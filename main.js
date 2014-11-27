window.onload = function() {
  //
}

function getEntries(id) {
  var entries = [];

  $('#' + id).children('.entries').first().children('span').each(function() {
    entries.push($(this).text());
  });

  return entries;
}

function drawWinners(id) {
  var entries = getEntries(id);
  var numWinners = $('#' + id).children('.actions').first().children('.contestants').first().children('input').first().val();
  var winners = [];

  var i = 0;
  while (i < numWinners && i < entries.length && entries.length > 0) {
    ++i;

    var random = Math.round(Math.random() * 1000) % entries.length;
    var possibleWinner = entries[random];

    // Make sure entry isn't already a winner
    var alreadyWon = false;
    for (var j = 0; j < winners.length; j++) {
      if (possibleWinner == winners[j]) {
        alreadyWon = true;
        --i;
        break;
      }
    }

    if (!alreadyWon) {
      winners.push(possibleWinner);
    }
  }

  // Display winners
  $('#winners').toggle();
  $('#shade').toggle();

  var list = $('#winners').children('ol').first();
  list.empty();

  for (i = 0; i < winners.length; i++) {
    list.append('<li>' + winners[i] + '</li>');
  }
}

function createRaffle(id) {
  var date = new Date();

  var phpDate = $('#' + id).children('.date').first().attr('title');
  var endDate = new Date((+phpDate + 86400) * 1000); // Add 1 day to start

  var Raffle = Parse.Object.extend("Raffle");
  var raffle = new Raffle();
  raffle.set("eventId", id);
  raffle.set("date", date);
  raffle.set("endDate", endDate);


  raffle.save(null, {
    success: function(result) {
               location.reload();
             },
    error: function(result, error) {
             alert('Failed to create new object, with error code: ' + error.message);
           }
  });
}

function deleteRaffle(id) {
  // Prompt for user verification
  if (confirm('Are you sure you want to delete this raffle and all of it\'s participants?')) {

    // Delete from Parse
    var Raffle = Parse.Object.extend('Raffle');
    var query = new Parse.Query(Raffle);
    query.equalTo('eventId', id);
    query.first({

      success: function(raffle) {
                 raffle.destroy({
                   success: function(result) {
                              location.reload();
                            },

                   error: function(result, error) {
                            alert('Sorry, couldn\'t delete that raffle.\n\n' + error);
                          }
                 });

               },

      error: function(raffle) {
               alert('Sorry, couldn\'t find that raffle.');
             }

    });
  }

}

function deleteMember(name) {
  alert('deleted ' + name);
  location.reload();
}

function addMember() {
  alert('adding member');
}









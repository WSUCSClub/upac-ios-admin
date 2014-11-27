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
  var numWinners = $('#' + id).children('.raffle').first().children('.contestants').first().children('input').first().val();
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


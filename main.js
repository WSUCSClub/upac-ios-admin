window.onload = function() {
  //
}

function drawWinners(id) {
  var entries = [];

  $('#E' + id).children('span').each(function() {
    entries.push($(this).text());
  });

  alert(entries);
}


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
  $('#modal').toggle();
  $('#shade').toggle();

  var list = $('#modal').children('ol').first();
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
             alert('Failed to create new raffle, with error code: ' + error.message);
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
  // Prompt for user verification
  if (confirm('Are you sure you want to delete this board member?')) {

    // Delete from Parse
    var Member = Parse.Object.extend('Member');
    var query = new Parse.Query(Member);
    query.equalTo('name', name);
    query.first({

      success: function(member) {
                 member.destroy({
                   success: function(result) {
                              location.reload();
                            },

                   error: function(result, error) {
                            alert('Sorry, couldn\'t delete that member.\n\n' + error);
                          }
                 });

               },

      error: function(member) {
               alert('Sorry, couldn\'t find that member.');
             }
    });
  }

}

function addMember() {
  var name = $('#name').val();
  var position = $('#position').val();
  var email = $('#email').val();
  var pictureControl = $('#picture')[0];

  if (validateMember(name, position, email, pictureControl)) {
    // add to parse
    var Member = Parse.Object.extend("Member");
    var member = new Member();
    member.set("name", name);
    member.set("position", position);
    member.set("email", email);

    var picture = pictureControl.files[0];
    var parseFile = new Parse.File('profile_picture.jpg', picture);
    member.set("picture", parseFile);

    member.save(null, {
      success: function(result) {
                 location.reload();
               },
      error: function(result, error) {
               alert('Failed to create new member, with error code: ' + error.message);
             }
    });
  } else {
    alert('Please fill in all the information.');
  }
}

function validateMember(name, position, email, pictureControl) {
  var valid = false;
  
  if (name != '' && position != '' && email != '' && pictureControl.files.length > 0) {
    valid = true;
  }

  return valid;
}


function deleteUser(email) {
  // Prompt for user verification
  if (confirm('Are you sure you want to delete this user?')) {

    // Delete from Parse
    var User = Parse.Object.extend('_User');
    var query = new Parse.Query(User);
    query.equalTo('email', email);
    query.first({

      success: function(user) {
                 user.destroy({
                   success: function(result) {
                              window.location = 'logout.php';
                            },

                   error: function(result, error) {
                            alert('Sorry, couldn\'t delete that user.\n\n' + error);
                          }
                 });

               },

      error: function(user) {
               alert('Sorry, couldn\'t find that user.');
             }
    });
  }

}

function addUser() {
  var email = $('#email').val();
  var pass = $('#pass').val();
  var confirmPass = $('#confirmPass').val();

  if (validateUser(email, pass, confirmPass)) {
    // Add to parse
    var user = new Parse.User();
    user.set("username", email);
    user.set("email", email);
    user.set("password", pass);

    user.signUp(null, {
      success: function(result) {
                 location.reload();
               },
      error: function(result, error) {
               alert('Failed to create new member, with error code: ' + error.message);
             }
    });
  }
}

function validateUser(email, pass, confirmPass) {
  var valid = false;
  
  if (email != '' && pass != '' && confirmPass != '') {
    if (pass == confirmPass) {
      valid = true;
    } else {
      alert('The passwords do not match.');
    }
  } else {
    alert('Please fill in all the information.');
  }

  return valid;
}








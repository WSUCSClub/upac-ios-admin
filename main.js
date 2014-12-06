$(window).load(function() {
  respondToSize();
  loginFormHelper();
  initList();
});

$(window).resize(function() {
   respondToSize();
});

function respondToSize() {
  // Hide nav list on mobile
  var nav = $('nav').first();
  var navList = nav.children('ul').first();
  //if ($(document).width() <= 640) { 
  if ($(document).width() > 0) { 
    navList.hide();
    nav.click(function() {
      navList.toggle();
    });
  } else {
    navList.show();
  }
}

function initList() {
  var list = $('#mainList').find('li');
  list.each(function(index) {
    $(this).click(function() {
      $(this).find('.modal').first().show();
      $('#shade').show();
    });

    /*$(this).find('.cancel').first().click(function() {
      $(this).parent().hide();
      $('#shade').hide();
    });*/
  });
}

function cancelModal() {
  $('.modal').hide();
  $(document).find('.modal').each(function(index) {
    $(this).hide();
    $(this).first().hide();
  });
  alert('test');
}

function loginFormHelper() {
  $('#email').focus(function() {
    if ($(this).val() == 'email') {
      $(this).val('');
    }
  });

  $('#email').focusout(function() {
    if ($(this).val().length < 1) {
      $(this).val('email');
    }
  });

  $('#password').focus(function() {
    if ($(this).val() == 'password') {
      $(this).val('');
    }
  });

  $('#password').focusout(function() {
    if ($(this).val().length < 1) {
      $(this).val('password');
    }
  });
}

function getEntries(id) {
  var entries = [];

  $('#' + id).find('.entries').first().children('span').each(function() {
    entries.push($(this).text());
  });

  return entries;
}

function drawWinners(id) {
  var entries = getEntries(id);
  var numWinners = $('#' + id).find('.actions').first().children('.contestants').first().children('input').first().val();
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
  $('#winners').show();
  $('#shade').show();

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
               alert('Failed to create new member: ' + error.message);
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
               alert('Failed to create new admin: ' + error.message);
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

function deleteUser() {
  // Prompt for user verification
  if (confirm('Are you sure you want to delete this user?')) {
    window.location = 'delete_user.php';
  }

}

function resetPassword(email) {
  Parse.User.requestPasswordReset(email, {
    success: function() {
      alert("Check your email to reset your password");
      location.reload();
    },
    error: function(error) {
      alert("Failed to reset password: " + error.message);
    }
  });

}







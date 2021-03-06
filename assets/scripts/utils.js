var friendsPageNumber = 1;
var selectedFriends = [];
var selectedFriendsName = [];
var friends = [];
var populateContor = 0;
var userName;

function redirectToHome(userData) {
	userName = userData.name;
	networkUserId = userData.id;

	$.ajax({
	    url:'/meetie/index.php/login/logintoapp',
	    type: 'POST',
	    data: userData,
	    success: function(){
	       window.location = '/meetie/index.php/home';
	    },
	    error: function(){
	    console.log("Fail");
	    }
	});
}

function getUserFriends() {
	var network = localStorage.getItem("network");
	if (network === 'facebook') {
		facebookFriendsList();
	}
	else if (network === 'google_plus') {
		googleFriendsList();
	}
	else if (network === 'twitter') {
		twitterFriendsList();
	}
}

function selectFriend(element) {
	var friendId = $(element).parent().attr('id');
	var friendName = $(element).parent().attr('data-name');
	var elementIndex = selectedFriends.indexOf(friendId.toString());
	if (elementIndex > -1) {
		selectedFriends.splice(elementIndex, 1);
		selectedFriendsName.splice(elementIndex, 1);
	}
	else {
		selectedFriends.push(friendId);
		selectedFriendsName.push(friendName);
	}
}

function createFriendDiv(friend) {
	var friends=document.getElementById("friends");

	if (selectedFriends.indexOf(friend.id.toString()) > -1) {
		return $('<div class="friend" id="' + friend.id + '" data-name="' + friend.name + '" style="background-image: url(' + friend.picture + ')"><input class="cb" type="checkbox" checked onclick="selectFriend(this)"/><div class="numeFriend"><label class="nume">' + friend.name + '</label></div></div>');
	}
	else {
		return $('<div class="friend" id="' + friend.id + '" data-name="' + friend.name + '" style="background-image: url(' + friend.picture + ')"><input class="cb" type="checkbox" onclick="selectFriend(this)"/><div class="numeFriend"><label class="nume">' + friend.name + '</label></div></div>');
	}
}

function populateFriendsField(pageNumber){
	friendsPageNumber = pageNumber;
	if (populateContor == 0) {
		friends = JSON.parse(localStorage.getItem("user_friends"));
		populateContor++;
	}

	if (pageNumber == 1) {
		if (Math.ceil(friends.length / 10) > 1) {
			document.getElementById('nextPage').style.visibility = "visible";
		}
		else {
			console.log('else');
			document.getElementById('nextPage').style.visibility = "hidden";
		}
		document.getElementById('previousPage').style.visibility = "hidden";
	}

	$('#friends').empty();

	var startIndex = (pageNumber - 1) * 10;
	var endIndex = pageNumber * 10 - 1;

    for (var index = startIndex; index <= endIndex; index++) {
    	if (index < friends.length) {
    		var friendDiv = createFriendDiv(friends[index]);
			friendDiv.appendTo($("#friends"));
		}
    }
}

function selectAll() {
	selectedFriends = [];
	selectedFriendsName = [];
	if ($('#selectAll').is(':checked')) {
		for (var i = 0; i < friends.length; i++) {
			selectedFriends.push(friends[i].id.toString());
			selectedFriendsName.push(friends[i].name.toString());
		}
		var friendsDivs = $('#friends').children();
		friendsDivs.each( function(){
			var friendFields = $(this).children('input');
			friendFields.each( function() {
				$(this).prop("checked", true);
			});
		});
	}
	else {
		var friendsDivs = $('#friends').children();
		friendsDivs.each( function(){
			var friendFields = $(this).children('input');
			friendFields.each( function() {
				$(this).prop("checked", false);
			});
		});
	}
}

function changePageNr(button) {
	var nrOfPages = Math.ceil(friends.length / 10);
	if (button == "nextPage") {
 		friendsPageNumber++;
 		document.getElementById('previousPage').style.visibility = "visible";
 		if (friendsPageNumber ==  nrOfPages) {
 			document.getElementById('nextPage').style.visibility = "hidden";
 		}
 	}
	else if (button == "previousPage") {
		friendsPageNumber--;
		document.getElementById('nextPage').style.visibility = "visible";
		if (friendsPageNumber ==  1) {
 			document.getElementById('previousPage').style.visibility = "hidden";
 		}
	}
	populateFriendsField(friendsPageNumber);
}

function removeLocalData() {
	localStorage.clear();
}

function searchFriends(input) {
	var searchValue = $(input).val();
	var foundFriends = [];
	if (searchValue != '') {
		$('#friends').empty();
		for (var i = 0; i < friends.length; i++) {
			var friendNames = friends[i].name.split(' +');
			for (var name = 0; name < friendNames.length; name++) {
				if (friendNames[name].substring(0, searchValue.length).toLowerCase() === searchValue.toLowerCase()) {
					foundFriends.push(friends[i]);
				}
			}
		}
		friends = foundFriends;
		populateFriendsField(1);
	}
	else {
		friends = JSON.parse(localStorage.getItem("user_friends"));
		populateFriendsField(1);	
	}
}

function addDateTime() {
	if ($('#meeting_times').children().length < 5) {
		var dateTime = $('<label class="times">' + $('#datetime').val() + '</label>');
		dateTime.appendTo($('#meeting_times'));
		if ($('#meeting_times').children().length == 5) {
			$('#addDate').attr('disabled', true);
		}
	}
}



function sendMail(emailAddresses) {
	var emails = [];
	for (var i = 0; i < emailAddresses.length; i++) {
		emails.push({
			'email' : emailAddresses[i],
			'type' : 'to'
		});
	}

	$.ajax({
      type: 'POST',
      url: 'https://mandrillapp.com/api/1.0/messages/send.json',
      data: {
        'key': 'RoG0PK_QhHP7hQ3pN6jRPw',
        'message': {
          'from_email': 'meetieapplication@gmail.com',
          'to': emails,
          'autotext': 'true',
          'subject': 'Meetie Invitation',
          'html': 'You have been invited to a meeting by ' + userName + '.'
        }
      }
     }).done(function(response) {
       console.log(response);
     });
}

function sendInvitation() {

	var network = localStorage.getItem("network");

	if (network == 'google_plus') {
		var invitedPersons = '';

		for (var i = 0; i < selectedFriends.length - 1; i++) {
			invitedPersons = invitedPersons.concat(selectedFriends[i] + ',');
		}

		invitedPersons = invitedPersons.concat(selectedFriends[selectedFriends.length - 1]);

		var options = {
			contenturl : 'http://webprojects.dev/meetie/index.php/home',
			clientid : '552747617031-iq9hg8hgm56mtd2jdn9uv4neit9tvhkr.apps.googleusercontent.com',
			calltoactionurl : 'http://webprojects.dev/meetie/index.php/home',
			cookiepolicy : 'none',
			prefilltext : 'You have been invited to a meeting on Meetie!',
			recipients : invitedPersons
		};

		gapi.interactivepost.render('submitInvitation', options);
		$('#sharePost').click();
	}

	var meetingTimes = [];
	$('#meeting_times').children().each(function() {
		meetingTimes.push($(this).text());
	});

	var invitationData = {
		'title' : $('#title').val(),
		'description' : $('#txt').val(),
		'location' : $('#location').val(),
		'type' : $('#type').val(),
		'deadline' : $('#deadline').val(),
		'meeting_times' : meetingTimes,
		'friends' : selectedFriends,
		'friendsNames' : selectedFriendsName
	};

	$.ajax({
	    url:'/meetie/index.php/create_meeting/createInvitation',
	    type: 'POST',
	    data: invitationData,
	    success: function(response){  	
	        $('#title').val('');
	        $('#txt').val('');
	        $('#location').val('');
	        $('#type').val('unique');
	 		$('#deadline').val('');
	 		$('#datetime').val('');
	 		$('#meeting_times').empty();
	 		$('#searchFriendInput').val('');
	 		$('#selectAll').prop("checked", false);
	 		selectedFriends = [];
	 		selectedFriendsName = [];
	 		populateContor = 0;
	 		populateFriendsField(1);

	 		var network = localStorage.getItem("network");
	 		if (network == 'facebook') {
	 			var emails = $.parseJSON(response);
	 			var friendsEmails = [];
	 			for (var i = 0; i < emails.length; i++) {
	 				friendsEmails.push(emails[i]);
	 			}
	 			sendMail(friendsEmails);
	 		}
	 		else if (network == 'twitter') {
	 			console.log('TWITTER');
	 			console.log(invitationData.friends);
	 			var message = 'Hello, I have just invited you to a meeting on Meetie. Check your page to see it.';
	 			for (var i = 0; i < invitationData.friends.length; i++) {
	 				twitterSendMessage(invitationData.friends[i], message);
	 			}
	 		}
	    },
	    error: function(){
	    	console.log("Fail");
	    }
	});
}

function getUserName() {
	$.ajax({
	    url:'/meetie/index.php/create_meeting/getUserName',
	    type: 'GET',
	    success: function(data){
	       userName = $.parseJSON(data);
	    },
	    error: function(){
	    	console.log("Fail");
	    }
	});
}
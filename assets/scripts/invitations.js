var nrOfInvitationReplies = [];

function searchByFields() {
	var searchFields = [];
	var searchValues = [];
	var result = [];

	if ((invitations != "You have no invitations!") && (invitations != "You have no created meetings!")) {
		if ($('#searchByTitle').val().trim() != '') {
			searchValues.push($('#searchByTitle').val().trim());
			searchFields.push("title");
		}

		if ($('#searchByCreator').val().trim() != '') {
			searchValues.push($('#searchByCreator').val().trim());
			searchFields.push("creator_name");
		}

		if ($('#searchByType').val().trim() != '') {
			searchValues.push($('#searchByType').val().trim());
			searchFields.push("type");
		}

		for (var i = 0; i < invitations.length; i++) {
			if (isInvitationMatched(invitations[i], searchFields, searchValues) == true) {
				result.push(invitations[i]);
			}
		}		
	}
}

function isInvitationMatched(invitation, searchFields, searchValues) {

	for (var i = 0; i < searchFields.length; i++) {
		var invitationComponents = invitation[searchFields[i]].split(new RegExp("\\s+"));
		var searchValueComponents = searchValues[i].split(new RegExp("\\s+"));

		if (searchValueComponents.length == 1) {
			var matched = false;

			for (var contor2 = 0; contor2 < invitationComponents.length; contor2++) {
				if (invitationComponents[contor2].substring(0, searchValueComponents[0].length).toLowerCase() === searchValueComponents[0].toLowerCase()) {
					matched = true;
					break;
				}
			}

			if (matched == false) {
				return false;
			}
		}
		else {
			var matchedComponents = 0;

			for (var contor1 = 0; contor1 < searchValueComponents.length; contor1++) {
				var matched = false;
				for (var contor2 = 0; contor2 < invitationComponents.length; contor2++) {
					if (searchValueComponents[contor1].toLowerCase() == invitationComponents[contor2].toLowerCase()) {
						matched = true;
						break;
					}
				}

				if (matched == true) {
					matchedComponents++;
				}
			}

			if (matchedComponents < searchValueComponents.length) {
				return false;
			}
		}
	}

	return true;
}

function orderInvitedPersons() {
	var networkUserId;

	$.ajax({
	    url:'/meetie/index.php/invitations/getUserNetworkId',
	    type: 'GET',
	    success: function(data){
	       networkUserId = $.parseJSON(data);
	       for (var contor1 = 0; contor1 < invitations.length; contor1++) {
				for (var contor2 = 0; contor2 < invitations[contor1]['invitedPers'].length; contor2++) {
					
					if (invitations[contor1]['invitedPers'][contor2]['userNetworkId'] == networkUserId) {
						var aux = invitations[contor1]['invitedPers'][contor2];
						invitations[contor1]['invitedPers'][contor2] = invitations[contor1]['invitedPers'][0];
						invitations[contor1]['invitedPers'][0] = aux;
						break;
					}
				}
			}
	    },
	    error: function(){
	    	console.log("Fail");
	    }
	});
}

function sendInvitationReply(invitationId, timeOfMeeting){

	$.ajax({
	    url:'/meetie/index.php/invitations/storeInvitationReply',
	    type: 'POST',
	    data : {
	    	'invitation_id' : invitationId,
	    	'timeOfMeeting' : timeOfMeeting
	    },
	    success: function(){
	    },
	    error: function(){
	    	console.log("Fail");
	    }
	});	
}

function countVotesForTimes() {
	for (var contor = 0; contor < invitations.length; contor++) {
		var times = [];
		for (var i = 0; i < invitations[contor]['times'].length; i++) {
			times[invitations[contor]['times'][i]] = 0;
		}

		for (var i = 0; i < invitations[contor]['invitedPers'].length; i++) {
			if (invitations[contor]['invitedPers'][i]['response'] != null) {
				times[invitations[contor]['invitedPers'][i]['response']]++;
			}
		}

		var data = {
			'invitation_id' : invitations[contor]['id'],
			'times' : times
		};

		nrOfInvitationReplies.push(data);
	}
	console.log(nrOfInvitationReplies);
}